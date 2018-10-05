@extends ('layout.layout')
@section('title', __('messages.Guidebooks'))

@section('content')
<div class="container">
    <div class="row mt-2 mb-4">
        <div class="col-12 font-13">
            <a href="/">Start ></a> <span class="bold">{{__('messages.Guidebooks')}}</span>
        </div>
    </div>

    @include('includes.slider-guidebooks')

    <div class="row mt-4 mb-3">
        <div class="col-12 col-md-4">
            <div class="row">
                <div class="col-12">
                    <h2 class="h2-guidebooks">{{__('messages.Popular cities')}}</h2>
                    @foreach($guidebooks as $guidebook)
                        <div class="mb-3" style="position: relative">
                            <a class="to-download-description" href="{{route('guidebooks.Detail', $guidebook->guidebook_link)}}">
                                <img class="img-fluid" src='{{ asset("images/guidebooks/$guidebook->guidebook_img") }}'>
                            </a>
                            <div class="guidebooks-top-description">{{$guidebook->guidebook_title}}</div>
                            <div class="guidebooks-bottom-description">{{__('messages.Guidebook')}}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="row">
                <div class="col-12">
                    <h2 class="h2-guidebooks">{{__('messages.Rest')}}</h2>
                    @foreach($guidebooks as $guidebook)
                        <div class="mb-3" style="position: relative">
                            <a class="to-download-description" href="{{route('guidebooks.Detail', $guidebook->guidebook_link)}}">
                                <img class="img-fluid" src='{{ asset("images/guidebooks/$guidebook->guidebook_img") }}'>
                            </a>
                            <div class="guidebooks-top-description">{{$guidebook->guidebook_title}}</div>
                            <div class="guidebooks-bottom-description">{{__('messages.Guidebook')}}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="row">
                <div class="col-12">
                    <h2 class="h2-guidebooks">{{__('messages.Journey')}}</h2>
                    @foreach($guidebooks as $guidebook)
                        <div class="mb-3" style="position: relative">
                            <a class="to-download-description" href="{{route('guidebooks.Detail', $guidebook->guidebook_link)}}">
                                <img class="img-fluid" src='{{ asset("images/guidebooks/$guidebook->guidebook_img") }}'>
                            </a>
                            <div class="guidebooks-top-description">{{$guidebook->guidebook_title}}</div>
                            <div class="guidebooks-bottom-description">{{__('messages.Guidebook')}}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-12 col-md-4">
            <div class="row">
                <div class="col-12">
                    <h2 class="h2-guidebooks">{{__('messages.Other cities')}}</h2>
                    @foreach($otherGuidebooks as $guidebook)
                        <a class="d-block" href="{{route('guidebooks.Detail', $guidebook->guidebook_link)}}">{{$guidebook->guidebook_title}}</a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="row">
                <div class="col-12">
                    <h2 class="h2-guidebooks">{{__('messages.Places to rest')}}</h2>
                    @foreach($otherGuidebooks as $guidebook)
                        <a class="d-block" href="{{route('guidebooks.Detail', $guidebook->guidebook_link)}}">{{$guidebook->guidebook_title}}</a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="row">
                <div class="col-12">
                    <h2 class="h2-guidebooks">{{__('messages.Other journeys')}}</h2>
                    @foreach($otherGuidebooks as $guidebook)
                        <a class="d-block" href="{{route('guidebooks.Detail', $guidebook->guidebook_link)}}">{{$guidebook->guidebook_title}}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection