@extends('layouts.app')
@section('content')

    <div class="container mt-5">
        <button type="button" class="btn btn-primary modalshow" id="modalshow" data-toggle="modal" data-target="#exampleModalCenter">
        Create Short Url
        </button>
       
        <div class="modal fade modalup" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <form method="POST" action="{{ route('add-url') }}">
                @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="url">Enter Url</label>
                            <input type="text" class="form-control" id="url" name="url" placeholder="https://www.example.com" required>
                        </div>
                    </div>
                    @if($errors->has('url'))
                        <div class="text-danger">{{ $errors->first('url') }}</div>
                    @endif
                    <div class="modal-footer">
                    
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
            </div>
        </div>
        <table class="table table-striped w-50 m-auto">
            <thead>
            <tr>
                <th scope="col" width="30%">#</th>
                <th scope="col m-auto" width="50%">Short Url</th>
                <th scope="col">Click</th>
            </tr>
            </thead>
            <tbody>
                @foreach($users->websites as $website)
                    <tr>
                        <th scope="row">{{ $website->id }}</th>
                        <td>{{ $website->short_url }}</td>
                        <td class="">
                            <a type="button" onclick="countClick('{{ $website->id }}',event)" href="{{$website->short_url}}" target="_blank" id="url-counter" class="btn btn-primary" >Click</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex">
        </div>
    </div>
@endsection
@push('js')
<script>
    window.onload = function () {
        let urlval = "{{ $errors->first('url')}}";
        if(urlval)
        {
            let modalshow = document.getElementById('modalshow');
            modalshow.click();
        }
    }
function countClick(id,e) {
    e.preventDefault();
    $.ajax({
        'type':'GET',
        url:"{{ route('count-clicks') }}",
        data:`id=${id}`,
        success:function(data) {
            window.open(data,"_blank");
        }
    });
}
</script>
