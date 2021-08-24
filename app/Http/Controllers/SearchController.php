<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function ask(Request $req)
    {
       $ask = $req->ask;

       if(empty($ask))
       {
           return redirect()->back();  
       }
       else 
       {
           return redirect()->route('search.show', ['ask' => $ask, 'page' => 1]); 
       }

    }

    public function show($ask, $page)
    {      
        if(empty($ask))
        {
            return abort(404);
        }

        $count = Photo::search(['nazwa', 'opis'], $ask)->count('id');

        if($page > ceil($count/10) AND $page != 1)
        {
            abort(404);
        }
        
        $photos = Photo::search(['nazwa', 'opis'], $ask)->orderBy('created_at', 'desc')->offset($page*10-10)->limit(10)->get();

        return view('przegladaj', ['photos' => $photos, 'count' => $count, 'page' => $page, 'ask' => $ask]);
    }
}
