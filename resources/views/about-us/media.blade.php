@extends ('layout.layout')
@section('title', 'Media')

@section('content')
<div class="container">
    <img style="width: 100%; height: auto;" src='{{ asset("images/about_us/mainImg.png") }}'>

    <h1 class="h1-owners mt-5 mb-4">Media</h1>

    <div class="row mb-2">
        <div class="col-1 mobile-none tablet-none"></div>
        <div class="col-12 col-lg-11">
            <a href="{{route('aboutUs.news')}}" style="color: #0066CC; font-size: 24px; font-weight: bold">{{ __('messages.News') }} »</a>
        </div>
    </div>
    @foreach($news as $newsEntity)
        <div class="row mb-4">
            <div class="col-1 mobile-none tablet-none"></div>
            <div class="col-12 col-md-4 col-lg-3">
                <img class="img-fluid" src="{{asset('images/media/newsIcon.png')}}">
            </div>
            <div class="col-12 col-md-8 col-lg-7">
                <div class="row mb-2">
                    <div class="col-12" style="color: #0066CC; font-size: 16px; font-weight: bold">
                        <a href="{{route('aboutUs.newsDetail', $newsEntity->news_id)}}">{{$newsEntity->news_title}}</a>.
                    </div>
                </div>
                <div class="row mb-2" style="display: inline-block">
                    <div class="col-12 font-14">
                        {{ strip_tags(substr($newsEntity->news_content, 0, 220)) }}...
                        <a href="{{route('aboutUs.newsDetail', $newsEntity->news_id)}}" class="bold font-16">»</a>
                    </div>
                </div>
                <div class="row font-11" style="color: #999999;">
                    <div class="col-12">
                        {{strftime("%e %b %Y", strtotime($newsEntity->created_at))}}
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <div class="row mb-5" style="color: #0066CC; font-size: 16px; font-weight: bold">
        <div class="col-8 mobile-none tablet-none"></div>
        <div class="col-12 col-md-4"><a href="{{route('aboutUs.news')}}">{{ __('messages.See all') }} »</a></div>
    </div>

    <div class="row mb-2">
        <div class="col-1 mobile-none tablet-none"></div>
        <div class="col-12 col-md-11">
            <a href="{{route('aboutUs.news')}}" style="color: #0066CC; font-size: 24px; font-weight: bold">{{ __('messages.About us in media') }} »</a>
        </div>
    </div>
    @foreach($newsInMedia as $newsEntity)
    <div class="row mb-4">
        <div class="col-1 mobile-none tablet-none"></div>
        <div class="col-12 col-md-4 col-lg-3">
            <img class="img-fluid" src="{{asset('images/media/newsIcon.png')}}">
        </div>
        <div class="col-12 col-md-8 col-lg-7">
            <div class="row mb-2">
                <div class="col-12" style="color: #0066CC; font-size: 16px; font-weight: bold">
                    <a href="{{route('aboutUs.newsDetail', $newsEntity->news_id)}}">{{$newsEntity->news_title}}</a>.
                </div>
            </div>
            <div class="row mb-2" style="display: inline-block">
                <div class="col-12 font-14">
                    {{ strip_tags(substr($newsEntity->news_content, 0, 220)) }}...
                    <a href="{{route('aboutUs.newsDetail', $newsEntity->news_id)}}" class="bold font-16">»</a>
                </div>
            </div>
            <div class="row font-11" style="color: #999999;">
                <div class="col-12">
                    {{strftime("%e %b %Y", strtotime($newsEntity->created_at))}}
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <div class="row mb-5" style="color: #0066CC; font-size: 16px; font-weight: bold">
        <div class="col-8 mobile-none tablet-none"></div>
        <div class="col-12 col-md-4"><a href="{{route('aboutUs.news')}}">{{ __('messages.See all') }} »</a></div>
    </div>

    <div class="row" style="margin-bottom: 86px">
        <div class="col-1 mobile-none tablet-none"></div>
        <div class="col-md-6 col-lg-7">
            <div class="row">
                <div class="col-12">
                    <a href="/resources-to-download" style="color: #0066CC; font-size: 24px; font-weight: bold">{{ __('messages.Resources to download') }} »</a>
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
                            <span class="font-13">{{ __('messages.Photos of products') }}</span>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-4 mb-4">
                    <a class="to-download-description" href="{{route('aboutUs.getDownload', ['raport_roczny', 'pdf'])}}">
                        <img src="{{asset('images/media/File_300.png')}}">
                        <div class="mt-2">
                            <img src="{{asset('images/media/Floppy_24.png')}}">
                            <span class="font-13">{{ __('messages.Annual report') }}</span>
                        </div>
                    </a>
                </div>

            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div style="color: #0066CC; font-size: 24px; font-weight: bold">{{ __('messages.Contact with us') }}</div>
            <div style="padding: 20px; border: 1px solid rgba(121, 121, 121, 1); background-color: rgba(242, 242, 242, 1);">
                <div class="row my-2">
                    <div class="col-3">
                        <img src="{{asset('images/contact/forMediaPhoto.png')}}">
                    </div>
                    <div class="col-9">
                        <div class="bold">{{ $infos['contact_person'] }}</div>
                        <div class="font-11 mt-2">{{ __('messages.Specialist in contact with the media') }}</div>
                    </div>
                </div>
                <button class="btn btn-black writeToUsOpen" style="width: 100%">{{ __('messages.Write to us') }}</button>
                <div class="mt-3">
                    <img src="{{asset('images/media/phone.png')}}">
                    <span class="ml-1">{{ $infos['first_phone'] }}</span>
                </div>
                <div class="mt-3">
                    <img src="{{asset('images/media/Envelop_24.png')}}">
                    <a href="mailto: {{ $infos['contact_email'] }}" class="ml-1">{{ $infos['contact_email'] }}</a>
                </div>
            </div>
        </div>
    </div>

    <div style="position: relative; height: 330px; margin-bottom: 130px">
        <iframe style="position: absolute; left: 50%; transform: translateX(-50%); max-width: 100%;" width="660" height="330" src="https://www.youtube.com/embed/eCY6V3Scdfc" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
    </div>
</div>

@include('includes.write-to-us')

@endsection