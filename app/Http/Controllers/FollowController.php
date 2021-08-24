<?php

namespace App\Http\Controllers;

use App\Http\Requests\FollowRequest;
use App\Models\Follow;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function follow(FollowRequest $req)
    {
        $follow = new Follow();
        $follow->follower_id = Auth::id();
        $follow->followed_id = $req->id;
        $follow->save();

        return redirect()->back();
    }

    public function unfollow(Request $req)
    {
        Follow::where('follower_id', Auth::id())->where('followed_id', $req->id)->delete();

        return redirect()->back();
    }

    public function show($page)
    {
        $count = Photo::whereHas('user', function($users){

            $users->whereHas('follows', function($follows){
                $follows->where('follower_id', Auth::id());
            });

        })->count('id');

        if($page > ceil($count/10) AND $page != 1)
        {
            abort(404);
        }
        
        $photos = Photo::whereHas('user', function($users){

            $users->whereHas('follows', function($follows){
                $follows->where('follower_id', Auth::id());
            });

        })->orderBy('created_at', 'desc')->offset($page*10-10)->limit(10)->get();

        return view('przegladaj', ['count' => $count, 'photos' => $photos, 'page' => $page]);

    }
}
