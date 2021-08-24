<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Photo;
use App\Models\Rate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TopController extends Controller
{
    public function show($daysAgo) 
    {
        switch($daysAgo)
        {
            case 'dzien':
                $days = 1;
                break;
            case 'tydzien':
                $days = 7;
                break;
            case 'miesiac':
                $days = 30;
                break;
            case 'rok':
                $days = 365;
                break;
            case 'all':
                $days = -1;
                break;
            default:
                abort(404);
        }

        $top= Rate::whereHas('photo', function($q) use ($days) {
            if($days != -1)
            {
                $q->where('created_at', '>', Carbon::now()->subDays($days)->toDateTimeString());
            }       
        })->with('photo')->select(DB::raw('(AVG(value)-3)*COUNT(value) as pkt, photo_id'))->orderBy('pkt', 'DESC')->groupBy('photo_id')->limit(3)->get();

        return view('top', ['top' => $top, 'time' => $daysAgo]);
    }
}
