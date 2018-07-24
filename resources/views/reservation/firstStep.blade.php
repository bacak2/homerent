@extends ('includes.reservations')

@section('reservation.content')
<div class="container">
    <h1 class="h1-reservation">{{ __('messages.reservation') }}</h1>
</div>
<div class="container flex-box mb-2">
    <div id="Rtitle"><h2 class="h2-reservation mt-3">1. {{ __('messages.offer') }}</h2></div>
    <div class="mobile-none font-12" id="Rpath">
        <div class="reservation-path">
            <img src='{{ asset("images/reservations/thisStepBlack.png") }}'>
            <span class="active number">1</span>
            <span class="activeBold ml-2">{{ __('messages.offer') }}</span>
        </div>
        <img class="mx-2" src='{{ asset("images/reservations/lineActive.png") }}'>
        <div class="reservation-path">
            <img src='{{ asset("images/reservations/fullLight.png") }}'>
            <span class="number">2</span>
            <span class="not-active ml-2">{{ __('messages.your data') }}</span>
        </div>
        <img class="mx-2" src='{{ asset("images/reservations/lineNotActive.png") }}'>
        <div class="reservation-path">
            <img src='{{ asset("images/reservations/fullLight.png") }}'>
            <span class="number">3</span>
            <span class="not-active ml-2">{{ __('messages.payment') }}</span>
        </div>
        <img class="mx-2" src='{{ asset("images/reservations/lineNotActive.png") }}'>
        <div class="reservation-path">
            <img src='{{ asset("images/reservations/fullLight.png") }}'>
            <span class="number">4</span>
            <span class="not-active ml-2">{{ __('messages.confirmation') }}</span>
        </div>
    </div>
    <div class="desktop-none font-11 row no-gutters" id="Rpath"><div class="bold col">{{ __('messages.offer') }}</div><div class="pr-2"><img src='{{ asset("images/reservations/lineNotActiveMobile.png") }}'></div><div class="col">{{ __('messages.your data') }}</div><div class="pr-3"><img src='{{ asset("images/reservations/lineNotActiveMobile.png") }}'></div><div class="col">{{ __('messages.payment') }}</div><div class="pr-2"><img src='{{ asset("images/reservations/lineNotActiveMobile.png") }}'></div><div class="col">{{ __('messages.confirmation') }}</div></div>
