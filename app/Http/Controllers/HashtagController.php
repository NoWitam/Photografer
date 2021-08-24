<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;

class HashtagController extends Controller
{
    public function show($hashtag, $page)
    {
       $count = Photo::where('hashtag1', $hashtag)->orWhere('hashtag2', $hashtag)->orWhere('hashtag3', $hashtag)->count('id');

       if($page > ceil($count/10) AND $page != 1)
       {
           abort(404);
       }

       $photos = Photo::where('hashtag1', $hashtag)->orWhere('hashtag2', $hashtag)->orWhere('hashtag3', $hashtag)->orderBy('created_at', 'desc')->offset($page*10-10)->limit(10)->get();

       return view('przegladaj', ['photos' => $photos, 'count' => $count, 'page' => $page, 'hashtag' => $hashtag]);
    }
}
