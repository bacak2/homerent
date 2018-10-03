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
            @for($i=0; $i<10; $i++)
            <div class="row mb-4">
                <div class="col-md-4 col-lg-3">
                    <img class="img-fluid" src="{{asset('images/media/newsIcon.png')}}">
                </div>
                <div class="col-md-8 col-lg-9">
                    <div class="row mb-2">
                        <div class="col-12" style="color: #0066CC; font-size: 16px; font-weight: bold">
                            <a href="{{route('aboutUs.newsDetail', $i)}}">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a>
                        </div>
                    </div>
                    <div class="row mb-2" style="display: inline-block">
                        <div class="col-12 font-14">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient...
                            <a href="{{route('aboutUs.newsDetail', $i)}}" class="bold font-16">»</a>
                        </div>
                    </div>
                    <div class="row font-11" style="color: #999999;">
                        <div class="col-12">
                            {{date('j F Y', mktime(0, 0, 0, 7, 1, 2000))}}
                        </div>
                    </div>
                </div>
            </div>
            @endfor
        </div>
    </div>

</div>
@endsection