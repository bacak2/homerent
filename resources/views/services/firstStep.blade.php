@extends ('includes.reservations')

@section('reservation.content')<div class="container">
        <h1 class="h1-reservation">{{ __('Dokup usługi') }}</h1>
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
<div class="container">
    <div class="row">
        <div class="col-lg-8">
            @if(!$additionalServices->isEmpty())
                <div class="row">
                    <div class="mt-4">
                        <div class="col-12 mb-2"><b>{{ __('Kupione usługi') }}</b></div>
                        <div class="col-12">
                            <ul class="font-16" style="padding-left: inherit">
                                 @foreach($additionalServices as $servicesDetail)
                                    @if($servicesDetail->with_options == 0)
                                        <li>{{$servicesDetail->name}} ({{ number_format($servicesDetail->price, 2, ',', ' ') }} zł)</li>
                                    @elseif($servicesDetail->with_options == 2)
                                        <li>{{$servicesDetail->name}} dla {{$servicesDetail->adults}} {{trans_choice('messages.persons', $servicesDetail->adults)}} na {{$servicesDetail->nights}} {{trans_choice('messages.days', $servicesDetail->nights)}} ({{ number_format($servicesDetail->price, 2, ',', ' ') }} zł)</li>
                                    @elseif($servicesDetail->with_options == 3)
                                        <li>{{$servicesDetail->name}} dla {{$servicesDetail->adults}} {{trans_choice('messages.persons', $servicesDetail->adults)}} na {{$servicesDetail->nights}} {{trans_choice('messages.days', $servicesDetail->nights)}} ({{ number_format($servicesDetail->price, 2, ',', ' ') }} zł)</li>
                                    @endif
                                 @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
            <div class="row mt-4">
                    <div class="col-lg-12 col-sm-12">
                        <div class="row">
                            <div class="col-11 ml-3 mb-5">
                                <div class="row mb-2"><b>{{ __('Dostępne usługi') }}</b></div>
                                {!! Form::model(Auth::user(), ['route' => ['services.secondStep'], 'method' => 'POST']) !!}
                                {!! Form::hidden('apartament_id', $apartament->id) !!}
                                {!! Form::hidden('reservation_id', $idReservation) !!}
                                @foreach($availableServices as $additionalService)
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
                                                <?php $persons; ?>
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
                                                <?php $persons ?>
                                                <select name="persons-{{$additionalService->id}}" class="additional{{$additionalService->id}} persons additional-select">
                                                    @for ($i = 0; $i <= $persons; $i++)
                                                        <option value="{{ $i }}">{{ $i }}</option>
                                                    @endfor
                                                </select>
                                                osoby dorosłe
                                                <?php $kids ?>
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
                        </div>
                    </div>
            </div>
        </div>
        <div class="d-none d-lg-block col-4">
            <div class="mt-3">
                <div class="reservation-item p-3">
                    <div class="row ">
                        <div class="col-4 pr-0">
                            <img class="img-fluid" src='{{ asset("images/apartaments/$apartament->id/main.jpg") }}'>
                        </div>
                        <div class="col-8">
                            <div class="txt-blue"><b>{{ $apartament->descriptions[0]->apartament_name}}</b></div>
                            <div>{{ $apartament->apartament_city}}@if($apartament->apartament_district != null)({{ $apartament->apartament_district }})@endif</div>
                            <div class="mb-2">{{ $apartament->apartament_address }}</div>
                            <hr class="desktop-none">
                        </div>
                    </div>
                    <div class="font-12">
                        <div class="row"><div class="col-4">{{ __('messages.arrival') }}:</div><div class="col-8"><b>{{ strtolower(strftime("%a, %d %b %Y", strtotime($reservationDetails->reservation_arrive_date))) }}</b> (po 15:00)</div></div>
                        <div class="row"><div class="col-4">{{ __('messages.departure') }}:</div><div class="col-8"><b>{{ strtolower(strftime("%a, %d %b %Y", strtotime($reservationDetails->reservation_departure_date))) }}</b> (przed 12:00)</div></div>
                        <div class="row"><div class="col-4">{{ ucfirst(__('messages.number of nights')) }}:</div><div class="col-8">{{ $reservationDetails->reservation_nights }}</div></div>
                        <div class="row"><div class="col-4">{{ __('messages.Number of') }} {{ __('messages.people')}}:</div><div class="col-8">{{$reservationDetails->reservation_persons}} {{trans_choice('messages.adult persons',$reservationDetails->reservation_persons)}}, {{$reservationDetails->reservation_kids}} dzieci</div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="bg-gray">
    <div class="container py-3">
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-3 mb-2">
                <a href="{{ url()->previous() }}" class="pointer-back" style="background-image: url('{{ asset("images/reservations/btn-back.png") }}')">
                    <div  class="btn" style="width: 100%" >
                        <b>{{ __('messages.Return') }}</b>
                    </div>
                </a>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4 offset-lg-5">
                <a id="nextNotAv" href="#" class="pointer-back next-notAv" style="background-image: url('{{ asset("images/reservations/btn-next-nAv.png") }}')">
                    <div  class="btn" style="width: 100%" >
                        <b>{{ __('Dalej') }}</b>
                    </div>
                </a>
                <button id="nextAv" class="btn ml-2 pointer" type="submit" style="display: none;">{{ __('Dalej') }}</button>
                {!! Form::close() !!}
                <div id="notAvDescription" style="font-size: 11px; margin-left: 10px; margin-top: 8px">{{ __('Wybierz usługę') }}</div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('input[type=checkbox]').prop('checked', false);
        $('#additional{{$idService}}').prop('checked', true);
        checkIfAtLeastOne();
    });

    $('input').change(function() {
        checkIfAtLeastOne();
    });

    function checkIfAtLeastOne(){
        if($('input[type=checkbox]:checked').length) {
            $('#nextNotAv').css({"display": "none"});
            $('#nextAv').css({"display": "inline-block"});
            $('#notAvDescription').hide();
        }
        else {
            $('#nextNotAv').css({"display": "inline-block"});
            $('#nextAv').css({"display": "none"});

            $('#nextAv').text('Dalej');
            $('div#notAvDescription').html('<div>Wybierz usługę</div>');
        }
    }

    servicesPrice = 0;
    var totalPrice = {{$request->fullPrice ?? 12}};


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

    $("#log-in-inline").click(function(){
        $('#login-popup').css('display', 'block');
    });
</script>
@endsection()