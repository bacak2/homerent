@extends ('layout.layout')
@section('title', __('messages.Resources to download'))

@section('content')
<div class="container">
    <img style="width: 100%; height: auto;" src='{{ asset("images/about_us/mainImg.png") }}'>

    <div class="row mt-2">
        <div class="col-lg-1">
            <a class="font-13" href="{{ url()->previous() }}"><&nbsp;{{ __('messages.Back') }}</a>
        </div>
        <div class="col-lg-10">
            <h1 class="h1-owners mb-4">{{ __('messages.Resources to download') }}</h1>
            <div class="row">
                <div class="col-6 col-md-2 mb-5 mr-0 mr-lg-3">
                    <a class="to-download-description" href="{{route('aboutUs.getDownload', ['logo', 'zip'])}}">
                        <img class="img-fluid" src="{{asset('images/media/File_300.png')}}">
                        <div class="mt-2">
                            <img src="{{asset('images/media/Floppy_24.png')}}">
                            <span class="font-13">Logo</span>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-2 mb-5 mr-0 mr-lg-3">
                    <a class="to-download-description" href="{{route('aboutUs.getDownload', ['zdjecia_produktow', 'zip'])}}">
                        <img class="img-fluid" src="{{asset('images/media/File_300.png')}}">
                        <div class="mt-2">
                            <img src="{{asset('images/media/Floppy_24.png')}}">
                            <span class="font-13">{{ __('messages.Photos of products') }}</span>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-2 mb-5 mr-0 mr-lg-3">
                    <a class="to-download-description" href="{{route('aboutUs.getDownload', ['raport_roczny', 'pdf'])}}">
                        <img class="img-fluid" src="{{asset('images/media/File_300.png')}}">
                        <div class="mt-2">
                            <img src="{{asset('images/media/Floppy_24.png')}}">
                            <span class="font-13">{{ __('messages.Annual report') }}</span>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-2 mb-5 mr-0 mr-lg-3">
                    <a class="to-download-description" href="{{route('aboutUs.getDownload', ['raport_roczny', 'pdf'])}}">
                        <img class="img-fluid" src="{{asset('images/media/File_300.png')}}">
                        <div class="mt-2">
                            <img src="{{asset('images/media/Floppy_24.png')}}">
                            <span class="font-13">Lorem ipsum</span>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-2 mb-5 mr-0 mr-lg-3">
                    <a class="to-download-description" href="{{route('aboutUs.getDownload', ['raport_roczny', 'pdf'])}}">
                        <img class="img-fluid" src="{{asset('images/media/File_300.png')}}">
                        <div class="mt-2">
                            <img src="{{asset('images/media/Floppy_24.png')}}">
                            <span class="font-13">Lorem ipsum</span>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-2 mb-5 mr-0 mr-lg-3">
                    <a class="to-download-description" href="{{route('aboutUs.getDownload', ['raport_roczny', 'pdf'])}}">
                        <img class="img-fluid" src="{{asset('images/media/File_300.png')}}">
                        <div class="mt-2">
                            <img src="{{asset('images/media/Floppy_24.png')}}">
                            <span class="font-13">Lorem ipsum</span>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-2 mb-5 mr-0 mr-lg-3">
                    <a class="to-download-description" href="{{route('aboutUs.getDownload', ['raport_roczny', 'pdf'])}}">
                        <img class="img-fluid" src="{{asset('images/media/File_300.png')}}">
                        <div class="mt-2">
                            <img src="{{asset('images/media/Floppy_24.png')}}">
                            <span class="font-13">Lorem ipsum</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-4" style="position: relative; height: 330px">
        <iframe style="position: absolute; left: 50%; transform: translateX(-50%); max-width: 100%;" width="660" height="330" src="https://www.youtube.com/embed/eCY6V3Scdfc" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
    </div>

</div>
@endsection