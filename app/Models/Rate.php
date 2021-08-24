<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isNull;

class Rate extends Model
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

    public static function myRate($photo_id)
    {
        if(Auth::check())
        {
            $rate = self::where('photo_id', $photo_id)->where('user_id', Auth::id())->first();
            if($rate == "")
            {
                return 0;
            }
            return $rate->value;
        }
        else return -1;
    }

}
