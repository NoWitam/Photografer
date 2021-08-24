<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;
    protected $appends = ['value'];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function rates()
    {
        return $this->hasMany('App\Models\Rate', 'photo_id');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment')->orderBy('created_at' ,'DESC');
    }

    public function getRate()
    {
        return $this->hasMany('App\Models\Rate')->avg('value');
    }

    public function getCount()
    {
        return $this->hasMany('App\Models\Rate')->count('value');
    }

}
