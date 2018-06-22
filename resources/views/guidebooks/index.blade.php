@extends ('layout.layout')
@section('title', 'Przewodniki')

@section('content')
<div class="container">
    <div class="row mt-2 mb-4">
        <div class="col-12 font-13">
            <a href="/">Start ></a> <span class="bold">Przewodniki</span>
        </div>
    </div>

    @include('includes.slider-guidebooks')

    <div class="row mt-4 mb-3">
        <div class="col-12 col-md-4">
            <div class="row">
                <div class="col-12">
                    <h2 class="h2-guidebooks">Popularne miasta</h2>
                    <div class="mb-3" style="position: relative">
                        <a class="to-download-description" href="{{route('guidebooks.Detail', 'krakowski-kazimierz')}}">
                            <img style="width:100%" src="{{asset('images/main/guidebook.png')}}">
                        </a>
                        <div class="guidebooks-top-description">Kraków</div>
                        <div class="guidebooks-bottom-description">Przewodnik</div>
                    </div>
                    <div class="mb-3" style="position: relative">
                        <a class="to-download-description" href="{{route('guidebooks.Detail', 'krakowski-kazimierz')}}">
                            <img style="width:100%" src="{{asset('images/main/guidebook.png')}}">
                        </a>
                        <div class="guidebooks-top-description">Lorem ipsum</div>
                        <div class="guidebooks-bottom-description">Przewodnik</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="row">
                <div class="col-12">
                    <h2 class="h2-guidebooks">Wypoczynek</h2>
                    <div class="mb-3" style="position: relative">
                        <a class="to-download-description" href="{{route('guidebooks.Detail', 'krakowski-kazimierz')}}">
                            <img style="width:100%" src="{{asset('images/main/guidebook.png')}}">
                        </a>
                        <div class="guidebooks-top-description">Kraków</div>
                        <div class="guidebooks-bottom-description">Przewodnik</div>
                    </div>
                    <div class="mb-3" style="position: relative">
                        <a class="to-download-description" href="{{route('guidebooks.Detail', 'krakowski-kazimierz')}}">
                            <img style="width:100%" src="{{asset('images/main/guidebook.png')}}">
                        </a>
                        <div class="guidebooks-top-description">Lorem ipsum</div>
                        <div class="guidebooks-bottom-description">Przewodnik</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="row">
                <div class="col-12">
                    <h2 class="h2-guidebooks">Podróż</h2>
                    <div class="mb-3" style="position: relative">
                        <a class="to-download-description" href="{{route('guidebooks.Detail', 'krakowski-kazimierz')}}">
                            <img style="width:100%" src="{{asset('images/main/guidebook.png')}}">
                        </a>
                        <div class="guidebooks-top-description">Kraków</div>
                        <div class="guidebooks-bottom-description">Przewodnik</div>
                    </div>
                    <div class="mb-3" style="position: relative">
                        <a class="to-download-description" href="{{route('guidebooks.Detail', 'krakowski-kazimierz')}}">
                            <img style="width:100%" src="{{asset('images/main/guidebook.png')}}">
                        </a>
                        <div class="guidebooks-top-description">Lorem ipsum</div>
                        <div class="guidebooks-bottom-description">Przewodnik</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-12 col-md-4">
            <div class="row">
                <div class="col-12">
                    <h2 class="h2-guidebooks">Pozostałe miasta</h2>
                    <a class="d-block" href="{{route('guidebooks.Detail', 'krakowski-kazimierz')}}">Lorem ipsum</a>
                    <a class="d-block" href="{{route('guidebooks.Detail', 'krakowski-kazimierz')}}">Lorem ipsum</a>
                    <a class="d-block" href="{{route('guidebooks.Detail', 'krakowski-kazimierz')}}">Lorem ipsum</a>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="row">
                <div class="col-12">
                    <h2 class="h2-guidebooks">Miejsca do wypoczynku</h2>
                    <a class="d-block" href="{{route('guidebooks.Detail', 'krakowski-kazimierz')}}">Lorem ipsum</a>
                    <a class="d-block" href="{{route('guidebooks.Detail', 'krakowski-kazimierz')}}">Lorem ipsum</a>
                    <a class="d-block" href="{{route('guidebooks.Detail', 'krakowski-kazimierz')}}">Lorem ipsum</a>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="row">
                <div class="col-12">
                    <h2 class="h2-guidebooks">Inne podróże</h2>
                    <a class="d-block" href="{{route('guidebooks.Detail', 'krakowski-kazimierz')}}">Lorem ipsum</a>
                    <a class="d-block" href="{{route('guidebooks.Detail', 'krakowski-kazimierz')}}">Lorem ipsum</a>
                    <a class="d-block" href="{{route('guidebooks.Detail', 'krakowski-kazimierz')}}">Lorem ipsum</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection