@extends('menu')

@section('css')
   <link rel="stylesheet" href="{{ asset('css/dodaj_zdjecie.css') }}">
@endsection

@section('content')
<div id='add_center'>
@if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <form method='POST' action="{{ route('photo.add') }}" files="true" enctype="multipart/form-data">
    {{ csrf_field() }}
        <div> <input type='text' name='nazwa' minlength='3' maxlength="15" placeholder="Nazwa ..."> </div>
        <div> 
            <input type='file' name='image' id='file' accept='image/jpeg'> 
            <label for='file' id='dodaj'>Wybierz zdjęcie ..</label>
        </div>
        <div> <textarea rows='8' name='description' placeholder="Opis ..." cols='50' spellcheck='false' wrap='hard' autocorrect='off' ng-trim="false" maxlength='300'></textarea> </div>
        <div id='hashtags_div'> <input type='text' minlength='1' maxlength="8" placeholder="Hashtag" id='hashtag'> <button id='button' type='button' onClick='nowyHashtag()' >+</button> </div>
        <div id='hashtags'> </div>
        <div id='submit_center'> <input type='submit' value='Zatwierdź'> </div>
    </form>
</div>
@endsection

@section('js')
<script src="{{ asset('js/dodaj_zdjecie.js') }}"> </script>
@endsection