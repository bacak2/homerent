@extends ('includes.reservations')

@section('reservation.content')
    <div class="container">
        <h2><b>{{ __('messages.reservation') }}</b></h2>
    </div>
<div class="container flex-box">
    <div id="Rtitle"><h4><b>1. {{ __('messages.offer') }}</b></h4></div>
    <div id="Rpath"><span class="active">{{ __('messages.offer') }}</span> - {{ __('messages.your data') }} - {{ __('messages.payment') }} - {{ __('messages.confirmation') }}</div>
</div>
<div class="container">
    <div class="row reservation-item py-2">
        <div class="col-lg-2 mobile-none">
            <div class="apartament " style="background-image: url('{{ asset("images/apartaments/$apartament->id/1.jpg") }}'); background-size: cover; margin-bottom: 0px; width: 180px; height: 110px;">
            </div>
        </div>
        <div class="col-lg-10 col-sm-12">
            <div class="row">
                <div class="col-lg-5 col-sm-6">
                    <div class="txt-blue" style="font-size: 22px"><b>{{ $apartament->descriptions[0]->apartament_name}}</b></div>
                    <div>{{ $apartament->apartament_district }}</div>
                    <div>{{ $apartament->apartament_address }}</div>
                    <div>
                    <span>
                        @for ($i = 0; $i < 5; $i++)
                            <img class="list-item" src='{{ asset("images/results/star_list.png") }}'>
                        @endfor
                    </span>
                    </div>
                    <div>
                        <span style="color: green; letter-spacing: -1px;"><b>8,3/10</b> <span style="font-size: 14px">{{ __("messages.Perfect") }}</span></span> <span style="color: blue; font-size: 10px">55 {{ __("messages.reviews_number") }}</span>
                    </div>
                    <div class="res-description">
                        {{ __('messages.res.firstStepDescription') }}
                    </div>
                    <hr class="desktop-none">
                </div>
                <div class="col-lg-7 col-sm-6">
                    <div class="row"><div class="col-4">{{ __('messages.arrival') }}:</div><div class="col-8"><b>{{ $request->przyjazd }}</b></div></div>
                    <div class="row"><div class="col-4">{{ __('messages.departure') }}:</div><div class="col-8"><b>{{ $request->powrot }}</b></div></div>
                    <div class="row"><div class="col-4">{{ ucfirst(__('messages.number of nights')) }}:</div><div class="col-8">{{ $ileNocy = $request->ilenocy ?? $ileNocy}}</div></div>
                    <div class="row"><div class="col-4">{{ __('messages.Number of') }} {{ __('messages.people')}}:</div><div class="col-8">{{ ($request->dorosli + $request->dzieci) }}</div></div>
                    <div class="res-description txt-blue mt-3">
                        <a href="apartaments/{{$apartament->descriptions[0]->apartament_link}}">{{ __('messages.change') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-lg-6 col-sm-12">
            <div class="row">
                <div class="col-12">
                    <p><b>{{ __('messages.Payment') }}</b></p>
                    <button class="btn btn-reservation selected mr-2">{{ __('messages.Non-refundable offer') }}</button>
                    <button class="btn btn-reservation">{{ __('messages.Refundable offer') }}</button>
                    <p id="payment-description" style="display: none">
                        {{ __('messages.res.paymentDescription') }}
                    </p>
                    <div class="pl-lg-4">
                        <div class="row mb-3"><div class="col-7">{{ __('messages.Payment for stay') }}: <span id="showPricePerNight" class="font-11" style="color: #007bff">Pokaż cenę za noc</span></div><div class="col-5"><span class="pull-right">{{ number_format(200*$ileNocy, 2, ',', ' ') }} PLN</span></div></div>
                        <div class="row mb-3" id="pricePerNight" style="display: none">
                            <div class="col-12 font-11 mb-3">Właściciel określił różne ceny za pobyt w zależności od terminu.</div>
                            <div class="col-9 font-12 mb-3">sob, 26 kwiecień 2014</div><div class="col-3 font-12 mb-3" style="text-align: right;">120,00 PLN</div>
                            <div class="col-9 font-12 mb-3">nie, 27 kwiecień 2014</div><div class="col-3 font-12 mb-3" style="text-align: right;">120,00 PLN</div>
                        </div>
                        <div class="row mb-3"><div class="col-7">{{ __('messages.Final cleaning') }}:</div><div class="col-5"><span class="pull-right">{{ number_format(50, 2, ',', ' ') }} PLN</span></div></div>
                        <div class="row mb-3"><div class="col-7">{{ __('messages.Additional services') }}:</div><div class="col-5"><span class="pull-right">{{ number_format(50, 2, ',', ' ') }} PLN</span></div></div>
                        <div class="row mb-3"><div class="col-8">{{ __('messages.Payment for service') }}: <img src='{{ asset("images/reservations/infoIcon.png") }}'></div><div class="col-4"><span class="pull-right">{{ number_format(50, 2, ',', ' ') }} PLN</span></div></div>
                        <div class="row mb-3" style="font-size: 22px"><div class="col-5"><b>{{ __('messages.fprice') }}</b></div><div class="col-7"><span class="pull-right"><b>{{ number_format(200*$ileNocy+150, 2, ',', ' ') }} PLN</b></span></div></div>
                        <div class="row mb-2"><div class="col-12 font-11" id="cupon" style="color: #007bff">Posiadasz kupon rabatowy?</div></div>
                    </div>
                    <a class="btn btn-at-least5 mobile-none" href="apartaments/{{$apartament->descriptions[0]->apartament_link}}">Zarezerwuj co namniej 5 nocy, a zapłacisz tylko <b>80 PLN za noc.</b></a>
                </div>
                <div class="col-12 mt-3">
                    <p><b>{{ __('messages.Contact details') }}</b></p>
                    @guest
                        {{ __('messages.Have you already your account') }}? <a href="{{ route('login') }}">{{ __('messages.Log in') }}</a> {{ __('messages.to make everything easier') }}
                    @endguest
                    <div class="form-full-width">
                        {!! Form::model(Auth::user(), ['route' => ['reservations.secondStep'], 'method' => 'GET']) !!}
                        {!! Form::hidden('link', $apartament->descriptions[0]->apartament_link) !!}
                        {!! Form::hidden('przyjazd', $request->przyjazd) !!}
                        {!! Form::hidden('powrot', $request->powrot) !!}
                        {!! Form::hidden('przyjazdDb', $przyjazdDb) !!}
                        {!! Form::hidden('powrotDb', $powrotDb) !!}
                        {!! Form::hidden('ilenocy', $request->ilenocy ?? $ileNocy) !!}
                        {!! Form::hidden('dorosli', $request->dorosli) !!}
                        {!! Form::hidden('dzieci', $request->dzieci) !!}
                        {!! Form::hidden('id', $apartament->id) !!}
                        <div class="form-group row">
                            {!! Form::label('name', __('messages.name').':', array('class' => 'col-sm-4 col-form-label')) !!}
                            <div class="col-sm-8">
                                {!! Form::text('name', Auth::user()->name ?? '', array('class' => 'full-width')) !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            {!! Form::label('surname', __('messages.surname').':', array('class' => 'col-sm-4 col-form-label')) !!}
                            <div class="col-sm-8">
                                {!! Form::text('surname', Auth::user()->surname ?? '', array('class' => 'full-width')) !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            {!! Form::label('email', 'E-mail:', array('class' => 'col-sm-4 col-form-label')) !!}
                            <div class="col-sm-8">
                                {!! Form::text('email', Auth::user()->email ?? '', array('class' => 'full-width')) !!}
                            </div>
                        </div>
                        @guest
                            <div class="form-group row">
                                <div class="offset-sm-7 col-sm-5">{{__('messages.or')}}</div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-sm-4 col-sm-8"><a href="http://facebook.com"><img src="{{ asset('images/fb-log.png') }}"></a></div>
                            </div>
                        @endguest

                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12">
            <div class="row">
                <div class="col-11 ml-3">
                    <div class="row"><b>{{ __('messages.Additional services') }}</b></div>
                    <div class="row" style="border: 1px solid lightgray; padding: 10px">
                        <div class="col-9"><input type="checkbox" id="additional-bed"><label for="additional-bed" style="margin-bottom: 0">łóżeczko dla dziecka</label></div><div class="col-3" style="text-align: right;">20 PLN</div>
                    </div>
                    <div class="row" style="border: 1px solid lightgray; padding: 10px">
                        <div class="col-9"><input type="checkbox" id="additional-bed2"><label for="additional-bed2" style="margin-bottom: 0">łóżeczko dla dziecka</label></div><div class="col-3" style="text-align: right;">20 PLN</div>
                    </div>
                </div>
                <div class="col-12 mt-3" id="messageForOwner" style="display: none">
                    <p><b>{{ __('messages.Message for the owner about services') }}</b></p>
                    <label for="res-ph">{{ __('messages.Content') }}:</label><textarea id="res-ph" name="wiadomoscDodatkowa" class="ml-4 font-12" rows="4" cols="50" style="width: 80%" placeholder="{{ __('messages.res.Placeholder1') }}"></textarea>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bg-gray">
    <div class="container py-3">
        <div class="row">
            <div class="col-lg-9 col-sm-12">
                <a href="{{ url()->previous() }}" class="btn btn-link ml-2" onclick="return confirm(' {{ __("messages.return confirmation") }} ')">{{ __('messages.return2') }}</a>
            </div>
            <div class="col-lg-3 col-sm-12">
                <button class="btn ml-2 pointer" type="submit">{{ __('messages.next') }}</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

<script>
    $('.btn-reservation').click(function(){
        if (!$(this).hasClass("selected")) {
            $('.btn-reservation').toggleClass('selected');
            $('#payment-description').toggle();
        }
    });

    $('input[type="checkbox"]').change(function(){
        if ($("input:checkbox:checked").length > 0) {
            $("#messageForOwner").show();
        }
        else {
            $("#messageForOwner").hide();
        }
    });

    $("#showPricePerNight").click(function(){
        $('#pricePerNight').toggle();
    });
</script>
@endsection()