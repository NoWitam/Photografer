@extends('menu')

@section('css')
   <link rel="stylesheet" href="{{ asset('css/photo.css') }}">
@endsection

@php
   $rate = $photo->getRate();
   $count = $photo->getCount();
   $score = ($rate-3) * $count;
@endphp

@section('content')
<div id='photo_center'>
<div id='photo'>
   <div id='top_photo'>
      <div id='names'> <a href="{{ route('user.show', ['id' => $photo->user->id, 'page' => 1]) }}"><h2> {{ $photo->user->name }} </h2></a> <h1> {{ $photo->nazwa }} </h1></div>
      <div id='ocena'>
         <img src="{{ asset('icons/full-star.png') }}" alt='ocena'>
         <a> {{ number_format($rate, 1, ".", "") }} </a>
         <table><tr><td> {{ number_format($count, 0, ".", " ") }} ocen</td></tr><tr><td> {{ number_format($score, 0, ".", " ") }} pkt.</td></tr></table>
      </div>
    </div>
    <div><img id='mainphoto' src="{{ asset('images/'.$photo->adres) }}"></div>
    <div id='hashtags'>

       @if (!is_null($photo->hashtag1))
       <a href="{{ route('#', ['hashtag' => $photo->hashtag1, 'page' => 1]) }}">
          <div class='hashtag'>
             <table>
                <tr>
                   <td class='hash'>#</td>
                   <td>{{ $photo->hashtag1 }}</td>
                </tr>
             </table>
          </div>
       </a>
       @endif

       @if (!is_null($photo->hashtag2))
       <a href="{{ route('#', ['hashtag' => $photo->hashtag2, 'page' => 1]) }}">
          <div class='hashtag'>
             <table>
                <tr>
                   <td class='hash'>#</td>
                   <td>{{ $photo->hashtag2 }}</td>
                </tr>
             </table>
          </div>
       </a>
       @endif

       @if (!is_null($photo->hashtag3))
       <a href="{{ route('#', ['hashtag' => $photo->hashtag3, 'page' => 1]) }}">
          <div class='hashtag'>
             <table>
                <tr>
                   <td class='hash'>#</td>
                   <td>{{ $photo->hashtag3 }}</td>
                </tr>
             </table>
          </div>
       </a>
       @endif

   </div>
   <div id='opis'>
      <p> {{ $photo->opis }} </p>
   </div>
</div>

@if (Auth::check())
<div id='photo_bot'>
   <h2>Moja ocena to: </h2>
   <div id='stars'>
      <div><form method="POST" action="{{ route('photo.rate') }}">
      {{ csrf_field() }}
         <input type='hidden' name='photo_id' value='{{ $photo->id }}'>
         <input type='hidden' name='value' value='1'>
         <input type='image' id='star1' src='{{asset('icons/empty-star.png')}}'>
      </form></div>
      <div><form method="POST" action="{{ route('photo.rate') }}">
      {{ csrf_field() }}
         <input type='hidden' name='photo_id' value='{{ $photo->id }}'>
         <input type='hidden' name='value' value='2'>
         <input type='image' id='star2' src='{{asset('icons/empty-star.png')}}'>
      </form></div>
      <div><form method="POST" action="{{ route('photo.rate') }}">
      {{ csrf_field() }}
         <input type='hidden' name='photo_id' value='{{ $photo->id }}'>
         <input type='hidden' name='value' value='3'>
         <input type='image' id='star3' src='{{asset('icons/empty-star.png')}}'>
      </form></div>
      <div><form method="POST" action="{{ route('photo.rate') }}">
      {{ csrf_field() }}
         <input type='hidden' name='photo_id' value='{{ $photo->id }}'>
         <input type='hidden' name='value' value='4'>
         <input type='image' id='star4' src='{{asset('icons/empty-star.png')}}'>
      </form></div>
      <div><form method="POST" action="{{ route('photo.rate') }}">
      {{ csrf_field() }}
         <input type='hidden' name='photo_id' value='{{ $photo->id }}'>
         <input type='hidden' name='value' value='5'>
         <input type='image' id='star5' src='{{asset('icons/empty-star.png')}}'>
      </form></div>
   </div>
</div>
@endif

<div id='coms'>
   @if (Auth::check())
   <div id="my_com">
   <form method="POST" action="{{ route('photo.comment') }}">
      {{ csrf_field() }}
      <input type='hidden' name='photo_id' value="{{ $photo->id }}">
      <textarea id='area' name='value' rows='1' cols='50' maxlength='300' placeholder="Mój komentarz ..."></textarea>
      <input type='submit' value="Wyślij">
   </form>
   </div>
    @endif
       
    @foreach ($photo->comments as $comment)
    <div class='com'>
       <hr>
       <h2><a href="{{ route('user.show', ['id' => $comment->user->id, 'page' => 1]) }}"> {{ $comment->user->name }} </a></h2>
       <p> {{ $comment->value }} </p>
       </p>
    </div>
    @endforeach

</div>
</div>
@endsection

@section('js')
@if (Auth::check())
<script>
 let elements = new Array(5);
 let kursor = false;
 
 let rate = "{{ Rate::myRate($photo->id) }}";

 for(let i=0; i < 5; i++)
 {
    elements[i] = document.getElementById("star"+(i+1));
 }

 for(let i=0; i < 5; i++)
 {
    elements[i].addEventListener("mouseover", () => { ocena(i+1) });
    elements[i].addEventListener("mouseout", () => { ocenaOut() });
 }
 
for(let i=0; i < rate; i++)
{
   elements[i].src = "{{ asset('icons/full-star.png') }}";
}

 function ocena(numer)
 {
    kursor = true;
  for(let i=0; i < numer; i++)
  {
     elements[i].src = "{{ asset('icons/full-star.png') }}";
  }
  for(let i = numer; i < 5; i++)
  {
     elements[i].src = "{{ asset('icons/empty-star.png') }}";     
  }
 }

 function ocenaOut()
 {
    kursor = false;
     setTimeout( () => {
         if(!kursor)
         {
            for(let i=0; i < rate; i++)
            {
               elements[i].src = "{{ asset('icons/full-star.png') }}";   
            }
            for(let i=rate; i < 5; i++)
            {
               elements[i].src = "{{ asset('icons/empty-star.png') }}";
            }
         }       
     },50);
 }

 let mycom = document.getElementById("area");
 mycom.addEventListener('input', () => {
    if(mycom.value.length == mycom.rows*50 && mycom.value.length < 300)
    {
        mycom.rows++;
    }

 });
</script>
@endif
@endsection