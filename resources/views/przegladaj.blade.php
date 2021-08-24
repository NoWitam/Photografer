@extends('menu')

@section('css')
   <link rel="stylesheet" href="{{ asset('css/przegladaj.css') }}">
@endsection

@section('content')
<div id='prze_center'>

   @if (isset($hashtag))
      <div id='hashtag_info'>
         <div>
            <h1>Wyniki wyszukiwania dla</h1>
         </div>
         <div class='hashtag'>
             <table>
                <tr>
                   <td class='hash'>#</td>
                   <td>{{ $hashtag }}</td>
                </tr>
             </table>
          </div>
      </div>
   @elseif (isset($ask))
      <div id='search_info'>
         <h2>Wyniki wyszukiwania dla:</h2>
         <h1>{{ $ask }} </h2>
      </div>
   @endif

   @php
      $now = time();
      $rok = 365*24;
      $miesiec = 24*30;
      $tydzien = 24*7;
      $dzien = 24;
      $minuta = 1/60;

      function intToText($time, $przedzial, $lpoj, $lmn)
      {
         if(floor($time/$przedzial) == 1)
         {
            return $lpoj." temu";
         } else
         {
            return floor($time/$przedzial)." ".$lmn." temu";
         }
      }

   @endphp

   @if (count($photos) > 0)
   @foreach ($photos as $photo)

      @php
         $rate = $photo->getRate();
         $countOfRates = $photo->getCount();
         $score = ($rate-3) * $countOfRates;

         $time = ($now - $photo->created_at->timestamp)/60/60; // godziny
         
         if($time >= $rok ) 
         {
            $text = intToText($time, $rok, 'rok', 'lata');
         } else if($time >= $miesiec)
         {
            $text = intToText($time, $miesiac, 'miesiac', 'miesiace');
         } else if($time >= $tydzien)
         {
            $text = intToText($time, $tydzien, 'tydzien', 'tygodnie');
         } else if($time >= $dzien)
         {
            $text = intToText($time, $dzien, 'dzien', 'dni');
         } else if($time >= 1)
         {
            $text = intToText($time, 1, 'godzina', 'godziny');
         } else if($time >= 30*$minuta)
         {
            $text = "30 minut temu";
         } else if($time >= 10*$minuta)
         {
            $text = "10 minut temu";
         } else if($time >= 5*$minuta)
         {
            $text = "5 minut temu";
         } else if($time >= $minuta)
         {
            $text = "minuta temu";
         } else 
         {
            $text = "chwile temu";
         }
      @endphp

   <div class='post'>
      <div class='post_top'>
         <div class='post_left'>
            <a href="{{ route('user.show', ['id' => $photo->user->id, 'page' => 1]) }}"><h2>{{ $photo->user->name }}</h2></a>
            <h3>{{ $photo->nazwa }}</h3>
            <h4>{{ $text }}</h4>
         </div>
         <div class='post_right'>
            <img class='star' src="{{ asset('icons/full-star.png') }}">
            <a> {{ number_format($rate, 1, ".", "") }} </a>
            <table><tr><td> {{ number_format($countOfRates, 0, ".", " ") }} ocen</td></tr><tr><td> {{ number_format($score, 0, ".", " ") }} pkt.</td></tr></table>
         </div>
      </div>
      <p>{{ $photo->opis }}</p>
      <div>
         <a href="{{ route('photo', ['id' => $photo->id]) }}">
            <img class='img' src="{{ asset('images/'.$photo->adres) }}">
         </a>
      </div> 
   </div>
   @endforeach
   @else
      <h1 id='brak_tresci'>Brak tresci do wyswietlenia</h2>
   @endif

   <div id='choose_page'>

@php

if(isset($hashtag))
{
   $route = '#';
   $ask = '';
}
else if(isset($ask))
{
   $route = 'search.show';
   $hashtag = '';
}
else
{
   $route = 'przegladaj';
   $ask = '';
   $hashtag = '';
}

function zmienne($a, $hashtag, $ask)
{
   if(!empty($hashtag))
   {
      return ['hashtag' => $hashtag, 'page' => $a];
   }
   else if(!empty($ask))
   {
      return ['ask' => $ask, 'page' => $a];
   }
   else
   {
      return ['page' => $a];
   }
}

@endphp


@if ($count >= 100)

   @if ($page == 1)
   
     <a href="{{ route($route, zmienne(1, $hashtag, $ask)) }}"><div id='activ'>1</div></a>

       @for ($i = $page+1; $i < $page + 10; $i++)
         <a href="{{ route($route, zmienne($i, $hashtag, $ask)) }}"><div>{{ $i }}</div></a>
       @endfor

   @elseif ($count - $page*10 <= 70) 

     @for ($i = ceil($page/10)-9; $i <= ceil($page/10); $i++)     
       @if ($i == $page)
         <a href="{{ route($route, zmienne($i, $hashtag, $ask)) }}"><div id='activ'>{{ $i }}</div></a>
       @else 
         <a href="{{ route($route, zmienne($i, $hashtag, $ask)) }}"><div>{{ $i }}</div></a>
       @endif
     @endfor

   @else 
     <a href="{{ route($route, zmienne($page-1, $hashtag, $ask)) }}"><div id='activ'>{{ $page-1 }}</div></a>
     <a href="{{ route($route, zmienne($page, $hashtag, $ask)) }}"><div id='activ'>{{ $page }}</div></a>
     @for ($i = $page+1; $i < $page+9; $i++)          
       <a href=href="{{ route($route, zmienne($i, $hashtag, $ask)) }}"><div>{{ $i }}</div></a>
     @endfor
   @endif

@elseif ($count <= 10)
@else 
   @for ($i = 1; $i <= ceil($count/10); $i++)
     @if ($i == $page)
       <a href="{{ route($route, zmienne($i, $hashtag, $ask)) }}"><div id='activ'>{{ $i }}</div></a>
     @else
       <a href="{{ route($route, zmienne($i, $hashtag, $ask)) }}"><div>{{ $i }}</div></a>
     @endif 
   @endfor
@endif

</div>

</div>
@endsection

@section('js')

@endsection