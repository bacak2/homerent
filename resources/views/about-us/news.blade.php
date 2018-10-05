@extends ('layout.layout')
@section('title', __('messages.News').', '.__('messages.About us in media'))

@section('content')
<div class="container">
    <img style="width: 100%; height: auto;" src='{{ asset("images/about_us/mainImg.png") }}'>

    <div class="row mt-2">
        <div class="col-lg-1">
            <a class="font-13" href="{{ url()->previous() }}"><&nbsp;{{ __('messages.Back') }}</a>
        </div>
        <div class="col-lg-10">
            <h1 class="h1-owners mb-4">{{ __('messages.News') }} VisitWorld</h1>
            @foreach($news as $newsEntity)
            <div class="row mb-4">
                <div class="col-md-4 col-lg-3">
                    <img class="img-fluid" src="{{asset('images/media').'/'.$newsEntity->news_min_img}}">
                </div>
                <div class="col-md-8 col-lg-9">
                    <div class="row mb-2">
                        <div class="col-12" style="color: #0066CC; font-size: 16px; font-weight: bold">
                            <a href="{{route('aboutUs.newsDetail', $newsEntity->news_id)}}">{{$newsEntity->news_title}}</a>
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
        </div>
    </div>

</div>
@endsection