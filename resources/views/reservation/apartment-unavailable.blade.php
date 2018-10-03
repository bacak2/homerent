@extends ('layout.layout')
@section('title', __('messages.Apartment unavailable'))

@section('content')

<div class="container">

    <h1 class="bold" style="font-size: 32px">{{ __('messages.unav1') }}</h1>

    <div class="row mt-4 mb-2 mx-0">
        <div class="col-12 font-14" style="padding: 10px; background-color: rgba(255, 132, 132, 1); border: 1px solid rgba(121, 121, 121, 1);">
            <i class="fa fa-3x fa-times-circle"></i>
            <div class="d-inline-block ml-2">
                <div>{{ __('messages.unav2') }}</div>
                <div>{{ __('messages.unav3') }}</div>
            </div>
        </div>
    </div>

    <div class="row mb-2">
        <div class="col-md-7">
            <span class="font-13">{{ __('messages.Chosen object') }}</span>
            <div class="row">
                <div class="col-5"><img class="img-fluid" src="{{asset("images/apartaments/$apartament->id/main.jpg")}}"></div>
                <div class="col-7 px-0">
                    <div class="bold txt-blue font-16">{{$apartament->apartament_name}}</div>
                    <div class="font-16">{{$apartament->apartament_city}}, {{$apartament->apartament_address}} @if($apartament->apartament_district != null)({{$apartament->apartament_district}})@endif</div>
                    <div class="font-13">{{ __('messages.arrival') }}: {{$_GET['t-start']}}</div>
                    <div class="font-13">{{ __('messages.departure') }}: {{$_GET['t-end']}}</div>
                </div>
            </div>
            <h2 class="bold" style="font-size: 24px">{{ __('messages.unav4') }}</h2>
            @if($apartmentsSimilar->isEmpty())
                <div class="font-13" style="padding: 10px; background-color: rgba(255, 132, 132, 1); border: 1px solid rgba(121, 121, 121, 1);">
                    <i class="fa fa-3x fa-exclamation-circle"></i>
                    <div class="d-inline-block ml-2">
                        <div>{{ __('messages.unav5') }}</div>
                        <div>{{ __('messages.unav6') }}</div>
                    </div>
                </div>
            @else
                <div style="max-width: 320px;">
                    <a class="btn btn-reservation-gray" href="/search/kafle?{{ http_build_query(Request::all()) }}" style="width: 100%; padding: 10px 0px">{{ __('messages.backto') }}</a>
                    <div class="row my-3">
                        <div class="col"><div style="background-image: url('{{ asset('images/reservations/dottedLine.png') }}');background-repeat: no-repeat; height: 1px; position: relative; top: 50%;"></div></div>
                        <div>{{__('messages.or')}}</div>
                        <div class="col"><div style="background-image: url('{{ asset('images/reservations/dottedLine.png') }}');background-repeat: no-repeat; height: 1px; position: relative; top: 50%;"></div></div>
                    </div>
                    <a class="btn btn-reservation-gray" href="{{route('apartamentInfo', $apartament->apartament_link)}}" style="width: 100%; padding: 10px 0px">{{ __('messages.Check availability in other term') }}</a>
                </div>
            @endif
        </div>
        <div class="col-md-5 center-h-v">
            <img src="{{asset('images/reservations/sorry-unavailable.png')}}">
        </div>
    </div>

    @if(!$apartmentsSimilar->isEmpty())
        <h2 class="bold" style="font-size: 24px">{{ __('messages.similiarap') }}</h2>

        @include('includes.apartments-similar')

    @endif

</div>

@endsection