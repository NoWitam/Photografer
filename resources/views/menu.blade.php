<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
        @yield('css')

        <title> @if (Auth::check()) {{ Auth::user()->name }} @endif </title>

    </head>
    <body>
         
    <nav id='menu'>
 
 <div>
    <div id='magnifier' class='menu_item'>
       <img src="{{ asset('icons/magnifier.png') }}" alt='szukaj'><br>
       Szukaj
    </div>
    
   @if (Auth::check())
    <a href="{{ route('user.show', ['id' => Auth::user()->id, 'page' => 1]) }}">
    <div id='user' class='menu_item'>
       <img src="{{ asset('icons/user.png') }}" alt='profil'><br>
       Profil
    </div>
    </a>
    @endif
     
    <a href="{{ route('top', ['daysAgo' => 'all']) }}">
    <div id='podium' class='menu_item'>
       <img src="{{ asset('icons/podium.png') }}" alt='TOP'><br>
      TOP
    </div>
    </a>
    
   @if (Auth::check())
    <a href="{{ route('przegladaj', ['page' => 1]) }}">
    <div id='post' class='menu_item'>
       <img src="{{ asset('icons/post.png') }}" alt='przeglądaj'><br>
      Przeglądaj
    </div>
    </a>
  @endif

  </div>

  @if (Auth::check())
  <div>
     <form method="GET" action="{{ route('user.logout') }}">
        <input type='submit' id='logout' value="Wyloguj">
     </form>
  </div>
  @else
  <div>
     <input type='button' id='log' value="ZALOGUJ">
     <input type='button' id='sign' value="DOŁĄCZ">
  </div>
  @endif
</nav>         
<div id='main'>

<!-- RESZTA -->
@yield('content')

</div>


<div id='hidden'>

@if (Auth::check())

@else 
 <div class='hidden_center' id='zaloguj_center'>
 <form method="POST" action="{{ route('user.loguj') }}">
    {{ csrf_field() }}
 <div id='zaloguj' class='hidden_div'>
    <div class='zaloguj_side'>
       <div><h2>Zaloguj się</h2></div>
       <div id='zaloguj_x'><h2>X</h2></div>
    </div>
    <div>
       <input type='text' name='email' class='left' placeholder='Email'>
       <input type='password' name='password' placeholder='Hasło'>
    </div>
    <div class='zaloguj_side'>
       <div></div>
       <div><input type='submit' value="Zaloguj"></div>
    </div>
 </div>
 </form>
 </div> 

 <div class='hidden_center' id='dolacz_center'>
 <form method="POST" action="{{ route('user.dodaj') }}">
    {{ csrf_field() }}
 <div id='dolacz' class='hidden_div'>
    <div class='zaloguj_side'>
       <div><h2>Zarejestruj się</h2></div>
       <div id='dolacz_x'><h2>X</h2></div>
    </div>
    <div>
       <input type='text' name='nazwa' class='left' placeholder='Nazwa'>
       <input type='text' name='email' placeholder='Email'>
    </div>
     <div>
       <input type='password' name='haslo' class='left' placeholder='Hasło'>
       <input type='password' name='p_haslo' placeholder='Powtórz hasło'>
    </div>
    @if ($errors->any() && !Auth::check())
    <div class="error" id='error'>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class='zaloguj_side'>
       <div></div>
       <div><input type='submit' value='Dołącz'></div>
    </div>
   </div>
   </form>
   </div> 
@endif
 <div id='search'>
    <div class='zaloguj_side'>
       <div><h2 id='napis'>Szukaj zdjęcia, użytkownika, hashtagu</h2></div>
       <div><h2 id='search_x'>X</h2></div>
</div>
   <form method="GET" action="{{ route('search.ask') }}">
      <div><input type='text' name='ask' id='search_input'></div>
   </form>
 </div>              

</div>


@if (!Auth::check())
   <script src="{{ asset('js/menuUnLog.js') }}"></script>
@endif

<script src="{{ asset('js/search.js') }}"></script>

@if (session()->has('hidden') && session()->get('hidden') == 'zaloguj')
   <script>
     document.body.style.overflow = "hidden";
     document.getElementById("menu").style.filter = "blur(80px)";
     document.getElementById("main").style.filter = "blur(80px)";
     document.getElementById("zaloguj").style.visibility = 'visible';
     document.getElementById("zaloguj").style.pointerEvents = "auto";
     document.getElementById("main").style.pointerEvents = "none";
     document.getElementById("menu").style.pointerEvents = "none";
     document.getElementById("main").style.zIndex = "1";
     document.getElementById("zaloguj_center").style.zIndex = "15";
   </script>
@endif

@if (session()->get('hidden') == 'dolacz' ||  ($errors->any() && !Auth::check() ) )
   <script>
     document.body.style.overflow = "hidden";
     document.getElementById("menu").style.filter = "blur(80px)";
     document.getElementById("main").style.filter = "blur(80px)";
     document.getElementById("dolacz").style.visibility = 'visible';
     document.getElementById("dolacz").style.pointerEvents = "auto";
     document.getElementById("main").style.pointerEvents = "none";
     document.getElementById("menu").style.pointerEvents = "none";
     document.getElementById("main").style.zIndex = "1";
     document.getElementById("dolacz_center").style.zIndex = "15";
   </script>
@endif

@yield('js')

    </body>
</html>
