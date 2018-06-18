@extends ('layout.layout')

@section('title', __('Ulubione') )

@section('content')

<div class="container">
    <h1>Ulubione</h1>
    <div class="row" style="margin-bottom: 40px">
        <div class="col-3">
            Dodaj do ulubionych
        </div>
        <div class="col-1"></div>
        <div class="col-3">
            Porównaj obiekty
        </div>
        <div class="col-1"></div>
        <div class="col-3">
            Wyślij znajomym
        </div>
    </div>
    <div class="row" style="margin-bottom: 88px">
        <div class="col-12">
            <h2>Jak dodać obiekt do ulubionych?</h2>
        </div>
        <div class="col-6">
            <span>
                Kliknij ikonę serca w prawym górnym rogu zapowiedzi obiektu.<br>
                Jeśli chcesz usunąć z ulubionych - kliknij ikonę serca ponownie.
            </span>
            <img src="{{ asset("images/favourites/empty1.png") }}">
        </div>
        <div class="col-6">
            <span>
                Lub na stronie apartamentu
            </span>
            <br><br>
            <img src="{{ asset("images/favourites/empty2.png") }}">
        </div>
    </div>
</div>

@endsection