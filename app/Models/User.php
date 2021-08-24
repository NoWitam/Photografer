<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public function photos()
    {
        return $this->hasMany('App\Models\Photo', 'user_id')->orderBy('created_at' ,'DESC');
    }

    public function follows()
    {
        return $this->hasMany('App\Models\Follow', 'followed_id');
    }

    public function rate()
    {
        return $this->hasMany('App\Models\Rate', 'user_id');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment', 'user_id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
