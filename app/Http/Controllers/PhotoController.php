<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Http\Requests\PhotoRequest;
use App\Http\Requests\RateRequest;
use App\Models\Comment;
use App\Models\Photo;
use App\Models\Rate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isNull;

class PhotoController extends Controller
{
    public function show($id)
    {
        $photo = Photo::find($id);
        if(!is_object($photo)) abort(404);

        return view('photo', compact('photo'));
    }

    public function rate(RateRequest $req)
    {
        Rate::updateOrCreate(
            [
                'user_id' =>  Auth::id(),
                'photo_id' => $req->photo_id
            ],
            [
                'value' => $req->value
            ]
        );

        return redirect()->route('photo', ['id' => $req->photo_id]);
    }

    public function comment(CommentRequest $req)
    {
        $comment = new Comment();
        
        $comment->user_id = Auth::id();
        $comment->photo_id = $req->photo_id;
        $comment->value = $req->value;

        $comment->save();
        
        return redirect()->route('photo', ['id' => $req->photo_id]);
    }

    public function addPhotoPage()
    {
        return view('dodaj_zdjecie');
    }

    public function add(PhotoRequest $req)
    {
        $imgName = uniqid($req->nazwa.'_').".".$req->image->extension();
        $req->image->move(public_path('images'), $imgName);

        $photo = new Photo();
        $photo->nazwa = $req->nazwa;
        $photo->adres = $imgName;
        $photo->user_id = Auth::id();
        $photo->opis = $req->description;
        if(isset($req->hashtag1))
        {
            $photo->hashtag1 = $req->hashtag1;
            if(isset($req->hashtag2))
            {
                $photo->hashtag2 = $req->hashtag2;
                if(isset($req->hashtag3))
                {
                    $photo->hashtag3 = $req->hashtag3;
                }
            }
        }
       
        $photo->save();

        return redirect()->route('user.show', ['id' => Auth::id(), 'page' => 1]);
    }

}
