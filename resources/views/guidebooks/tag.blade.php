@extends ('layout.layout')
@section('title', $tag->tag_name)

@section('content')
<div class="container">
    <div class="row mt-2 mb-4">
        <div class="col-12 font-13">
            <a href="/">Start ></a> <a href="{{route('guidebooks.Index')}}">{{__('messages.Guidebooks')}} ></a> <span class="bold">{{$tag->tag_name}}</span>
        </div>
    </div>

    <div class="img-container" style="position: relative">
        <img style="width: 100%; height: auto; min-height: 270px;" src='{{ asset("images/guidebooks/guidebookTag1.png") }}'>
        <div class="col-md-6 col-lg-8 font-13 pl-0" style="position: absolute; left: 14px; bottom: 14px">
            <h1 class="h1-owners">{{$tag->tag_name}}</h1>
            @foreach($relatedTags as $tag)
                <div class="d-inline-block p-1 mr-1" style="color: #0099FF; background-color: rgba(242, 242, 242, 1); border: 1px solid rgba(204, 204, 204, 1);"><a href="{{route('guidebooks.Tag', $tag->tag_link)}}">{{$tag->tag_name}}</a></div>
            @endforeach
        </div>
        @desktop
            <div class="col-md-6 col-lg-4 px-0 pt-2 pb-3" style="position: absolute; right: 10px; top: 12px; background-color: rgba(0, 0, 0, 0.6);">
                @include('includes.search-form-guidebook')
            </div>
        @enddesktop
    </div>

    <div class="row mt-2 mb-4">
        <div class="col-12 font-16">
            {{$tag->tag_content}}
        </div>
    </div>

    <h2 class="bold" style="font-size: 24px">{{__('messages.Related guidebooks')}}</h2>
    <div class="row mb-3">
        @foreach($guidebooksWithSameTag as $guidebook)
            <div class="col-12 col-md-4 mb-3">
                <div style="position: relative">
                    <a class="to-download-description" href="{{route('guidebooks.Detail', $guidebook->guidebook_link)}}">
                        <img class="img-fluid" src='{{ asset("images/guidebooks/$guidebook->guidebook_img") }}'>
                    </a>
                    <div class="guidebooks-top-description">{{$guidebook->guidebook_title}}</div>
                    <div class="guidebooks-bottom-description">{{__('messages.Guidebook')}}</div>
                </div>
            </div>
        @endforeach
    </div>

</div>
@endsection