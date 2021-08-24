<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddUserRequest;
use App\Http\Requests\DescriptionRequest;
use App\Models\Photo;
use App\Models\User;
use App\Models\Follow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function startPage()
    {
        return view('start');

    }

    public function dodaj(AddUserRequest $req)
    {
        if($req->haslo == $req->p_haslo)
        {
            $user = new User();

            $user->password = Hash::make($req->haslo);
            $user->email = $req->email;
            $user->name = $req->nazwa;
    
            $user->save();
    
            return redirect()->back();
        }
        else 
        {
            return redirect()->back()
               ->with('hidden', 'dolacz')
               ->withErrors(['Hasła nie są identyczne']);
        }  
    }

    public function loguj(Request $req)
    {
        $credentials = $req->validate([
            'email' => [],
            'password' => [],
        ]);

        if (Auth::attempt($credentials))
        {
            $req->session()->regenerate();

            return redirect()->route('user.show', ['id' => Auth::user()->id, 'page' => 1]);
        }
        else 
        {
            return redirect()->back()
               ->with('hidden', 'zaloguj')
               ->withError('e-mail lub hasło są nieprawidłowe');
        }
    }

    public function logout(Request $req)
    {
       Auth::logout();

       $req->session()->invalidate();
       $req->session()->regenerateToken();

       return redirect()->route('start');
    }

    public function show($id, $page)
    {
        $count = Photo::where('user_id', $id)->count('id');

        if($page > ceil($count/10) AND $page != 1)
        {
            abort(404);
        }
        
        $user = User::find($id);
        $photos = Photo::where('user_id', $id)->orderBy('created_at', 'desc')->offset($page*10-10)->limit(10)->get();

        $isFollow = Follow::where('followed_id', $id)->where('follower_id', Auth::id())->exists();

        return view('profil', ['user' => $user, 'photos' => $photos, 'count' => $count, 'page' => $page, 'isFollow' => $isFollow]);
    }

    public function description(DescriptionRequest $req)
    {
        $user = User::find(Auth::id());
        $user->opis = $req->description;
        $user->save();
        return redirect()->back();
    }

}
