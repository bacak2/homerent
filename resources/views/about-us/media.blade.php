@extends ('layout.layout')
@section('title', 'Media')

@section('content')
<div class="container">
    <img style="width: 100%; height: auto;" src='{{ asset("images/about_us/mainImg.png") }}'>

    <h1 class="h1-owners mt-5 mb-4">Media</h1>

    <div class="row mb-2">
        <div class="col-1 mobile-none tablet-none"></div>
        <div class="col-12 col-lg-11">
            <a href="{{route('aboutUs.news')}}" style="color: #0066CC; font-size: 24px; font-weight: bold">Aktualności »</a>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-1 mobile-none tablet-none"></div>
        <div class="col-12 col-md-4 col-lg-3">
            <img class="img-fluid" src="{{asset('images/media/newsIcon.png')}}">
        </div>
        <div class="col-12 col-md-8 col-lg-7">
            <div class="row mb-2">
                <div class="col-12" style="color: #0066CC; font-size: 16px; font-weight: bold">
                    <a href="{{route('aboutUs.newsDetail', 0)}}">Ponad 100 obiektów z okolic Śląska w naszej ofercie.</a>.
                </div>
            </div>
            <div class="row mb-2" style="display: inline-block">
                <div class="col-12 font-14">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient...
                    <a href="{{route('aboutUs.newsDetail', 0)}}" class="bold font-16">»</a>
                </div>
            </div>
            <div class="row font-11" style="color: #999999;">
                <div class="col-12">
                    14 kwietnia 2014
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-1 mobile-none tablet-none"></div>
        <div class="col-12 col-md-4 col-lg-3">
            <img class="img-fluid" src="{{asset('images/media/newsIcon.png')}}">
        </div>
        <div class="col-12 col-md-8 col-lg-7">
            <div class="row mb-2">
                <div class="col-12" style="color: #0066CC; font-size: 16px; font-weight: bold">
                    <a href="{{route('aboutUs.newsDetail', 0)}}">Ponad 100 obiektów z okolic Śląska w naszej ofercie.</a>.
                </div>
            </div>
            <div class="row mb-2" style="display: inline-block">
                <div class="col-12 font-14">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient...
                    <a href="{{route('aboutUs.newsDetail', 0)}}" class="bold font-16">»</a>
                </div>
            </div>
            <div class="row font-11" style="color: #999999;">
                <div class="col-12">
                    14 kwietnia 2014
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-1 mobile-none tablet-none"></div>
        <div class="col-12 col-md-4 col-lg-3">
            <img class="img-fluid" src="{{asset('images/media/newsIcon.png')}}">
        </div>
        <div class="col-12 col-md-8 col-lg-7">
            <div class="row mb-2">
                <div class="col-12" style="color: #0066CC; font-size: 16px; font-weight: bold">
                    <a href="{{route('aboutUs.newsDetail', 0)}}">Ponad 100 obiektów z okolic Śląska w naszej ofercie.</a>.
                </div>
            </div>
            <div class="row mb-2" style="display: inline-block">
                <div class="col-12 font-14">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient...
                    <a href="{{route('aboutUs.newsDetail', 0)}}" class="bold font-16">»</a>
                </div>
            </div>
            <div class="row font-11" style="color: #999999;">
                <div class="col-12">
                    14 kwietnia 2014
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-5" style="color: #0066CC; font-size: 16px; font-weight: bold">
        <div class="col-8 mobile-none tablet-none"></div>
        <div class="col-12 col-md-4"><a href="{{route('aboutUs.news')}}">Zobacz wszystko »</a></div>
    </div>

    <div class="row mb-2">
        <div class="col-1 mobile-none tablet-none"></div>
        <div class="col-12 col-md-11">
            <a href="{{route('aboutUs.news')}}" style="color: #0066CC; font-size: 24px; font-weight: bold">O nas w mediach »</a>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-1 mobile-none tablet-none"></div>
        <div class="col-12 col-md-4 col-lg-3">
            <img class="img-fluid" src="{{asset('images/media/newsIcon.png')}}">
        </div>
        <div class="col-12 col-md-8 col-lg-7">
            <div class="row mb-2">
                <div class="col-12" style="color: #0066CC; font-size: 16px; font-weight: bold">
                    <a href="{{route('aboutUs.newsDetail', 0)}}">Ponad 100 obiektów z okolic Śląska w naszej ofercie.</a>.
                </div>
            </div>
            <div class="row mb-2" style="display: inline-block">
                <div class="col-12 font-14">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient...
                    <a href="{{route('aboutUs.newsDetail', 0)}}" class="bold font-16">»</a>
                </div>
            </div>
            <div class="row font-11" style="color: #999999;">
                <div class="col-12">
                    14 kwietnia 2014
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-1 mobile-none tablet-none"></div>
        <div class="col-12 col-md-4 col-lg-3">
            <img class="img-fluid" src="{{asset('images/media/newsIcon.png')}}">
        </div>
        <div class="col-12 col-md-8 col-lg-7">
            <div class="row mb-2">
                <div class="col-12" style="color: #0066CC; font-size: 16px; font-weight: bold">
                    <a href="{{route('aboutUs.newsDetail', 0)}}">Ponad 100 obiektów z okolic Śląska w naszej ofercie.</a>.
                </div>
            </div>
            <div class="row mb-2" style="display: inline-block">
                <div class="col-12 font-14">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient...
                    <a href="{{route('aboutUs.newsDetail', 0)}}" class="bold font-16">»</a>
                </div>
            </div>
            <div class="row font-11" style="color: #999999;">
                <div class="col-12">
                    14 kwietnia 2014
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-1 mobile-none tablet-none"></div>
        <div class="col-12 col-md-4 col-lg-3">
            <img class="img-fluid" src="{{asset('images/media/newsIcon.png')}}">
        </div>
        <div class="col-12 col-md-8 col-lg-7">
            <div class="row mb-2">
                <div class="col-12" style="color: #0066CC; font-size: 16px; font-weight: bold">
                    <a href="{{route('aboutUs.newsDetail', 0)}}">Ponad 100 obiektów z okolic Śląska w naszej ofercie.</a>.
                </div>
            </div>
            <div class="row mb-2" style="display: inline-block">
                <div class="col-12 font-14">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient...
                    <a href="{{route('aboutUs.newsDetail', 0)}}" class="bold font-16">»</a>
                </div>
            </div>
            <div class="row font-11" style="color: #999999;">
                <div class="col-12">
                    14 kwietnia 2014
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-5" style="color: #0066CC; font-size: 16px; font-weight: bold">
        <div class="col-8 mobile-none tablet-none"></div>
        <div class="col-12 col-md-4"><a href="{{route('aboutUs.news')}}">Zobacz wszystko »</a></div>
    </div>

    <div class="row" style="margin-bottom: 86px">
        <div class="col-1 mobile-none tablet-none"></div>
        <div class="col-md-6 col-lg-7">
            <div class="row">
                <div class="col-12">
                    <a href="/resources-to-download" style="color: #0066CC; font-size: 24px; font-weight: bold">Materiały do pobrania »</a>
                </div>
            </div>
            <div class="row">
                <div class="col-6 col-md-4 mb-4">
                    <a class="to-download-description" href="{{route('aboutUs.getDownload', ['logo', 'zip'])}}">
                        <img src="{{asset('images/media/File_300.png')}}">
                        <div class="mt-2">
                            <img src="{{asset('images/media/Floppy_24.png')}}">
                            <span class="font-13">Logo</span>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-4 mb-4">
                    <a class="to-download-description" href="{{route('aboutUs.getDownload', ['zdjecia_produktow', 'zip'])}}">
                        <img src="{{asset('images/media/File_300.png')}}">
                        <div class="mt-2">
                            <img src="{{asset('images/media/Floppy_24.png')}}">
                            <span class="font-13">Zdjęcia produktów</span>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-4 mb-4">
                    <a class="to-download-description" href="{{route('aboutUs.getDownload', ['raport_roczny', 'pdf'])}}">
                        <img src="{{asset('images/media/File_300.png')}}">
                        <div class="mt-2">
                            <img src="{{asset('images/media/Floppy_24.png')}}">
                            <span class="font-13">Raport roczny</span>
                        </div>
                    </a>
                </div>

            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div style="color: #0066CC; font-size: 24px; font-weight: bold">Skontaktuj się z nami</div>
            <div style="padding: 20px; border: 1px solid rgba(121, 121, 121, 1); background-color: rgba(242, 242, 242, 1);">
                <div class="row my-2">
                    <div class="col-3">
                        <img src="{{asset('images/contact/forMediaPhoto.png')}}">
                    </div>
                    <div class="col-9">
                        <div class="bold">Anna Mroczko</div>
                        <div class="font-11 mt-2">Specjalista ds.kontaktów z mediami</div>
                    </div>
                </div>
                <button class="btn btn-black writeToUsOpen" style="width: 100%">Napisz do nas</button>
                <div class="mt-3">
                    <img src="{{asset('images/media/phone.png')}}">
                    <span class="ml-1">+48 18 20 64 002</span>
                </div>
                <div class="mt-3">
                    <img src="{{asset('images/media/Envelop_24.png')}}">
                    <a href="mailto: media@aaaa.pl" class="ml-1">media@aaaa.pl</a>
                </div>
            </div>
        </div>
    </div>

    <div style="position: relative; height: 330px; margin-bottom: 130px">
        <iframe style="position: absolute; left: 50%; transform: translateX(-50%); max-width: 100%; max-height: auto" width="660" height="330" src="https://www.youtube.com/embed/eCY6V3Scdfc" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
    </div>
</div>

@include('includes.write-to-us')

@endsection