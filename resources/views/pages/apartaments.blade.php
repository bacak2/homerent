@extends ('layout.layout')

@section('title', $apartament->apartament_city.' - '.$apartament->descriptions[0]->apartament_name.' - Zarezerwuj już teraz' )

@section('content')
	<div class="row">
		<div class="container py-1"><a href="{{ url()->previous() }}" class="btn btn-primary ml-2">{{ __('messages.Return') }}</a></div>
	</div>
	<div class="row back" style="background-image: url('{{ asset("images/apartaments/$apartament->id/1.jpg") }}">
		<div class="container">
			<div class="row apartament-info" >
				<div class="col-md-8">
					<div class="col transparent mt-2 mb-2 pb-1 pt-1 ">
						<h1 style="font-size: 26px"><b>{{  $apartament->descriptions[0]->apartament_name or '' }}</b></h1>
						<h2 style="font-size: 20px">{{ $apartament->apartament_city }}, {{ $apartament->apartament_address }}, {{ $apartament->apartament_address_2 }}</h2>
					</div>
					<div class="col transparent mt-4 mb-2 pt-3 ">
						<div class="container">
							<div class="row">
								<div class="col-md-3">
									<div class="row">
										<i class="fa fa-user fa-lg pt-1" aria-hidden="true"></i>
										<p class="pl-2">{{ __('messages.Room for') }} {{ $apartament->apartament_persons }} {{trans_choice('messages.persons',$apartament->apartament_persons)}}</p>
									</div>
								</div>
								<div class="col-md-3">
									<div class="row">
										<i class="fa fa-home fa-lg pt-1" aria-hidden="true"></i>
										<p class="pl-2">{{ $apartament->apartament_rooms_number }} {{trans_choice('messages.rooms_number',$apartament->apartament_rooms_number)}}</p>
									</div>
								</div>
								<div class="col-md-3">
									<div class="row">
										<i class="fa fa-calculator fa-lg pt-1" aria-hidden="true"></i>
										<p class="pl-2">{{ __('messages.ApSize') }}: 17 m²</p>
									</div>
								</div>
								<div class="col-md-3">
									<div class="row">
										<i class="fa fa-bed fa-lg pt-1" aria-hidden="true"></i>
										<p class="pl-2">{{ $beds }} {{trans_choice('messages.beds_number',$beds)}} </p>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col transparent mt-5 mb-3 pt-3" style="visibility: hidden;"></div>
					<div class="col transparent mt-4 mb-2 pt-3" style="visibility: hidden;">Śniadanie w cenie</div>
					<div id="stickyAnchor" class="row" style="margin-left: 0px">
						<a href="#description" class="anchor">
							<div>Opis</div>
						</a>
						<a href="#photos" class="anchor">
							<div>Zdjęcia</div>
						</a>
						<a href="#facilities" class="anchor">
							<div>Udogodnienia</div>
						</a>
						<a href="#rules" class="anchor">
							<div>Zasady</div>
						</a>
						<a href="#availability" class="anchor">
							<div>Dostępność</div>
						</a>
						<a href="#map" class="anchor">
							<div>Mapa</div>
						</a>
						<a href="#opinions" class="anchor">
							<div>Opinie</div>
						</a>
					</div>
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
						{!! Form::hidden('link', $apartament->descriptions[0]->apartament_link) !!}
						{!! Form::hidden('id', $apartament->id) !!}
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
												@for($i=1; $i <= $apartament->apartament_persons; $i++)
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
			<div class="col-md-8">
				<div class="row mb-3" style="margin-top: 50px">
					<div class="col">
						<h4 id="description" class="anchor-destination"><b>{{ __('messages.description') }}</b></h4>
						<p>{{ $apartament->descriptions[0]->apartament_description or '' }}</p>
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

				<div class="row mb-3 font-12">
					<div class="col-12">
						<h4 id="facilities" class="anchor-destination mt-2 mt-md-0"><b>{{__('Udogodnienia')}}</b></h4>
					</div>
					<div class="col-4">
						<h5 class="mt-2 mt-md-0"><b>{{__('O apartamencie')}}</b></h5>
					</div>
					<div class="col-4">
						<h5 class="mt-2 mt-md-0"></h5>
					</div>
					<div class="col-4">
						<h5 class="mt-2 mt-md-0"><b>{{__('Kuchnia')}}</b></h5>
					</div>
					<div class="col-md-4 font-12">
						<div class="row mb-2">
							<div class="col-6">Max liczba osób:</div>
							<div class="col-6">4</div>
						</div>
						<div class="row mb-2">
							<div class="col-6">Ilośc pokoi:</div>
							<div class="col-6">4</div>
						</div>
						<div class="row mb-2">
							<div class="col-6">Ilośc pokoi nieprzechodnich:</div>
							<div class="col-6">4</div>
						</div>
						<div class="row mb-2">
							<div class="col-6">Ilośc łóżek podwójnych:</div>
							<div class="col-6">4</div>
						</div>
						<div class="row mb-2">
							<div class="col-6">Suma łóżek:</div>
							<div class="col-6">4</div>
						</div>
						<div class="row mb-2">
							<div class="col-6">Metraż:</div>
							<div class="col-6">4 m<sup>2</sup></div>
						</div>
						<div class="row mb-2">
							<div class="col-6">Piętro:</div>
							<div class="col-6">1</div>
						</div>
						<div class="row mb-2">
							<div class="col-6">Pozostałe wyposażenie:</div>
							<div class="col-6">żelazko</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="row mb-2">
							<div class="col"><img src="{{ asset("images/apartment_detal/check.png") }}">Internet bezprzewodowy Wi-Fi</div>
						</div>
						<div class="row mb-2">
							<div class="col"><img src="{{ asset("images/apartment_detal/check.png") }}">Garaż</div>
						</div>
					</div>
					<div class="col-md-4">
						<h5 class="mt-2 mt-md-0"><b>{{__('Łazienka')}}</b></h5>

					</div>
				</div>

				<div class="row mt-3 mb-3 font-12">
					<div class="col-12">
						<h4 id="rules" class="anchor-destination mt-2 mt-md-0"><b>{{__('Zasady')}}</b></h4>
					</div>
					<div class="col-12 mb-2">
						<div class="row">
							<div class="col-2"><b>{{__('messages.Check-in')}}:</b></div>
							<div class="col-10">{{$apartament->apartament_registration_time }}</div>
						</div>
					</div>
					<div class="col-12 mb-2">
						<div class="row">
							<div class="col-2"><b>{{__('messages.Check-out')}}:</b></div>
							<div class="col-10">{{$apartament->apartament_checkout_time }}</div>
						</div>
					</div>
					<div class="col-12 mb-2">
						<div class="row">
							<div class="col-2"><b>{{__('Odwołanie rezerwacji/ przedpłata')}}:</b></div>
							<div class="col-10">
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor.
							</div>
						</div>
					</div>
					<div class="col-12 mb-2">
						<div class="row">
							<div class="col-2"><b>{{__('Zwierzęta')}}:</b></div>
							<div class="col-10">
								Zwierzęta są akceptowane na życzenie. Mogą obowiązywać dodatkowe opłaty
							</div>
						</div>
					</div>
					<div class="col-12 mb-2">
						<div class="row">
							<div class="col-2"><b>{{__('Inne')}}:</b></div>
							<div class="col-10">
								Cena zakwaterowania nie obejmuje opłaty za zużycie energii elektrycznej
							</div>
						</div>
					</div>
				</div>

				<div class="row mt-3 mb-3 font-12">
					<div class="col-12">
						<h4 id="availability" class="anchor-destination mt-2 mt-md-0"><b>{{__('Dostępność')}}</b></h4>
					</div>
					<div class="col-12 mb-2">
						<div class="row">
							Kalendarz
						</div>
					</div>
				</div>

				<div class="row mt-3 mb-3 font-12">
					<div class="col-12">
						<h4 id="map" class="anchor-destination mt-2 mt-md-0"><b>{{__('Mapa')}}</b></h4>
					</div>
					<div class="col-12 mb-2">
						<form name="wskazowki" action="#" onsubmit="znajdz_wskazowki(); return false;">
							<div class="row">
								<div class="col-12" style="font-size: 16px"><b>{{  $apartament->descriptions[0]->apartament_name or '' }}</b></div>
								<div class="col-12 mb-4" style="font-size: 14px">{{ $apartament->apartament_city }}, {{ $apartament->apartament_address }}, {{ $apartament->apartament_address_2 }}</div>
								<div class="col-12 mb-2" style="font-size: 14px">GPS: N 48° 12' 39.90'' E 16° 23' 1.82''</div>
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
						<div id="mapka" style="width: 100%; height: 500px; margin-bottom: 30px;"></div>
					</div>
					<!--h3 class="mb-3"><b>Wskazówki dojazdu</b></h3>
					<div id="wskazowki"></div-->
				</div>

				<!--div id="calendar"></div-->
			</div>
			<div class="col-md-4">
				<div class="row">

				</div>
				<div class="row">

				</div>
			</div>
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
	<script type="text/javascript">

        $(function(){
            // Check the initial Poistion of the Sticky Header
            var stickyHeaderTop = $('#stickyReservationPanel').offset().top;
            var stickyHeaderRight = $('#stickyReservationPanel').offset().left;

            $(window).scroll(function(){
                if( $(window).scrollTop() > stickyHeaderTop ) {
                    $('#stickyReservationPanel').css({position: 'fixed', top: '0px', left: stickyHeaderRight});
                } else {
                    $('#stickyReservationPanel').css({position: 'static', top: '0px', left: stickyHeaderRight});
                }
            });
        });

        $(function(){
            // Check the initial Poistion of the Sticky Header
            var stickyAnchorTop = $('#stickyAnchor').offset().top;
            var stickyAnchorRight = $('#stickyAnchor').offset().left;

            $(window).scroll(function(){
                if( $(window).scrollTop() > stickyAnchorTop ) {
                    $('#stickyAnchor').css({position: 'fixed', top: '0px', left: stickyAnchorRight});
                } else {
                    $('#stickyAnchor').css({position: 'static', top: '0px', left: stickyAnchorRight});
                }
            });
        });

		var $calendar = $('#calendar').fullCalendar({
			header: {
				left: 'prev',
				center: 'title',
				right: 'next'
			},

			lang: 'en',
			defaultView: 'month',

			dayRender: function (date, cell) {
				var today = new Date();
				var date = new Date(2019);

				if (date.getDate() < today.getDate()) {
					//cell.css("background-color", "red");
					cell.addClass("notAv");;
				}
			}
		});

		$('#calendar').fullCalendar({

		});

		$('.res-info').hide();

		$(document).ready(function(){

			$.fn.changeVal = function (v) {
				return $(this).val(v).trigger("change");
			}

			$('.pick-date').dateRangePicker(
					{
						separator : ' to ',
						autoClose: true,
						startOfWeek: 'monday',
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

						},
					});




			function ajaxConenction(){
				var dateInc = $("#przyjazd");
				var dateOut = $("#powrot");
				var id = {{ $apartament->id }};

				$.ajax({
					type: "GET",
					url: '/test',
					dataType : 'json',
					data: {
						przyjazd: dateInc.val(),
						powrot: dateOut.val(),
						id: id,
					},
					success: function(data) {
						//console.log(data);

						$('#ilenocy').val(data.days_number);


						if(data.is_available) {
							$('.termin').css('color','green');
							if (data.message == 1) $('.termin').text("Apartament dostępny");
							else $('.termin').text("Apartment is available");
							$('#price').text(data.price+" PLN");
							$('.res-info').show(1000);
							$('.res-btn').show();
						}
						else {
							$('.termin').css('color','red');
							if (data.message == 1) $('.termin').text("Apartament zajęty");
							else $('.termin').text("Apartment is not available");
							$('.res-info').show(1000);
							$('.res-btn').hide();
						}
					},
					error: function() {
						console.log( "Error in connection with controller");
					},
				});
			}
		});


	</script>

@endsection
