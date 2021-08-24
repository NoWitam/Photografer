@extends('menu')

@section('css')
   <link rel="stylesheet" href="{{ asset('css/profil.css') }}">
@endsection

@section('content')
<div id='profil_center'>

  <div id='profil_top'>
    <h1> {{ $user->name }} </h1>
    <div id='buttons'>
    @if (Auth::check())
       @if (Auth::id() == $user->id)
          <div class='profil_panel' id='edytuj_opis' onClick='changeDescription()'> <img src="{{ asset("icons/description.png") }}"> <a id='edytuj_opis_a' >Zmień opis</a> </div>
          <a href="{{ route('photo.addPage') }}"> <div class='profil_panel' id='dodaj_zdjecie'> <img src="{{ asset("icons/add.png") }}"> <span>Dodaj zdjęcie</span> </div> </a>
       @else
          @if($isFollow)
             <form method='POST' action="{{ route('user.unfollow') }}">
             {{ csrf_field() }}
             <label for='unfollow_submit' class='profil_panel' id='follow'><img src="{{ asset("icons/eye.png") }}"> <a>Obserwujesz!</a></label>
             <input type='hidden' name='id' value="{{ $user->id }}">
             <input type='submit' id='unfollow_submit'>
             </form>
          @else
             <form method='POST' action="{{ route('user.follow') }}">
             {{ csrf_field() }}
             <label for='follow_submit' class='profil_panel' id='unfollow'><img src="{{ asset("icons/eye.png") }}"> <a>Obserwuj</a></label>
             <input type='hidden' name='id' value="{{ $user->id }}">
             <input type='submit' id='follow_submit'>
             </form>
          @endif
       @endif
    @endif
    </div>
    <form method="POST" action="{{ route('user.description') }}" id="opis_form" >
    {{ csrf_field() }}
       <textarea rows='8' id='description' name='description' cols='50' spellcheck='false' wrap='hard' autocorrect='off' ng-trim="false" maxlength='300' readonly>{{ $user->opis }}</textarea>
    </form>
  </div>

  <div id='images'>
  @foreach ($photos as $photo)
    <div class='img'>
       <div class='top_photo'>
          <div><h1> {{ $photo->nazwa }} </h1></div>
          <div class='ocena'>
             <img src="{{ asset('icons/full-star.png') }}" alt='ocena'>
             <a>{{ number_format($photo->getRate(), 1, ".", "") }}</a>
           </div>
        </div>
     <a href="{{ route('photo', ['id' => $photo->id]) }}"> <img class='img_main' src="{{ asset('images/'.$photo->adres) }}"> </a>
    </div> 
    @endforeach  
  </div
  </div>

  <div id='choose_page'>

   @if ($count >= 100)

      @if ($page == 1)
      
        <a href="{{ route('user.show', ['id' => $user->id, 'page' => 1]) }}"><div id='activ'>1</div></a>

          @for ($i = $page+1; $i < $page + 10; $i++)
            <a href="{{ route('user.show', ['id' => $user->id, 'page' => $i]) }}"><div>{{ $i }}</div></a>
          @endfor

      @elseif ($count - $page*10 <= 70) 

        @for ($i = ceil($page/10)-9; $i <= ceil($page/10); $i++)     
          @if ($i == $page)
            <a href="{{ route('user.show', ['id' => $user->id, 'page' => $i]) }}"><div id='activ'>{{ $i }}</div></a>
          @else 
            <a href="{{ route('user.show', ['id' => $user->id, 'page' => $i]) }}"><div>{{ $i }}</div></a>
          @endif
        @endfor

      @else 
        <a href="{{ route('user.show', ['id' => $user->id, 'page' => $page-1]) }}"><div id='activ'>{{ $page-1 }}</div></a>
        <a href="{{ route('user.show', ['id' => $user->id, 'page' => $page]) }}"><div id='activ'>{{ $page }}</div></a>
        @for ($i = $page+1; $i < $page+9; $i++)          
          <a href="{{ route('user.show', ['id' => $user->id, 'page' => $i]) }}"><div>{{ $i }}</div></a>
        @endfor
      @endif

   @elseif ($count <= 10)
   @else 
      @for ($i = 1; $i <= ceil($count/10); $i++)
        @if ($i == $page)
          <a href="{{ route('user.show', ['id' => $user->id, 'page' => $i]) }}"><div id='activ'>{{ $i }}</div></a>
        @else
          <a href="{{ route('user.show', ['id' => $user->id, 'page' => $i]) }}"><div>{{ $i }}</div></a>
        @endif 
      @endfor
  @endif

</div>

</div>

@endsection

@section('js')
<script>
  let czyWcisniety = false;
   function changeDescription()
   {
     
     if(czyWcisniety)
     {
      document.getElementById('opis_form').submit();
     }
     else
     {
      document.getElementById('description').readOnly = false;
      document.getElementById('edytuj_opis_a').innerHTML = "Zapisz opis";
      czyWcisniety = true;
      document.getElementById('edytuj_opis').style.border = "4px solid #FFC125";
      document.getElementById('description').focus({preventScroll:false});

      const przyciski = document.getElementById('buttons');
      const anuluj = document.createElement("div");
      anuluj.classList.add("profil_panel");
      anuluj.id = "anuluj";
      anuluj.style.border = "4px solid red";
      const img = document.createElement("img");
      img.src = "{{ asset('icons/description.png') }}";
      img.style.height = "36px";
      const a = document.createElement("a");
      a.innerHTML = "Anuluj";
      anuluj.appendChild(img);
      anuluj.appendChild(a);
      anuluj.addEventListener('click', function() {
        document.getElementById('description').value = "{{ $user->opis }}";
        document.getElementById('description').readOnly = true;
        document.getElementById('edytuj_opis').style.border = "4px solid white";
        document.getElementById('edytuj_opis_a').innerHTML = "Zmień opis";
        czyWcisniety = false;
        anuluj.remove();
      });
      przyciski.insertBefore(anuluj, document.getElementById('edytuj_opis')); 
     }

   }
</script>
@endsection