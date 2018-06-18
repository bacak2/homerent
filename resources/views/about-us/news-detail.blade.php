@extends ('layout.layout')
@section('title', 'Artykuł detal')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-4">Inne artykuły</div>
    </div>
    <h1>Tytuł artykułu lorem ipsum</h1>
    <div class="row">
        <div class="col-12">
            <div style="border-bottom: 2px solid black">
                Treść artykułu
            </div>
        </div>
        <div class="col-12">
            Wyślij znajomemu
        </div>
    </div>
    <div class="row my-5">
        <div class="col-12 mb-1" style="color: #0066CC; font-size: 24px; font-weight: bold">
            <a href="{{route('aboutUs.news')}}">Inne artykuły</a>
        </div>
        @for($i=0; $i<4; $i++)
        <div class="col-6 col-md-3 mb-3 mb-md-0">
            <div style="background-color: #E4E4E4">
                <img style="width: 100%; height: auto" src="{{asset('images/news/newsIcon.png')}}">
                <div class="pl-2 pt-1 pb-2">
                    <a href="{{route('aboutUs.newsDetail', $i)}}">Tytuł artykułu lorem ipsum</a>
                </div>
            </div>
        </div>
        @endfor
        <div class="col-12 mt-2" style="color: #0066CC; font-size: 16px; font-weight: bold">
            <a class="pull-right" href="{{route('aboutUs.news')}}">Zobacz wszystko »</a>
        </div>
    </div>
</div>
@endsection