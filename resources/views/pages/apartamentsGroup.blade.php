@extends ('layout.layout')

@section('title', $groupDescription[0]->apartament_city.' - '.$groupDescription[0]->group_name.' - Zarezerwuj już teraz' )

@section('content')
	<div class="row">
		<div class="container py-1"><a href="{{ url()->previous() }}" class="btn btn-primary ml-2">{{ __('messages.Return') }}</a></div>
	</div>
	<div class="else-handheld-none" id="stickyReservationPanelMobile">
		<div class=""><a href="{{ url()->previous() }}" class="btn btn-primary ml-3 mr-2">{{ __('messages.Return') }}</a></div>
		<div class="col-sm-9 col-md-10" style="padding-left: 0px;"><a id="mobileReservation" href="#stickyReservationPanel" class="btn btn-primary btn-black">Zarezerwuj</a></div>
	</div>
	<div class="row back" style="background-image: url( {{ asset('images/apartaments/'.$groupDescription[0]->id.'/1.jpg') }} );">
		<div class="container">
			<div class="row apartament-info" >
				<div class="col-md-8">
					<div class="col transparent mt-2 mb-2 pb-1 pt-1 ">
						<h1 style="font-size: 26px"><b>{{  $groupDescription[0]->group_name or '' }}</b><span class="pull-right">{{$apartamentsAmount}} {{trans_choice('messages.nrApartmentsInKomplex', $apartamentsAmount)}}</span></h1>
						<h2 style="font-size: 20px">{{ $groupDescription[0]->apartament_city }}, {{ $groupDescription[0]->apartament_address }}</h2>
					</div>
					<div class="col transparent mt-4 mb-2 pt-3 ">
						<div class="container">
							<div class="row">
								<div class="col-md-3">
									<div class="row">
										<i class="fa fa-user fa-lg pt-1" aria-hidden="true"></i>
										<p class="pl-2">{{ __('dla') }} {{ $groupDescription[0]->apartament_persons }} {{trans_choice('messages.persons',$groupDescription[0]->apartament_persons)}}</p>
									</div>
								</div>
								<div class="col-md-3">
									<div class="row">
										<i class="fa fa-home fa-lg pt-1" aria-hidden="true"></i>
										<p class="pl-2">{{ $groupDescription[0]->apartament_rooms_number }} {{trans_choice('messages.rooms_number',$groupDescription[0]->apartament_rooms_number)}}</p>
									</div>
								</div>
								<div class="col-md-3">
									<div class="row">
										<i class="fa fa-calculator fa-lg pt-1" aria-hidden="true"></i>
										<p class="pl-2">{{ $groupDescription[0]->apartament_living_area }} m²</p>
									</div>
								</div>
								<div class="col-md-3">
									<div class="row">
										<i class="fa fa-bed fa-lg pt-1" aria-hidden="true"></i>
										<p class="pl-2">{{ $beds }} {{trans_choice('messages.beds_number', $beds)}} </p>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="mobile-none col transparent mt-5 mb-3 pt-3" style="visibility: hidden;"></div>
					<div class="mobile-none col transparent mt-4 mb-2 pt-3" style="visibility: hidden;">Śniadanie w cenie</div>
				</div>
				<div id="stickyReservationPanel" class="col-md-4 ml-2 mr-2 ml-sm-0 mr-sm-0">
					<div class="col transparent mt-2 mb-2 pb-1 pt-1">
						<div class="row">
							<div class="col-8">{{ __('messages.lowestpricepnight')}}</div>
							<div class="col-4 text-right">
								<p><b>{{ $priceFrom }} zł</b></p>
							</div>
						</div>
						{!! Form::open(array('route' => 'reservations.firstStep', 'method' => 'get')) !!}
						{!! Form::hidden('link', $groupDescription[0]->group_link) !!}
						{!! Form::hidden('id', $groupDescription[0]->id) !!}
						<div class="form-row">
							<div class="pick-date form-row">
								<div class="col-md-6 pb-2">
									<input type="text" class="form-control" id="przyjazd" name="przyjazd" placeholder="{{ __('messages.arrive')}}" pattern="(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))" required>
								</div>
								<div class="col-md-6 pb-2">
									<input type="text" class="form-control" id="powrot" name="powrot" placeholder="{{ __('messages.return')}}" pattern="(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))" required>
								</div>
							</div>
							<div class="form-row pb-3">
								<div class="col-md-6 pb-2">
									<div class="input-group mb-sm-0">
										<div class="input-group-addon" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.Adults') }}"><i class="fa fa-lg fa-male" aria-hidden="true" placeholder="{{ __('messages.adults')}}"></i></div>
										<select class="form-control" name='dorosli' style="width: 120px; height: 38px">
											@for($i=1; $i <= $groupDescription[0]->apartament_persons; $i++)
												<option value="{{$i}}">{{$i}}</option>
											@endfor
										</select>
									</div>
								</div>
								<div class="col-md-6 pb-2">
									<div class="input-group mb-sm-0">
										<div class="input-group-addon" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.Kids') }}"><i class="fa fa-child" aria-hidden="true" placeholder="{{ __('messages.kids')}}"></i></div>
										<select class="form-control" name='dzieci' style="width: 120px; height: 38px">
											<option value="0">0</option>
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
											<option value="6">6</option>
											<option value="7">7</option>
											<option value="8">8</option>
										</select>
									</div>
								</div>
							</div>

						</div>

						<div class="res-info">
							<div class="row">
								<div class="col-8">
									{{ __('messages.Chosen nights')}}
								</div>
								<div class="col-4">
									<p align="right"><b><input class="form-control" id="ilenocy" name="ilenocy" readonly style="width: 50px"></input></b></p>
								</div>
							</div>
							<div class="row">
								<div class="col-6">
									<h3>{{ __('messages.fprice') }}</h3>
								</div>
								<div class="col-6 text-right">
									<h3><b><span id="price"></span></b></h3>
								</div>
								<div class="col-12 text-center font-weight-bold">
									<p class="termin"></p>
									<div id="not-Av-panel" class="p-2">
										<i class="fa fa-lg fa-exclamation-triangle" style="color: black"></i>
										<b>Ten termin nie jest dostępny - wybierz inną datę</b><br>
										<!--a id="firstFreeDate" href="#">Zobacz pierwszy wolny termin</a-->
									</div>
									<button class="btn btn-block btn-success res-btn" type="submit">{{ __('messages.reserve')}}</button>
								</div>
							</div>
						</div>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row ">
			@handheld <div class="col-12"> @elsehandheld <div class="col-lg-8"> @endhandheld
				<div class="row mb-3" style="margin-top: 50px">
					<div class="col">
						<h4 class=""><b>{{ __('messages.description') }}</b></h4>
						<span id="description" style="padding-top: 120px; margin-top: -120px;"></span>
						<p>{{ $groupDescription[0]->apartament_description or '' }}</p>
						<div class="row mb-2" style="font-size: 14px">
							<div class="col-4">Apartamentów w kompleksie:<span class="pull-right">{{$apartamentsAmount}}</span></div>
							<div class="col-4">Ilość pokoi:<span class="pull-right">{{$groupDescription[0]->apartament_rooms_number}}</span></div>
							<div class="col-4">Ilość łóżek podwójnych:<span class="pull-right">{{$groupDescription[0]->apartament_double_beds}}</span></div>
						</div>
						<div class="row" style="font-size: 14px">
							<div class="col-4">Max liczba osób:<span class="pull-right">{{$groupDescription[0]->apartament_persons}}</span></div>
							<div class="col-4">Ilość pokoi nieprzechodnich:<span class="pull-right">{{$groupDescription[0]->apartament_rooms_number}}</span></div>
							<div class="col-4">Ilość łóżek pojedynczych:<span class="pull-right">{{$groupDescription[0]->apartament_single_beds}}</span></div>
						</div>
					</div>
				</div>
				<div class="row mb-3">
					<div class="col">
						<h4 id="photos" class="anchor-destination"><b>{{ __('messages.photos') }}</b></h4>
						<div class="fotorama" data-nav="thumbs" data-autoplay="true">

							@forelse($images as $image)
								<a href="{{ asset("images/apartaments/$image->id/$image->photo_link") }}"><img src="{{ asset("images/apartaments/$image->id/$image->photo_link") }}"></a>
							@empty
								<p>No photos for this apartment</p>
							@endforelse
						</div>
					</div>
				</div>

				<div class="row mt-2 mb-3 font-12">
					<div class="col-12">
						<h4 id="rules" class="anchor-destination"><b>{{__('Zasady')}}</b></h4>
					</div>
					<div class="col-12 mb-2">
						<div class="row mb-2">
							<div class="col-4">{{__('messages.Check-in')}}: {{$groupDescription[0]->apartament_registration_time }}</div>
							<div class="col-4">{{__('messages.Check-out')}}: {{$groupDescription[0]->apartament_checkout_time }}</div>
							<div class="col-4">{{__('Kaucja zwrotna')}}: 300 PLN</div>
						</div>
						<div class="row mb-2">
							<div class="col-lg-4 col-sm-12 sm-facilities"><img src="{{ asset("images/apartment_detal/double-bed.png") }}">{{__('Przyjazny zwierzętom')}}</div>
							<div class="col-lg-4 col-sm-12"><img src="{{ asset("images/apartment_detal/double-bed.png") }}">{{__('Zakaz palenia')}}</div>
							<div class="col-4 mobile-none"></div>
						</div>
					</div>
					<div class="col-12 mb-2">
						<div class="row">
							<div class="col-lg-2 col-sm-12">{{__('Odwołanie rezerwacji/ przedpłata')}}:</div>
							<div class="col-lg-10 col-sm-12">
								Oferta zwrotna – możliwość bezpłatnego odwołania do 30 dni przed przyjazdem.
							</div>
						</div>
					</div>
					<div class="col-12 mb-2">
						<div class="row">
							<div class="col-lg-2 col-sm-12">{{__('Dodatkowe informacje')}}:</div>
							<div class="col-lg-10 col-sm-12">
								Cena zakwaterowania nie obejmuje opłaty za zużycie energii elektrycznej
							</div>
						</div>
					</div>
				</div>

				<div class="row mt-3 mb-3 font-12">
					<div class="col-12">
						<h4 id="map" class="anchor-destination"><b>{{__('Mapa')}}</b></h4>
					</div>
					<div class="col-12 mb-2">
						<form name="wskazowki" action="#" onsubmit="znajdz_wskazowki(); return false;">
							<div class="row">
								<div class="col-12" style="font-size: 16px"><b>{{  $groupDescription[0]->group_name or '' }}</b></div>
								<div class="col-12 mb-4" style="font-size: 14px">{{ $groupDescription[0]->apartament_city }}, {{ $groupDescription[0]->apartament_address }}, {{ $groupDescription[0]->apartament_address_2 }}</div>
								<div class="col-12 mb-2" style="font-size: 14px">GPS: {{ $groupDescription[0]->apartament_gps }}</div>
							</div>
							<div class="row col-12 my-2">
								<span style="font-size: 16px">Wskazówki dojazdu: </span>
								<input class="font-12 ml-2" name="skad" id="skad" style="width:180px" placeholder="Lokalizacja początkowa" type="text">
								<input class="btn btn-info btn-mobile btn-res4th" value="Pokaż" type="submit">
								<div class="col-2 font-12 ml-3" style="display: inline-block;">
									<div id="distance" class="row" style="font-weight: bold"></div>
									<div id="duration" class="row"></div>
								</div>
								<div class="col-3">
									<a class="btn btn-info btn-mobile btn-res4th pull-right">Drukuj wskazówki dojazdu</a>
								</div>
							</div>
						</form>
						<div id="wskazowki"></div>
						<div id="mapka" style="width: 100%; height: 500px; margin-bottom: 30px;"></div>
					</div>
				</div>

				<div class="row mt-3 mb-3 font-12">
					<div class="col-12 mb-3">
						<h4 id="map" class="anchor-destination"><b>{{__('Apartamenty w kompleksie')}} ({{$apartamentsAmount}})</b></h4>
					</div>
					<div class="col-12 mb-2 row">
						@foreach ($apartaments as $apartament)
							<div style="overflow: auto;" class="col-md-6 col-sm-12" itemscope itemtype="http://schema.org/Hotel">
								<div class="map-img-wrapper">
									<div class="apartament img-group-detail" style="background-image: url('{{ asset("images/apartaments/$apartament->id/1.jpg") }}'); background-size: cover; position: relative; margin-bottom: 0px">
										<div class="map-see-more mobile-none">
											<div class="container py-1">
												<a href="#" style="width: 100%; color: black" class="btn btn-primary">{{ __("messages.book") }}</a>
											</div>
											<div class="container py-1">
												<a href="/apartaments/{{ $apartament->apartament_link }}" class="btn btn-primary" style="width: 100%; color: black">{{ __("messages.see details") }}</a>
											</div>
										</div>
										<div class="desktop-none" style="width: 100%; height: 100%">
											<a style=" display: inline-block; width: 100%; height: 100%" href="/apartaments/{{ $apartament->apartament_link }}"></a>
										</div>
									</div>
									<div class="add-to-favourities"><a href="#"><img data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Add to favorites') }}" src='{{ asset("images/results/heart.png") }}'></a></div>

									<div class="map-description-top">{{ $apartament->min_price }} PLN</div>
									<div class="map-description-bottom">{{ __("messages.Breakfast included") }}</div>
									<div class="description-bottom-right mobile-none">
										@for ($i = 0; $i < 5; $i++)
											<img src='{{ asset("images/results/star.png") }}'>
										@endfor
										<br><span style="color: green; margin-right: 10px;">{{ __("messages.Perfect") }}</span> <span style="color: blue;">55 {{ __("messages.reviews_number") }}</span>
									</div>
								</div>
								<div class="description-below" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
									<span style="font-size: 17px" itemprop="name">{{ $apartament->apartament_name }}</span>
									<span style="display:block; font-size: 11px">{{ $apartament->apartament_district }}</span>
									<span style="display:block; font-size: 11px" itemprop="streetAddress">{{ $apartament->apartament_address }}</span>
									<div class="mt-2">
										<div class="description-below-img" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.people') }}" style="background-image: url('{{ asset("images/results/person.png") }}');"> <span>{{ $apartament->apartament_persons }}</span> </div>
										<div class="description-below-img" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.single beds') }}" style="background-image: url('{{ asset("images/results/doubleBed.png") }}');"> <span>{{ $apartament->apartament_double_beds }}</span> </div>
										<div class="description-below-img" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.double beds') }}" style="background-image: url('{{ asset("images/results/bed.png") }}');"> <span>{{ $apartament->apartament_single_beds }}</span> </div>
										@if ( $apartament->apartament_wifi == 1)
											<div class="description-below-img" data-toggle="tooltip" data-placement="bottom" title="Wifi" style="background-image: url('{{ asset("images/results/wifi.png") }}');"> </div>
										@endif
										@if ( $apartament->apartament_parking == 1)
											<div class="description-below-img" data-toggle="tooltip" data-placement="bottom" title="Parking" style="background-image: url('{{ asset("images/results/parking.png") }}');"> </div>
										@endif
									</div>
									<div class="description-map-bottom-right desktop-none">
										@for ($i = 0; $i < 5; $i++)
											<img src="{{ asset("images/results/star.png") }}">
										@endfor
										<br>
										<span style="color: green; margin-right: 10px">{{ __("messages.Perfect") }}</span>
										<span style="color: blue">55 {{ __("messages.reviews_number") }}</span>
									</div>
								</div>
							</div>
						@endforeach
					</div>
				</div>
			</div>
				<span id="similarApartments" class="mobile-none" style="width: 100%">
				@if($countedCookies > 0)
						<h2 class="pb-2" style="margin-top: 40px; font-size: 26px">{{__('Osoby, które oglądały ten obiekt oglądały również')}}</h2>
						@include('includes.see-also-apartment')
					@endif
			</span>
				<span class="mobile-none" style="width: 100%">
				@if($countedCookies > 0)
						<h2 class="pb-2" style="margin-top: 40px; font-size: 26px">{{__('messages.lastSeen')}}</h2>
						@include('includes.last-seen-apartment-detail')
					@endif
			</span>
		</div>

	</div>
		<script src="http://maps.google.com/maps/api/js?key=AIzaSyBBEtTo5au09GsH6EvJhj1R_uc0BpTLVaw&language=PL" type="text/javascript"></script>
		<script type="text/javascript">

            var mapa;
            var dymek = new google.maps.InfoWindow();
            var greenMarkers = [];
            var trasa  		 = new google.maps.DirectionsService();
            var trasa_render = new google.maps.DirectionsRenderer();

            function mapaStart()
            {
                var wspolrzedne = new google.maps.LatLng({{ $apartament->apartament_geo_lat }}, {{ $apartament->apartament_geo_lan }});
                var greenIcon = new google.maps.MarkerImage('{{ asset("images/map/u3576.png") }}');
                var opcjeMapy = {
                    zoom: 13,
                    center: wspolrzedne,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                };

                mapa = new google.maps.Map(document.getElementById("mapka"), opcjeMapy);
                trasa_render.setMap(mapa);
                trasa_render.setPanel(document.getElementById('wskazowki'));
                var marker1 = dodajZielonyMarker( {{ $apartament->apartament_geo_lat }}, {{ $apartament->apartament_geo_lan }},'', greenIcon);
            }

            function znajdz_wskazowki()
            {
                var dane_trasy =
                    {
                        origin: document.getElementById('skad').value,
                        destination: "{{ $apartament->apartament_city }}, {{ $apartament->apartament_address }}",
                        travelMode: google.maps.DirectionsTravelMode.DRIVING
                    };

                trasa.route(dane_trasy, obsluga_wskazowek);
                greenMarkers[0].setMap(null);
            }

            function obsluga_wskazowek(wynik, status)
            {
                if(status != google.maps.DirectionsStatus.OK || !wynik.routes[0])
                {
                    alert('Nie znaleziono lokalizacji początkowej');
                    return;
                }

                trasa_render.setDirections(wynik);
                $("#distance").text(wynik.routes[0].legs[0].distance.text);
                $("#duration").text(wynik.routes[0].legs[0].duration.text);
                $('#wskazowki').css({display: 'block'});
            }

            function dodajZielonyMarker(lat,lng,txt, ikona)
            {
                var opcjeMarkera =
                    {
                        position: new google.maps.LatLng(lat,lng),
                        map: mapa,
                        icon: ikona
                    }
                var marker = new google.maps.Marker(opcjeMarkera);
                marker.txt=txt;

                greenMarkers.push(marker);
                return marker;
            }

            $(document).ready(function(){
                mapaStart();
            });
		</script>

			{{--for mobile and tablet--}}
			@handheld
			<script type="text/javascript">
                $(function(){
                    // Check the initial Poistion of the Sticky Header
                    bottom = $('#stickyReservationPanel').offset().top + $('#stickyReservationPanel').outerHeight();
                    resizeReservationPanel = 0;

                    $(window).scroll(function(){
                        if( $(window).scrollTop() > bottom ) {
                            $('#stickyReservationPanelMobile').css({display: 'flex'});
                        } else {
                            $('#stickyReservationPanelMobile').css({display: 'none'});
                        }
                    });
                });
			</script>
			@elsehandheld
			<script type="text/javascript">
                $(function(){
                    // Check the initial Poistion of the Sticky Header
                    var stickyHeaderTop = $('#stickyReservationPanel').offset().top;
                    var stickyHeaderRight = $('#stickyReservationPanel').offset().left;
                    var similarApartmentsTop = $('#similarApartments').offset().top;

                    $(window).scroll(function(){
                        var reservationPanelHeight = $('#stickyReservationPanel').outerHeight();
                        var sumHeight = similarApartmentsTop - reservationPanelHeight + 80;

                        if($(window).scrollTop() > stickyHeaderTop && $(window).scrollTop() < sumHeight) {
                            $('#stickyReservationPanel').css({position: 'fixed', top: '0px', left: stickyHeaderRight});
                        } else {
                            if($(window).scrollTop() < stickyHeaderTop) $('#stickyReservationPanel').css({position: 'static', top: '0px', left: stickyHeaderRight});
                            else $('#stickyReservationPanel').css({position: 'absolute', top: sumHeight, left: stickyHeaderRight});
                        }
                    });
                });
			</script>
			@endhandheld

			<script type="text/javascript">
                $('.res-info').hide();

                $(document).ready(function(){
                    var firstArrival = '2018-01-01';
                    var firstDeparture = '2018-01-01';

                    $.fn.changeVal = function (v) {
                        return $(this).val(v).trigger("change");
                    }

                    $('.pick-date').dateRangePicker(
                        {
                            separator : ' to ',
                            autoClose: true,
                            startOfWeek: 'monday',
                            language:'{{ App::getLocale() }}',
                            startDate: new Date(),
                            customOpenAnimation: function(cb)
                            {
                                $(this).fadeIn(100, cb);
                            },
                            customCloseAnimation: function(cb)
                            {
                                $(this).fadeOut(100, cb);
                            },

                            getValue: function()
                            {
                                if ($('#przyjazd').val() && $('#powrot').val() )
                                    return $('#przyjazd').val() + ' to ' + $('#powrot').val();
                                else
                                    return '';
                            },

                            setValue: function(s,s1,s2)
                            {
                                $('#przyjazd').val(s1);
                                $('#powrot').val(s2);
                                ajaxConenction();
                            }
                        });

                    var ids = [<?php echo '"'.implode('","', $idApartments).'"' ?>];

                    function ajaxConenction(){
                        var dateInc = $("#przyjazd");
                        var dateOut = $("#powrot");

                        $.ajax({
                            type: "GET",
                            url: '/checkGroup',
                            dataType : 'json',
                            data: {
                                przyjazd: dateInc.val(),
                                powrot: dateOut.val(),
                                ids: ids,
                            },
                            success: function(data) {

                                $('#ilenocy').val(data.days_number);

                                if(data.is_available) {
                                    $('.termin').css('color','green');
                                    $('#not-Av-panel').hide();
                                    if (data.message == 1) $('.termin').text("Apartament dostępny");
                                    else $('.termin').text("Apartment is available");
                                    $('#price').text(data.price+" PLN");
                                    $('input[name="link"').val(data.link);
                                    $('.res-info').show(1000);
                                    $('.res-btn').show();

							@handheld
                                    $("#mobileReservation").on('click', function(){
                                        $('form#resForm').submit();
                                    });
							@endhandheld
                                }
                                else {
                                    $('.termin').css('color','red');
                                    $('#not-Av-panel').show();
                                    $('.res-info').show(1000);
                                    $('.termin').hide();
                                    $('.res-btn').hide();
                                    firstArrival = data.firstArrival;
                                    firstDeparture = data.firstDeparture;

 							@handheld
                                    $("#mobileReservation").off("click");
 							@endhandheld
                                }

                        @handheld
                                if(resizeReservationPanel == 0){
                                    bottom = bottom + 120;
                                    resizeReservationPanel = 1;
                                }
						@endhandheld
                            },
                            error: function() {
                                console.log( "Error in connection with controller");
                            },
                        });
                    }

                    $('#firstFreeDate').click(function() {
                        $('#przyjazd').val(firstArrival);
                        $('#powrot').val(firstDeparture);

                        ajaxConenction();
                    });

                });


			</script>

@endsection