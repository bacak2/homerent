@extends ('layout.layout')

@section('title', __('messages.my reservations') )

@section('content')
<div class="container">
    @if(!($users_reservations_future->isEmpty() && $users_reservations_gone->isEmpty()))
    <div class="row mt-4 mb-2">
        <div class="col-lg-3 col-12"><h1 style="font-size: 28px"><b>Rezerwacje</b></h1></div>
        <div class="col-lg-3 col-12 inline-wrapper text-right">
            <div class="btn-group pull-left">
                <a class="btn btn-mobile btn-selected" href="{{ route('myReservations')}}">{{__('Data przyjazdu')}}</a>
                <a class="btn btn-mobile btn-info" href="{{url()->current()}}?sort=reservation">{{__('Data rezerwacji')}}</a>
            </div></div>
        <div class="col-lg-5 col-12">
            <input class="col-lg-6 col-5" id="search-reservation" type="text" style="width: 100%; font-size: 10px" placeholder="np: nr rezerwacji, nazwa/adres obiektu">
            <button class="btn btn-mobile btn-dark col-lg-4 col-6">Szukaj rezerwacji</button>
        </div>
        <div class="col-lg-1 col-2"><button type="button" class="btn btn-filter dropdown-toggle" id="menu1" data-toggle="dropdown"><span>{{ __('messages.Filters') }}</span><!--img src="{{ asset("images/results/filter.png") }}"--></button>
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
    </div>
    <div class="row mb-4">
        <span class="font-11">* Właściciel może pobrać na miejscu dodatkowe opłaty - np: opłatę klimatyczną, parking itd  (sprawdź opis oferty).</span>
    </div>
    @else
        <div class="row mt-4 mb-2">
            <div class="col-lg-3 col-12"><h1 style="font-size: 28px"><b>Rezerwacje</b></h1></div>
        </div>
        <div class="row mt-4 mb-2">
            <div class="col-12">Nie masz jeszcze żadnych rezerwacji. </div>
        </div>
    @endif
    @foreach($users_reservations_future as $reservation)
    <div class="row minH-90 py-3">
        <div class="col-lg-2 col-4"><img src='{{ asset("images/apartaments/$reservation->apartament_id/1.jpg") }}') style="width: 100%"></div>
        <div class="col-lg-2 col-8">
            {{ $reservation->apartament_name }}<br>
            <b>{{ $reservation->apartament_city }}</b> ({{ $reservation->apartament_district }})<br>
            {{ $reservation->apartament_address }}
        </div>
        <div class="col-lg-2 col-6">
            <div class="row">
                <div class="col-6 date-div">
                    <div style="">{{ date("j", strtotime($reservation->reservation_arrive_date)) }}</div>
                    <div style="">{{ lcfirst(strftime("%b", strtotime($reservation->reservation_arrive_date))) }}</div>
                </div>
                <div class="col-6">
                    <div class="row font-11">Przyjazd:</div>
                    <div class="row">za {{ (strtotime($reservation->reservation_arrive_date) - strtotime($current_data)) / (60*60*24) }} dni</div>
                </div>
            </div>
        </div>
        <div class="col-lg-1 col-4"><img data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.number of nights') }}" src="{{ asset("images/account/moon.png") }}"> {{ $reservation->reservation_nights }}</div>
        <div class="col-lg-1 col-12">
            <div class="row font-11">Rezerwacja:</div>
            <div class="row">{{ strtolower(strftime("%d %b %Y", strtotime($reservation->created_at))) }}</div>
        </div>
        <div class="col-lg-1 col-6">
            <div class="row font-11">Opłata za pobyt:</div>
            <div class="row">{{$reservation->payment_full_amount}} PLN</div>
        </div>
        <div class="col-lg-1 col-6">
            <div class="row font-11">Do zapłaty:</div>
            <div class="row">{{$reservation->payment_to_pay}} PLN</div>
        </div>
        <div class="col-lg-2 col-12">
            <a class="btn btn-black" href="tel:713333222"><img src="{{ asset("images/account/phone.png") }}"></a>
            <a class="btn btn-black" href="mailto:ja@ja.pl"><img src="{{ asset("images/account/envelope.png") }}"></a>
            <div class="more row">
                <div class="btn-toggle col-1" style="height: 100%"> <i style="font-size:16px; font-weight: bold" class="fa">&#xf100;</i></div>
                <div class="col-1" style="display: none">
                    <a href="{{ route('account.reservationDetail',['idAparment' => $reservation->apartament_id, 'idReservation' => $reservation->id]) }}">Szczegóły</a><br>
                    <a href="{{ route('apartamentInfo',['link' => $reservation->apartament_link]) }}">Rezerwuj ponownie</a>
                </div>
            </div>
        </div>

    </div>
    @endforeach
    @foreach($users_reservations_gone as $reservation)
        <div class="row minH-90 py-3">
            <div class="col-lg-2 col-4"><img src='{{ asset("images/apartaments/$reservation->apartament_id/1.jpg") }}') style="width: 100%; opacity : 0.30;"></div>
            <div class="col-lg-2 col-8">
                {{ $reservation->apartament_name }}<br>
                <b>{{ $reservation->apartament_city }}</b> ({{ $reservation->apartament_district }})<br>
                {{ $reservation->apartament_address }}
            </div>
            <div class="col-lg-2 col-4">
                <div class="row">
                    <div class="col-6 date-div">
                        <div style="">{{ date("j", strtotime($reservation->reservation_arrive_date)) }}</div>
                        <div style="">{{ lcfirst(strftime("%b", strtotime($reservation->reservation_arrive_date))) }}</div>
                    </div>
                    <div class="col-6">
                        <div class="row font-11">Przyjazd:</div>
                        <div class="row">{{ abs((strtotime($reservation->reservation_arrive_date) - strtotime($current_data)) / (60*60*24)) }} dni temu</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-1 col-4"><img data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.number of nights') }}" src="{{ asset("images/account/moon.png") }}"> {{ $reservation->reservation_nights }}</div>
            <div class="col-lg-1 col-4">
                <div class="row font-11">Rezerwacja:</div>
                <div class="row">{{ strtolower(strftime("%d %b %Y", strtotime($reservation->created_at))) }}</div>
            </div>
            <div class="col-lg-1 col-6">
                <div class="row font-11">Opłata za pobyt:</div>
                <div class="row">{{$reservation->payment_full_amount}} PLN</div>
            </div>
            <div class="col-lg-1 col-6">
                <div class="row font-11">Do zapłaty:</div>
                <div class="row">{{$reservation->payment_to_pay}} PLN</div>
            </div>
            <div class="col-lg-2 col-4">
                <a class="btn btn-black" href="{{ route('account.opinion',['idAparment' => $reservation->apartament_id, 'idReservation' => $reservation->id]) }}">Oceń</a>
                <div class="more row">
                    <div class="btn-toggle col-1" style="height: 100%"> <i style="font-size:16px; font-weight: bold" class="fa">&#xf100;</i></div>
                    <div class="col-1" style="display: none;">
                        <a href="{{ route('account.reservationDetail',['idAparment' => $reservation->apartament_id, 'idReservation' => $reservation->id]) }}">Szczegóły</a><br>
                        <a href="{{ route('apartamentInfo',['link' => $reservation->apartament_link]) }}">Rezerwuj ponownie</a>
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

</script>
@endsection