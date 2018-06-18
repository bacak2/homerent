@extends ('layout.layout')
@section('title', 'Materiały do pobrania')

@section('content')
<div class="container">
    <img style="width: 100%; height: auto;" src='{{ asset("images/about_us/mainImg.png") }}'>

    <div class="row mt-2">
        <div class="col-2 col-md-1">
            <a class="font-13" href="{{ url()->previous() }}"><&nbsp;Powrót</a>
        </div>
        <div class="col-8 col-md-10">
            <h1 class="h1-owners mb-4">Materiały do pobrania</h1>
            <div class="row">
                <div class="col-12 col-md-2 mb-5 mr-3">
                    <a class="to-download-description" href="{{route('aboutUs.getDownload', ['logo', 'zip'])}}">
                        <img src="{{asset('images/media/resourcesIconBig.png')}}">
                        <div class="mt-2">
                            <img src="{{asset('images/media/resourcesIconSmall.png')}}">
                            <span class="font-13">Logo</span>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-md-2 mb-5 mr-3">
                    <a class="to-download-description" href="{{route('aboutUs.getDownload', ['zdjecia_produktow', 'zip'])}}">
                        <img src="{{asset('images/media/resourcesIconBig.png')}}">
                        <div class="mt-2">
                            <img src="{{asset('images/media/resourcesIconSmall.png')}}">
                            <span class="font-13">Zdjęcia produktów</span>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-md-2 mb-5 mr-3">
                    <a class="to-download-description" href="{{route('aboutUs.getDownload', ['raport_roczny', 'pdf'])}}">
                        <img src="{{asset('images/media/resourcesIconBig.png')}}">
                        <div class="mt-2">
                            <img src="{{asset('images/media/resourcesIconSmall.png')}}">
                            <span class="font-13">Raport roczny</span>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-md-2 mb-5 mr-3">
                    <a class="to-download-description" href="{{route('aboutUs.getDownload', ['raport_roczny', 'pdf'])}}">
                        <img src="{{asset('images/media/resourcesIconBig.png')}}">
                        <div class="mt-2">
                            <img src="{{asset('images/media/resourcesIconSmall.png')}}">
                            <span class="font-13">Lorem ipsum</span>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-md-2 mb-5 mr-3">
                    <a class="to-download-description" href="{{route('aboutUs.getDownload', ['raport_roczny', 'pdf'])}}">
                        <img src="{{asset('images/media/resourcesIconBig.png')}}">
                        <div class="mt-2">
                            <img src="{{asset('images/media/resourcesIconSmall.png')}}">
                            <span class="font-13">Lorem ipsum</span>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-md-2 mb-5 mr-3">
                    <a class="to-download-description" href="{{route('aboutUs.getDownload', ['raport_roczny', 'pdf'])}}">
                        <img src="{{asset('images/media/resourcesIconBig.png')}}">
                        <div class="mt-2">
                            <img src="{{asset('images/media/resourcesIconSmall.png')}}">
                            <span class="font-13">Lorem ipsum</span>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-md-2 mb-5 mr-3">
                    <a class="to-download-description" href="{{route('aboutUs.getDownload', ['raport_roczny', 'pdf'])}}">
                        <img src="{{asset('images/media/resourcesIconBig.png')}}">
                        <div class="mt-2">
                            <img src="{{asset('images/media/resourcesIconSmall.png')}}">
                            <span class="font-13">Lorem ipsum</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-4" style="position: relative; height: 330px">
        <iframe style="position: absolute; left: 50%; transform: translateX(-50%); max-width: 100%; max-height: auto" width="660" height="330" src="https://www.youtube.com/embed/eCY6V3Scdfc" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
    </div>

</div>
@endsection