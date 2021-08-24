@extends('menu')

@section('css')
   <link rel="stylesheet" href="{{ asset('css/top.css') }}">
@endsection

@section('content')
 <div id='czas'>
   <a href="{{ route('top', ['daysAgo' => 'dzien']) }}"> <div @if($time == 'dzien') id='activ' @endif>Top 24h</div> </a>
   <a href="{{ route('top', ['daysAgo' => 'tydzien']) }}"> <div @if($time == 'tydzien') id='activ' @endif>Top tygodnia</div> </a>
   <a href="{{ route('top', ['daysAgo' => 'miesiac']) }}"> <div @if($time == 'miesiac') id='activ' @endif>Top miesiąca</div> </a>
   <a href="{{ route('top', ['daysAgo' => 'rok']) }}"> <div @if($time == 'rok') id='activ' @endif>Top roku</div> </a>
   <a href="{{ route('top', ['daysAgo' => 'all']) }}"> <div @if($time == 'all') id='activ' @endif>Top wszechczasów</div> </a>
 </div>

 <div id='ranking'>
    @if (count($top) >= 2))
   <div id='second' class='ranking_miejsce'>
      <table>
         <tr>
            <td>
            {{ $top[1]->photo->nazwa }}
            </td>
            <td>
            {{ number_format($top[1]->pkt, 0, ".", " ") }} pkt.
            </td>
         </tr>
      </table>
      <a href="{{ route('photo', ['id' => $top[1]->photo->id]) }}"> 
         <img src="{{ asset('images/'.$top[1]->photo->adres) }}">
      </a>
   </div>
   @endif

   @if (count($top) >= 1))
   <div id='first' class='ranking_miejsce'>
      <table>
         <tr>
            <td>
            {{ $top[0]->photo->nazwa }}
            </td>
            <td>
            {{ number_format($top[0]->pkt, 0, ".", " ") }} pkt.
            </td>
         </tr>
      </table>
      <a href="{{ route('photo', ['id' => $top[0]->photo->id]) }}"> 
         <img src="{{ asset('images/'.$top[0]->photo->adres) }}">
      </a>
   </div>
   @endif

   @if (count($top) >= 3))
   <div id='third' class='ranking_miejsce'>
      <table>
         <tr>
            <td>
            {{ $top[2]->photo->nazwa }}
            </td>
            <td>
            {{ number_format($top[2]->pkt, 0, ".", " ") }} pkt.
            </td>
         </tr>
      </table>
      <a href="{{ route('photo', ['id' => $top[2]->photo->id]) }}"> 
         <img src="{{ asset('images/'.$top[2]->photo->adres) }}">
      </a>
   </div>
   @endif
 </div>
@endsection

@section('js')

@endsection