</div>
<div class="container font-m-13">
    <div class="row reservation-item py-2 mx-0">
        <div class="col-lg-2 mobile-none pr-0">
            <img class="apartament img-fluid d-md-none d-lg-flex" src='{{ asset("images/apartaments/$apartament->id/1.jpg") }}'>
        </div>
        <div class="col-lg-10 col-sm-12">
            <div class="row">
                <div class="col-lg-5 col-sm-6 pl-2">
                    <div class="txt-blue font-22-reservation"><b>{{ $apartament->descriptions[0]->apartament_name}}</b></div>
                    <div class="my-2 my-md-0">{{ $apartament->apartament_city}} ({{ $apartament->apartament_district }})</div>
                    <div>{{ $apartament->apartament_address }}</div>
                    @notmobile
                    <div>
                        <span>
                            @for ($i = 0; $i < floor($opinion->ratingAvg/2); $i++)
                                <img class="mr-2 mr-lg-1" src='{{ asset("images/opinions/star.png") }}'>
                            @endfor
                            @if(floor($opinion->ratingAvg/2) != ceil($opinion->ratingAvg/2))
                                <img class="mr-2 mr-lg-1" src='{{ asset("images/opinions/star_half.png") }}'>
                            @endif
                            @for ($i = ceil($opinion->ratingAvg/2); $i < 5; $i++)
                                <img class="mr-2 mr-lg-1" src='{{ asset("images/opinions/star_empty.png") }}'>
                            @endfor
                        </span>
                    </div>
                    <div>
                        @if($opinion->ratingAvg < 1)
                            <div class="d-inline"></div>
                        @elseif($opinion->ratingAvg < 2.5)
                            <div class="txt-red d-inline"><b>{{ number_format($opinion->ratingAvg, 1, ',', ' ') }}/10</b>&nbsp;&nbsp;{{ __("messages.Awful") }}</div>
                        @elseif($opinion->ratingAvg < 4.5)
                            <div class="txt-red d-inline"><b>{{ number_format($opinion->ratingAvg, 1, ',', ' ') }}/10</b>&nbsp;&nbsp;{{ __("messages.Bad") }}</div>
                        @elseif($opinion->ratingAvg < 6.5)
                            <div class="txt-yellow d-inline"><b>{{ number_format($opinion->ratingAvg, 1, ',', ' ') }}/10</b>&nbsp;&nbsp;{{ __("messages.Average") }}</div>
                        @elseif($opinion->ratingAvg < 8.5)
                            <div class="txt-green d-inline"><b>{{ number_format($opinion->ratingAvg, 1, ',', ' ') }}/10</b>&nbsp;&nbsp;{{ __("messages.Very good") }}</div>
                        @else
                            <div class="txt-green d-inline"><b>{{ number_format($opinion->ratingAvg, 1, ',', ' ') }}/10</b>&nbsp;&nbsp;{{ __("messages.Perfect") }}</div>
                        @endif
                        <span style="color: blue; font-size: 10px">{{$opinion->opinionAmount ?? 0}} {{trans_choice('messages.nrReviews', $opinion->opinionAmount ?? 0)}}</span>
                    </div>
                    @endnotmobile
                    <div class="res-description mt-2 mt-md-0">
                        {{ __('messages.res.firstStepDescription') }}
                    </div>
                    <hr class="desktop-none">
                </div>
                <div class="col-lg-7 col-sm-6 pl-2">
                    <div class="row">
                        <div class="col-4 col-md-3 pr-0 pr-md-3">{{ __('messages.arrival') }}:</div>
                        <div class="col-8 col-md-9 pl-0 pl-md-3"><b>{{ strtolower(strftime("%a, %d %b %Y", strtotime($request->przyjazd))) }} (po 15:00)</b></div>
                    </div>
                    <div class="row my-2 my-md-0">
                        <div class="col-4 col-md-3 pr-0 pr-md-3">{{ __('messages.departure') }}:</div>
                        <div class="col-8 col-md-9 pl-0 pl-md-3"><b>{{ strtolower(strftime("%a, %d %b %Y", strtotime($request->powrot))) }}  (przed 12:00)</b></div>
                    </div>
                    <div class="row mb-2 mb-md-0">
                        <div class="col-4 col-md-5 col-lg-3 pr-0 pr-md-3">{{ ucfirst(__('messages.number of nights')) }}:</div>
                        <div class="col-8 col-md-7 col-lg-9 pl-0 pl-md-3">{{ $ileNocy = $request->ilenocy ?? $ileNocy}}</div>
                    </div>
                    <div class="row">
                        <div class="col-4 col-md-5 col-lg-3 pr-0 pr-md-3">{{ __('messages.Number of') }} {{ __('messages.people')}}:</div>
                        <div class="col-8 col-md-7 col-lg-9 pl-0 pl-md-3">{{$request->dorosli}} {{trans_choice('messages.adult persons',$request->dorosli)}}, {{$request->dzieci}} dzieci</div>
                    </div>
                    <div class="res-description txt-blue mt-1 mt-lg-3">
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
                    <h3 class="h3-reservation">{{ __('messages.Payment') }}</h3>
                    <div class="row mx-0 mb-3">
                        <button class="@handheld col @endhandheld btn btn-reservation selected mr-2">{{ __('messages.Non-refundable offer') }}</button>
                        <button class="@handheld col @endhandheld btn btn-reservation">{{ __('messages.Refundable offer') }}</button>
                    </div>
                    <p id="payment-description" class="pl-lg-4" style="display: none">
                        {{ __('messages.res.paymentDescription') }}
                    </p>
                    <div class="pl-lg-4">
                        <div class="row mb-3">
                            <div class="col-7">
                                {{ __('messages.Payment for stay') }} ({{$ileNocy}} {{trans_choice('messages.nights',$ileNocy)}}):
                                <span id="showPricePerNight" class="font-11" style="color: #007bff">Pokaż cenę za noc</span>
                            </div>
                            <div class="col-5">
                                <span class="pull-right">{{ number_format($totalPrice, 2, '.', ' ') }} PLN</span>
                            </div>
                        </div>
                        <div class="row mb-3" id="pricePerNight" style="display: none">
                            @if(1==0)
                            <div class="col-12 font-11 mb-3">Właściciel określił różne ceny za pobyt w zależności od terminu.</div>
                            @foreach($prices as $price)
                                <div class="col-8 col-lg-9 font-12 mb-3">{{ $price->date_of_price }}</div>
                                <div class="col-4 col-lg-3 font-12 mb-3" style="text-align: right;">{{ number_format($price->price_value, 2, '.', ' ') }} PLN</div>
                            @endforeach
                            @else
                                <div class="col-8 col-lg-9 font-12 mb-3">{{ $request->przyjazd }} - {{ $request->powrot }}</div>
                                <div class="col-4 col-lg-3 font-12 mb-3" style="text-align: right;">{{ number_format($totalPrice, 2, '.', ' ') }} PLN</div>
                            @endif
                        </div>
                        <div class="row mb-3"><div class="col-7">{{ __('messages.Final cleaning') }}:</div><div class="col-5"><span class="pull-right">{{ number_format($cleaning, 2, '.', ' ') }} PLN</span></div></div>
                        <div class="row mb-3"><div class="col-7">{{ __('messages.Additional services') }}:</div><div class="col-5"><span class="pull-right"><span id="additional-services">0.00</span> PLN</span></div></div>
                        <div class="row mb-3"><div class="col-8">{{ __('messages.Payment for service') }}: <img src='{{ asset("images/reservations/infoIcon.png") }}'></div><div class="col-4"><span class="pull-right">{{ number_format($basicService, 2, '.', ' ') }} PLN</span></div></div>
                        <div class="row mb-3 mr-3" id="couponDiv" style="display: none"><div class="col-4">Kupon rabatowy:</div><div class="col-4"><input type="text" style="width:100%; max-height: 30px" class="font-11"></div><div class="col-3"><button class="btn btn-mobile">Zrealizuj kupon</button></div><div class="col-1"><span id="cancelCoupon" class="font-11" style="color: #007bff">Anuluj</span></div></div>
                        <div class="row mb-3 font-22-reservation"><div class="col-5"><b>{{ __('messages.fprice') }}</b></div><div class="col-7"><span class="pull-right"><b><span id="total-price">{{ number_format($request->fullPrice, 2, '.', ' ') }}</span> PLN</b></span></div></div>
                        <div class="row mb-2" id="couponQuestion"><div class="col-12 font-11" id="coupon" style="color: #007bff">Posiadasz kupon rabatowy?</div></div>
                    </div>
                    <a class="btn btn-at-least5 mobile-none" href="apartaments/{{$apartament->descriptions[0]->apartament_link}}">Zarezerwuj co namniej 5 nocy, a zapłacisz tylko <b>80 PLN za noc.</b></a>
                </div>
                <div class="col-12 mt-3">
                    <h3 class="h3-reservation">{{ __('messages.Contact details') }}</h3>
                    @guest
                        {{ __('messages.Have you already your account') }}? <span id="log-in-inline" style="font-weight: bold; color: #067eff">{{ __('messages.Log in') }}</span> {{ __('messages.to make everything easier') }}
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
                        {!! Form::hidden('payment_final_cleaning', $cleaning) !!}
                        {!! Form::hidden('payment_basic_service', $basicService) !!}
                        {!! Form::hidden('payment_all_nights', $totalPrice) !!}
                        {!! Form::hidden('servicesPrice', 0) !!}
                        <div class="form-group row">
                            {!! Form::label('name', __('messages.name').':', array('class' => 'col-3 col-lg-4 col-form-label')) !!}
                            <div class="col-9 col-lg-8">
                                {!! Form::text('name', Auth::user()->name ?? '', array('class' => 'full-width', 'required' => 'required', 'oninvalid' => 'setCustomValidity("Wprowadź imię")', ' oninput' => 'setCustomValidity("")')) !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            {!! Form::label('surname', __('messages.surname').':', array('class' => 'col-3 col-lg-4 col-form-label')) !!}
                            <div class="col-9 col-lg-8">
                                {!! Form::text('surname', Auth::user()->surname ?? '', array('class' => 'full-width', 'required' => 'required', 'oninvalid' => 'setCustomValidity("Wprowadź nazwisko")', ' oninput' => 'setCustomValidity("")')) !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            {!! Form::label('email', 'E-mail:', array('class' => 'col-3 col-lg-4 col-form-label')) !!}
                            <div class="col-9 col-lg-8">
                                {!! Form::text('email', Auth::user()->email ?? '', array('class' => 'full-width')) !!}
                            </div>
                        </div>
                        @guest
                            <div class="form-group row">
                                <div class="col"><div style="background-image: url('{{ asset('images/reservations/dottedLine.png') }}');background-repeat: no-repeat; height: 1px; position: relative; top: 50%;"></div></div>
                                <div>{{__('messages.or')}}</div>
                                <div class="col"><div style="background-image: url('{{ asset('images/reservations/dottedLine.png') }}');background-repeat: no-repeat; height: 1px; position: relative; top: 50%;"></div></div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-sm-4 col-sm-8"><a href="http://facebook.com"><img src="{{ asset('images/fb-log.png') }}"></a></div>
                            </div>
                        @endguest

                    </div>
                </div>
            </div>
        </div>
        @if(!$additionalServices->isEmpty())
            <div class="col-lg-6 col-sm-12 mb-3">
                <div class="row">
                    <h3 class="ml-3 h3-reservation">{{ __('messages.Additional services') }}</h3>
                    <div class="col-11 ml-3">
                        @foreach($additionalServices as $additionalService)
                            <div class="row additional-service">
                                @if($additionalService->with_options == NULL)
                                    <div class="col-9">
                                        <input type="checkbox" id="additional{{$additionalService->id}}" name="additional{{$additionalService->id}}" value="{{$additionalService->price}}">
                                        <label for="additional{{$additionalService->id}}" style="margin-bottom: 0">{{$additionalService->name}}</label>
                                    </div>
                                    <div class="col-3" style="text-align: right;">{{$additionalService->price}} PLN</div>
                                    @if($additionalService->description != NULL)
                                        <div class="col-12 font-11 ml-3">{{$additionalService->description}}</div>
                                    @endif
                                @elseif($additionalService->with_options == 2)
                                    <div class="col-9">
                                        <input type="checkbox" checked="" class="additional-multiple-choice" id="additional{{$additionalService->id}}" name="additional{{$additionalService->id}}" value="{{$additionalService->price}}">
                                        <input type="hidden" class="additional{{$additionalService->id}} part-amount" value="0">
                                        <label for="additional{{$additionalService->id}}" style="margin-bottom: 0">
                                        </label>
                                        {{$additionalService->name}}
                                            dla
                                            <?php $persons = $request->dorosli+$request->dzieci; ?>
                                            <select name="persons-{{$additionalService->id}}" class="additional{{$additionalService->id}} persons additional-select">
                                                @for ($i = 1; $i <= $persons; $i++)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            </select>
                                            na
                                            <select name="days-{{$additionalService->id}}" class="additional{{$additionalService->id}} days additional-select">
                                                @for ($i = 1; $i <= $ileNocy; $i++)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            </select>
                                            dni
                                    </div>
                                    <div class="col-3" style="text-align: right;">{{$additionalService->price}} PLN</div>
                                    @if($additionalService->description != NULL)
                                        <div class="col-12 font-11 ml-3">{{$additionalService->description}}</div>
                                    @endif
                                @elseif($additionalService->with_options == 3)
                                    <div class="col-9">
                                        <input type="checkbox" checked="" class="additional-multiple-choice" id="additional{{$additionalService->id}}" name="additional{{$additionalService->id}}" value="{{$additionalService->price}}">
                                        <input type="hidden" class="additional{{$additionalService->id}} part-amount" value="0">
                                        <label for="additional{{$additionalService->id}}" style="margin-bottom: 0">
                                        </label>
                                        {{$additionalService->name}}
                                        @if($additionalService->description != NULL)
                                            <div class="col-12 font-11 ml-3">{{$additionalService->description}}</div>
                                        @endif
                                            <?php $persons = $request->dorosli; ?>
                                            <select name="persons-{{$additionalService->id}}" class="additional{{$additionalService->id}} persons additional-select">
                                                @for ($i = 0; $i <= $persons; $i++)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            </select>
                                            osoby dorosłe
                                            <?php $kids = $request->dzieci; ?>
                                            <select name="days-{{$additionalService->id}}" class="additional{{$additionalService->id}} days additional-select">
                                                @for ($i = 0; $i <= $kids; $i++)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            </select>
                                            dzieci
                                    </div>
                                    <div class="col-3" style="text-align: right;">{{$additionalService->price}} PLN</div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                    <div class="col-12 mt-3" id="messageForOwner" style="display: none">
                        <h3 class="h3-reservation">{{ __('messages.Message for the owner about services') }}</h3>
                        <label class="d-block" for="res-ph">{{ __('messages.Content') }}:</label><textarea id="res-ph" name="wiadomoscDodatkowa" class="font-12" rows="4" cols="50" style="width: 97%" placeholder="{{ __('messages.res.Placeholder1') }}"></textarea>
                    </div>
                </div>
            </div>
        @endif
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
    servicesPrice = 0;
    var totalPrice = {{$request->fullPrice}};


    $('.btn-reservation').click(function(){
        if (!$(this).hasClass("selected")) {
            $('.btn-reservation').toggleClass('selected');
            $('#payment-description').toggle();
        }
    });

    $('select.additional-select').change(function(){
        var checkboxId = $(this).attr('class').split(" ")[0];
        var checkbox = $("#"+checkboxId);
            var id = checkbox.attr('id');
            var price = checkbox.val();
            var days = $(".days."+id).val();
            var persons = $(".persons."+id).val();
            var servPrice = days*persons*price;
            var partAmount = $(".part-amount."+id).val();
            partAmount = parseFloat(partAmount);

            if(checkbox.is(':checked')){
                servicesPrice -= partAmount;
                servicesPrice += servPrice;
                $(".part-amount."+id).val(servPrice);
            }
            else {
                $(".part-amount."+id).val(servPrice);
            }
        if(servicesPrice < 0) servicesPrice == 0;
        $("input[name='servicesPrice']").val(servicesPrice);
        $('#additional-services').text(servicesPrice.toFixed(2));
        $('#total-price').text((servicesPrice+totalPrice).toFixed(2));
    });

    $('input[type="checkbox"]').change(function(){
            if($(this).hasClass('additional-multiple-choice')){
                var id = $(this).attr('id');
                var price = $(this).val();
                var days = $(".days."+id).val();
                var persons = $(".persons."+id).val();
                var servPrice = days*persons*price;
                var partAmount = $(".part-amount."+id).val();
                if($(this).is(':checked')){
                    servicesPrice += servPrice;
                    partAmount = servPrice;
                }
                else {
                    servicesPrice -= partAmount;
                    partAmount = servPrice;
                }
                $(".part-amount."+id).val(partAmount);
            }
            else{
                servPrice = parseFloat($(this).val());
                if($(this).is(':checked')){
                    servicesPrice += servPrice;
                }
                else servicesPrice -= servPrice;
            }

            if(servicesPrice < 0) servicesPrice == 0;
            $('#additional-services').text(servicesPrice.toFixed(2));
            $('#total-price').text((servicesPrice+totalPrice).toFixed(2));

        });

    $('select').change(function(){
        checkboxToSelect = $(this).siblings().find('input[type="checkbox"]');
        checkboxToSelect.prop('checked', true);
    });

    $('input[type="checkbox"]').change(function(){
        if ($("input:checkbox:checked").length > 0) {
            $("#messageForOwner").show();
        }
        else {
            $("#messageForOwner").hide();
        }

        $("input[name='servicesPrice']").val(servicesPrice);
    });

    $("#showPricePerNight").click(function(){
        $('#pricePerNight').toggle();
    });

    $("#couponQuestion").click(function(){
        $('#couponQuestion').hide();
        $('#couponDiv').show();
    });

    $("#cancelCoupon").click(function(){
        $('#couponQuestion').show();
        $('#couponDiv').hide();
    });

    $(document).ready(function(){
        $('input[type=checkbox]').prop('checked', false);
    });

    $("#log-in-inline").click(function(){
        $('#login-popup').css('display', 'block');
    });
</script>
@endsection()