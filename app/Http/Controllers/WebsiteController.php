<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Website;
use Auth;

class WebsiteController extends Controller
{
    public function addUrl(Request $request)
    {
        $request->validate(
            [
                'url'=>'required|url'
            ],
            [
                'url.url'=>'Invalid url , valid url format is https://www.example.com'
            ]
        );
        $maxId = Website::max('id');
        
        $shortUrl = Str::random(6).$maxId;
        Website::create(
        [
            'user_id'=>Auth::id(),
            'short_url'=>$shortUrl,
            'long_url'=>$request->url,
        ]
        );
        return redirect()->back();
    }
    public function countClick(Request $req)
    {
        $id= $req->id;
        $website = Website::find($id);
        $website->total_clicks = $website->total_clicks + 1;
        $website->save();
    }
}
