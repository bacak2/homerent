@extends ('layout.layout')

@section('title', __('messages.my reservations') )

@section('content')
<div class="container">
    <div class="row mt-4 mb-2">
        <div class="col-lg-3 col-12"><h1 style="font-size: 28px"><b>{{__('messages.My reservations')}}</b></h1></div>
    </div>
    <div class="row mt-4 mb-2 mx-0">
        <div class="col-12 font-14" style="padding: 10px; background-color: #d0cdca">
            <i class="fa fa-3x fa-info-circle"></i>
            <div class="d-inline-block ml-2">
                <div>{{__('messages.reservationEmpty1')}}.</div>
                <div>{{__('messages.reservationEmpty2')}}.</div>
            </div>
        </div>
    </div>

    <div class="row">
        @foreach($guidebooks as $guidebook)
            <div class="col-sm-6 col-md-4">
                <div class="mb-3"  style="position: relative">
                    <a class="to-download-description" href="{{route('guidebooks.Detail', $guidebook->guidebook_link)}}">
                        <img class="img-fluid" src="{{asset("images/guidebooks/$guidebook->guidebook_img")}}">
                    </a>
                    <div class="guidebooks-index-page">{{$guidebook->guidebook_title}}</div>
                </div>
            </div>
        @endforeach
    </div>

</div>
@endsection