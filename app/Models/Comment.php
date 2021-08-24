<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    
    protected $fillable = 
    [
        'value',
        'user_id',
        'photo_id',
    ];

    public function photo()
    {
        return $this->belongsTo('App\Models\Photo', 'photo_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
