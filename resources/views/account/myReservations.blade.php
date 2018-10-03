@extends ('layout.layout')

@section('title', __('messages.my reservations') )

@section('content')
<div class="container">
    <div class="row mt-4 mb-2">
        <div class="col-lg-3 col-12"><h1 style="font-size: 28px"><b>{{__('messages.My reservations')}}</b></h1></div>
        {{--
        <div class="col-lg-3 col-12 inline-wrapper text-right">
            <div class="btn-group pull-left">
                <a class="btn btn-mobile btn-selected" href="{{ route('myReservations')}}">{{__('Data przyjazdu')}}</a>
                <a class="btn btn-mobile btn-info" href="{{url()->current()}}?sort=reservation">{{__('Data rezerwacji')}}</a>
            </div>
        </div>
        <div class="col-lg-6 col-12">
            <input class="col-lg-6 col-5" id="search-reservation" type="text" style="width: 100%; font-size: 10px" placeholder="np: nr rezerwacji, nazwa/adres obiektu">
            <button class="btn btn-mobile btn-dark col-lg-4 col-6">Szukaj rezerwacji</button>
            <button type="button" class="btn btn-filter dropdown-toggle" id="menu1" data-toggle="dropdown"><span>{{ __('messages.Filters') }}</span></button>
            <div class="dropdown-menu" role="menu" aria-labelledby="menu1">
                {!! Form::open(array('url' => '#')) !!}
                <div class="row">
                    <div class="col-3">

                    </div>
                </div>
                <hr>
                <button type="submit" class="btn btn-primary searchbtn">{{ __('messages.Apply filters') }}</button>
                <a id="resetFilters" href="#">{{ __('messages.Restore default') }}</a>
                {!! Form::close() !!}

            </div>
        </div>
        --}}
    </div>
    <div class="row col-12 mb-4">
        <span class="font-11">* {{__('messages.AdditionalCostExp')}}.</span>
    </div>
    @foreach($users_reservations_future as $reservation)
    <div class="row minH-90 py-3">
        <div class="col-4 col-lg-2 px-3 px-md-0 mb-md-2 mb-lg-0"><img src='{{ asset("images/apartaments/$reservation->apartament_id/main.jpg") }}') style="width: 100%"></div>
        <div class="col-8 col-lg-2">
            {{ $reservation->apartament_name }}<br>
            <b>{{ $reservation->apartament_city }}</b> @if($reservation->apartament_district != null)({{ $reservation->apartament_district }})@endif<br>
            {{ $reservation->apartament_address }}
        </div>
        <div class="col-4 col-md-2 my-2 my-md-0 pl-md-0 pl-lg-3">
            <div class="row">
                <div class="col-6 date-div">
                    <div style="">{{ date("j", strtotime($reservation->reservation_arrive_date)) }}</div>
                    <div style="">{{ lcfirst(strftime("%b", strtotime($reservation->reservation_arrive_date))) }}</div>
                </div>
                <div class="col-6">
                    <div class="row font-11">{{__('messages.arrive')}}:</div>
                    <div class="row">{{__('messages.inDays')}} {{ ceil((strtotime($reservation->reservation_arrive_date) - strtotime($current_data)) / (60*60*24)) }} {{__('messages.days2')}}</div>
                </div>
            </div>
        </div>
        <div class="col-4 col-md-1 my-2 my-md-0 px-md-0 px-lg-3"><img data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.number of nights') }}" src="{{ asset("images/account/moon.png") }}"> {{ $reservation->reservation_nights }}</div>
        <div class="col-4 col-md-2 col-lg-1 my-2 my-md-0">
            @if($reservation->reservation_status == 0)
                <div class="row font-11">{{__('messages.Pre-booking')}}:</div>
                <div class="row">{{ strtolower(strftime("%d %b %Y", strtotime($reservation->created_at))) }}</div>
                <!--wygasa za -->
            @else
                <div class="row font-11">{{__('messages.reservation')}}:</div>
                <div class="row">{{ strtolower(strftime("%d %b %Y", strtotime($reservation->created_at))) }}</div>
            @endif
        </div>
        <div class="col-4 col-md-2 col-lg-1 px-3 px-md-1">
            <div class="row">
                <div class="col-12 font-11">{{__('messages.Payment for stay')}}:</div>
                <div class="col-12">{{$reservation->payment_full_amount}} PLN</div>
            </div>
        </div>
        <div class="col-8 col-md-2 col-lg-1 px-3 px-md-1">
            @if($reservation->reservation_status == 0)
                <div class="row">
                    <div class="col-6 col-md-12 pr-0 pr-md-3">
                        <div class="font-11">{{__('messages.Advance')}}:</div>
                        <div class="">{{$reservation->payment_full_amount - $reservation->payment_to_pay}} PLN</div>
                    </div>
                    <div class="col-6 col-md-12 pr-0 pr-md-3">
                        <div class="font-11">{{__('messages.To pay')}}:</div>
                        <div class="">{{$reservation->payment_to_pay}} PLN</div>
                    </div>
                </div>
            @elseif($reservation->reservation_status == 1 && $reservation->payment_to_pay > 0)
                <div class="row">
                    <div class="col-6 col-md-12 pr-0 pr-md-3">
                        <div class="font-11">{{__('messages.Advance')}}:</div>
                        <div>{{$reservation->payment_full_amount - $reservation->payment_to_pay}} PLN</div>
                    </div>
                    <div class="col-6 col-md-12 pr-0 pr-md-3">
                        <div class="font-11">{{__('messages.At location')}}:</div>
                        <div>{{$reservation->payment_to_pay}} PLN</div>
                    </div>
                </div>
            @else
                <div class="font-11">{{__('messages.To pay')}}:</div>
                <div>{{$reservation->payment_to_pay}} PLN</div>
            @endif
        </div>
        <div class="col-md-3 col-lg-2 px-lg-0">
            <div>
                @desktop
                    <button class="phone-to-expand btn btn-black"><img src="{{ asset("images/account/phone.png") }}"><span class="phone-addition-text"></span></button>
                @elsedesktop
                    <a class="btn btn-black" href="tel:713333222"><img src="{{ asset("images/account/phone.png") }}"></a>
                @enddesktop
                <a class="btn btn-black" href="mailto:ja@ja.pl"><img src="{{ asset("images/account/envelope.png") }}"></a>
                <a class="btn btn-black font-12 px-1 desktop-none" style="padding-bottom: .7rem; padding-top: .7rem" href="{{ route('account.reservationDetail',['idReservation' => $reservation->id]) }}">{{__('messages.Details')}}</a>
                <a class="btn btn-black font-12 px-1 desktop-none" style="padding-bottom: .7rem; padding-top: .7rem" href="{{ route('apartamentInfo',['link' => $reservation->apartament_link]) }}">{{__('messages.Book again')}}</a>
                <div class="more row mobile-none">
                    <div class="btn-toggle col-1" style="height: 100%"> <i style="font-size:16px; font-weight: bold" class="fa">&#xf100;</i></div>
                    <div class="col-1" style="display: none;">
                        <a href="{{ route('account.reservationDetail',['idReservation' => $reservation->id]) }}">{{__('messages.Details')}}</a><br>
                        <a href="{{ route('apartamentInfo',['link' => $reservation->apartament_link]) }}">{{__('messages.Book again')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @foreach($users_reservations_gone as $reservation)
        <div class="row minH-90 py-3">
            <div class="col-4 col-lg-2 px-3 px-md-0 mb-md-2 mb-lg-0"><img src='{{ asset("images/apartaments/$reservation->apartament_id/main.jpg") }}') style="width: 100%; opacity : 0.30;"></div>
            <div class="col-8 col-lg-2">
                {{ $reservation->apartament_name }}<br>
                <b>{{ $reservation->apartament_city }}</b> @if($reservation->apartament_district != null)({{ $reservation->apartament_district }})@endif<br>
                {{ $reservation->apartament_address }}
            </div>
            <div class="col-4 col-md-2 my-2 my-md-0 pl-md-0 pl-lg-3">
                <div class="row">
                    <div class="col-6 date-div">
                        <div style="">{{ date("j", strtotime($reservation->reservation_arrive_date)) }}</div>
                        <div style="">{{ lcfirst(strftime("%b", strtotime($reservation->reservation_arrive_date))) }}</div>
                    </div>
                    <div class="col-6">
                        <div class="row font-11">{{__('messages.arrive')}}:</div>
                        <?php
                        $daysAgo = abs((strtotime($reservation->reservation_arrive_date) - strtotime($current_data)) / (60*60*24));
                        if ($daysAgo < 30) $daysAgo = $daysAgo." ".__('messages.days2');
                        else $daysAgo = ceil($daysAgo/30)." ".__('messages.monthsShort');
                        ?>
                        <div class="row">{{$daysAgo}} {{__('messages.ago')}}</div>
                    </div>
                </div>
            </div>
            <div class="col-4 col-md-1 my-2 my-md-0 px-md-0 px-lg-3"><img data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.number of nights') }}" src="{{ asset("images/account/moon.png") }}"> {{ $reservation->reservation_nights }}</div>
            <div class="col-4 col-md-2 col-lg-1 my-2 my-md-0">
                <div class="row font-11">{{__('messages.reservation')}}:</div>
                <div class="row">{{ strtolower(strftime("%d %b %Y", strtotime($reservation->created_at))) }}</div>
            </div>
            <div class="col-4 col-md-2 col-lg-1 px-3 px-md-1">
                <div class="row">
                    <div class="col-12 font-11">{{__('messages.Payment for stay')}}:</div>
                    <div class="col-12">{{$reservation->payment_full_amount}} PLN</div>
                </div>
            </div>
            <div class="col-8 col-md-2 col-lg-1 px-3 px-md-1">
                <div class="row">
                    <div class="col-12 font-11">{{__('messages.To pay')}}:</div>
                    <div class="col-12">{{$reservation->payment_to_pay}} PLN</div>
                </div>
            </div>
            <div class="col-md-3 col-lg-2 px-lg-0">
                <div>
                    @if($reservation->total_rating != null)
                        <div class="btn d-inline-block p-1 @if($reservation->total_rating <= 3) rating-red @elseif($reservation->total_rating <= 5) rating-yellow @else rating-green @endif" style="width: 120px; border: 1px solid rgba(121, 121, 121, 1);">
                            <span class="font-11 pull-left mt-2">{{__('messages.You assessed on')}}:</span>
                            <span class="bold pull-right" style="font-size: 22px">{{round($reservation->total_rating)}}</span>
                        </div>
                    @else
                        <a class="btn btn-black mobile-none" style="padding-left:2.5rem; padding-right:2.5rem;" href="{{ route('account.opinion',['idReservation' => $reservation->id]) }}">{{__('messages.Review')}}</a>
                        <a class="btn btn-black font-12 px-4 desktop-none" style="width: 120px; border: 1px solid rgba(121, 121, 121, 1); padding-bottom: .7rem; padding-top: .7rem" href="{{ route('account.opinion',['idReservation' => $reservation->id]) }}">{{__('messages.Review')}}</a>
                    @endif
                    <a class="btn btn-black font-12 px-1 desktop-none" style="padding-bottom: .7rem; padding-top: .7rem" href="{{ route('account.reservationDetail',['idReservation' => $reservation->id]) }}">{{__('messages.Details')}}</a>
                    <a class="btn btn-black font-12 px-1 desktop-none" style="padding-bottom: .7rem; padding-top: .7rem" href="{{ route('apartamentInfo',['link' => $reservation->apartament_link]) }}">{{__('messages.Book again')}}</a>
                    <div class="more row mobile-none">
                        <div class="btn-toggle col-1" style="height: 100%"> <i style="font-size:16px; font-weight: bold" class="fa">&#xf100;</i></div>
                        <div class="col-1" style="display: none;">
                            <a href="{{ route('account.reservationDetail',['idReservation' => $reservation->id]) }}">{{__('messages.Details')}}</a><br>
                            <a href="{{ route('apartamentInfo',['link' => $reservation->apartament_link]) }}">{{__('messages.Book again')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<script>

    $("div.btn-toggle").click(function() {
        $(this).siblings().toggle();
        if($(this).siblings().is(":visible")){
            $(this).html('<i style="font-size:16px; font-weight: bold" class="fa">&#xf101;</i>');
        }
        else {
            $(this).html('<i style="font-size:16px; font-weight: bold" class="fa">&#xf100;</i>');
        }
    });

    $(".phone-to-expand").click(function() {
        if($(this).hasClass("phone-expanded")){
            $(this).removeClass("phone-expanded");
            $(this).find(".phone-addition-text").text("");
        }
        else{
            $(this).addClass("phone-expanded");
            $(this).find(".phone-addition-text").text("{{__('messages.Call')}} 713333222");
        }
    });

    $(window).on("click", function(event){
        if($(".phone-to-expand").has(event.target).length == 0 && !$(".phone-to-expand").is(event.target)){
            $(".phone-to-expand").removeClass("phone-expanded");
            $(".phone-addition-text").text("");
        }
    });

</script>
@endsection