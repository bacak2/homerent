@extends ('layout.layout')

@section('title', $groupDescription[0]->apartament_city.' - '.$groupDescription[0]->group_name.' - Zarezerwuj już teraz' )

@section('content')
	<div class="row mx-0">
		<div class="container py-1">
			<div class="pull-left d-none d-md-block">
				<a href="{{ url()->previous() }}" class="pointer-back" style="background-image: url('{{ asset("images/apartment_detal/backButton.png") }}')">
					<div  class="btn font-13 py-2 px-3" style="width: 100%" >
						Powrót do wyników wyszukiwania
					</div>
				</a>
			</div>
			<div class="d-md-none pull-left font-13 mt-2 ml-md-3 col-12 px-0">
				<a href="{{route('index')}}">Start ></a>
				<form action="/search/kafle" class="d-inline" method="GET">
					<input type="hidden" name="region" value="{{$apartaments[0]->apartament_city}}">
					<input type="hidden" name="przyjazd" value="{{$todayDate}}">
					<input type="hidden" name="powrot" value="{{$tomorrowDate}}">
					<input type="hidden" name="dzieci" value="0">
					<input type="hidden" name="dorosli" value="1">
					<input class="hrefSubmit" type="submit" style="color: #0066CC" value="{{$apartaments[0]->apartament_city}} >">
				</form>
				<span class="bold ml-1">{{$groupDescription[0]->group_name}}</span>
			</div>
			<div class="d-md-none col-3 col-md-4 d-inline-block pl-0 pr-0 pr-sm-3 my-2">
				<a href="{{ url()->previous() }}" class="pointer-back" style="background-image: url('{{ asset("images/apartment_detal/backButtonMobile.png") }}')">
					<div  class="btn font-13 py-2 px-3" style="width: 100%" >
						{{ __('messages.Return') }}
					</div>
				</a>
			</div>
			<span class="pull-right my-2 my-md-0">
				{{--<div class="d-inline-block">
					<div id="addApartamentToFavourites" @if($isInFavourites > 0) style="display:none" @endif onClick="addToFavourites({{$groupDescription[0]->id}}, {{Auth::user()->id ?? 0}})">
						<div class="d-inline-block mr-1" style="width: 38px; background-color: rgba(242, 242, 242, 1); border: 1px solid rgba(153, 153, 153, 1); border-radius: 4px">
							<img style="padding: 5px 7px; max-width: 36px" src="{{asset('images/results/heart.png')}}">
						</div>
						<div class="mobile-none d-inline-block font-13 txt-blue" style="margin-top: 6px;">Zapisz</div>
					</div>
				</div>
				<div class="d-inline-block">
					<div id="deleteApartamentFromFavourites" @if($isInFavourites == 0) style="display:none" @endif onClick="deleteFromFavourites({{$groupDescription[0]->id}}, {{Auth::user()->id ?? 0}})">
						<div class="d-inline-block mr-1" style="width: 38px; background-color: rgba(242, 242, 242, 1); border: 1px solid rgba(153, 153, 153, 1); border-radius: 4px">
							<img style="padding: 5px 7px; max-width: 36px" src="{{asset('images/results/heart.png')}}">
						</div>
						<div class="mobile-none d-inline-block font-13 txt-blue" style="margin-top: 6px;">Usuń z ulubionych</div>
					</div>
				</div>
				<div class="mobile-none d-inline-block">|</div>--}}
				<div class="d-inline-block">
					<div class="d-inline-block send-news-friends mr-1" style="width: 38px; background-color: rgba(242, 242, 242, 1); border: 1px solid rgba(153, 153, 153, 1); border-radius: 4px">
						<img style="padding: 7px 9px; max-width: 36px" src="{{asset('images/favourites/Envelop.png')}}">
					</div>
					<div class="mobile-none d-inline-block send-news-friends font-13 txt-blue" style="margin-top: 6px;">Wyślij</div>
				</div>
				<div class="mobile-none d-inline-block">|</div>
				@mobile
				<div class="d-inline-block ml-3">
					<div class="fb-like" data-href="https://www.facebook.com/VisitZakopane/" data-layout="button_count" data-action="like" data-size="small" data-show-faces="false" data-share="false"></div>
				</div>
				@elsemobile

				<div class="d-inline-block mx-3">
					<div class="fb-like" data-href="https://www.facebook.com/VisitZakopane/" data-layout="button_count" data-action="like" data-size="small" data-show-faces="false" data-share="false"></div>
				</div>

				<div class="d-inline-block" style="position: relative;top: 6px;">
					<div class="g-plusone" data-size="medium"></div>
				</div>

				@endmobile
			</span>
		</div>
	</div>
	@handheld
	<div id="stickyReservationPanelMobile" class="w-100" style="margin-left: auto; margin-right: auto;">
		<div class="container">
			<div class="col-4 col-sm-3 col-md-2 d-inline-block pl-0 pr-1">
				<a href="{{ url()->previous() }}" class="pointer-back" style="background-image: url('{{ asset("images/apartment_detal/backButtonMobile.png") }}')">
					<div  class="btn font-13 py-2 px-3" style="width: 100%" >
						{{ __('messages.Return') }}
					</div>
				</a>
			</div>
			<div class="col-8 col-sm-9 col-md-10 d-inline-block px-0" style="margin-left: -5px;"><a id="mobileReservation" href="#stickyReservationPanel" class="btn btn-primary btn-black">Zarezerwuj</a></div>
		</div>
	</div>
	@endhandheld
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
				{{--!! Form::hidden('link', $groupDescription[0]->group_link) !!}
				{!! Form::hidden('id', $groupDescription[0]->id) !!}
				@for($i=1; $i <= $groupDescription[0]->apartament_persons; $i++)
					<option value="{{$i}}">{{$i}}</option>
				@endfor--}}
				<div id="stickyReservationPanel" class="col-md-4 ml-2 mr-2 ml-sm-0 mr-sm-0">
					<div class="col transparent mt-2 mb-2 pb-1 pt-1">
						<div class="row" id="lowestPricePerNight">
							<div class="col-8">{{ __('messages.lowestpricepnight')}}</div>
							<div class="col-4 text-right">
								<p><b>{{ $priceFrom }} zł</b></p>
							</div>
						</div>
						{!! Form::open(array('route' => 'reservations.firstStep', 'method' => 'get')) !!}
						{!! Form::hidden('link', $groupDescription[0]->group_link) !!}
						{!! Form::hidden('id') !!}
						<div class="form-row">
							<div class="w-100 t-datepicker pb-2">
								<div class="t-check-in" style="background-color: #fff"></div>
								<div class="t-check-out" style="background-color: #fff"></div>
							</div>
							<div class="form-row pb-3 w-100 mx-0">
								<div class="col-sm-6 pb-2 pl-0 pr-0 pr-lg-1">
									<div class="input-group mb-sm-0">
										<div class="input-group-addon" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.Adults') }}"><i class="fa fa-lg fa-male" aria-hidden="true" placeholder="{{ __('messages.adults')}}"></i></div>
										{{ Form::select('dorosli', $personsArray, $request->dorosli ?? $personsArray[""], array('class'=>'form-control', 'id'=>'dorosli', 'style'=>'width: 120px; height: 38px', 'required'=>'required', 'oninvalid'=>"this.setCustomValidity('Proszę wybrać liczbę osób')", 'oninput'=>"this.setCustomValidity('')"))}}
									</div>
								</div>
								<div class="col-sm-6 pb-2 pr-0 pl-0 pl-lg-1">
									<div class="input-group mb-sm-0">
										<div class="input-group-addon" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.Kids') }}"><i class="fa fa-child" aria-hidden="true" placeholder="{{ __('messages.kids')}}"></i></div>
										{{ Form::select('dzieci', $kidsArray, $request->dzieci ?? $kidsArray[0], array('class'=>'form-control', 'style'=>'width: 120px; height: 38px'))}}
									</div>
								</div>
							</div>
						</div>
						<div class="res-info" style="display: none">
							<div class="row">
								<div class="col-8">
									{{ __('messages.Chosen nights')}}
								</div>
								<div class="col-4">
									<p align="right"><b><input class="form-control" id="ilenocy" name="ilenocy" readonly style="width: 50px"></b></p>
								</div>
							</div>
							<div id="is-Av-panel" class="row">
								<div class="col-6">
									<h3>{{ __('messages.fprice') }}</h3>
								</div>
								<div class="col-6 text-right is-Av-panel">
									<h3><b><span id="price"></span></b></h3>
								</div>
								<div class="col font-13">Szczegóły <span id="expand-price" class="font-11">(rozwiń) <img src='{{ asset("images/apartment_detal/arrow_down_24.png") }}'></span></div>
								<div id="price-details" class="col-12 font-13" style="display: none"></div>
							</div>
							<div class="row">
								<div class="col-12 text-center font-weight-bold">
									<p class="termin"></p>
									<div id="not-Av-panel" class="p-2">
										<i class="fa fa-lg fa-exclamation-triangle" style="color: black"></i>
										<b>Ten termin nie jest dostępny - wybierz inną datę</b>
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
						<p>{!!$groupDescription[0]->apartament_description or '' !!}</p>
						<div class="row mb-2" style="font-size: 14px">
							<div class="col-4">Apartamentów w kompleksie:<span class="pull-right">{{$apartamentsAmount}}</span></div>
							<div class="col-4">Liczba pokoi:<span class="pull-right">{{$groupDescription[0]->apartament_rooms_number}}</span></div>
							<div class="col-4">Liczba łóżek podwójnych:<span class="pull-right">{{$groupDescription[0]->apartament_double_beds}}</span></div>
						</div>
						<div class="row" style="font-size: 14px">
							<div class="col-4">Max liczba osób:<span class="pull-right">{{$groupDescription[0]->apartament_persons}}</span></div>
							<div class="col-4">Liczba sypialni:<span class="pull-right">{{$groupDescription[0]->apartament_bedrooms}}</span></div>
							<div class="col-4">Liczba łóżek pojedynczych:<span class="pull-right">{{$groupDescription[0]->apartament_single_beds}}</span></div>
						</div>
					</div>
				</div>
				<div class="row mb-3">
					<div class="col">
						<h4 id="photos" lass="anchor-destination"><b>{{ __('messages.photos') }}</b></h4>
						<div class="fotorama" data-nav="thumbs" data-autoplay="true">

							@forelse($images as $image)
								<a href="{{ asset("images/apartaments/$image->id/$image->photo_link") }}"><img src="{{ asset("images/apartaments/$image->id/$image->photo_link") }}"></a>
							@empty
								<p>Brak zdjęć dla tego apartamentu</p>
							@endforelse
						</div>
					</div>
				</div>
				@if($groupDescription[0]->apartament_additional_information != NULL)
				<div class="row mt-2 mb-3 font-12">
					<div class="col-12">
						<h4 id="rules" class="anchor-destination"><b>{{__('Zasady')}}</b></h4>
					</div>
					<div class="col-12 mb-2">
						<div class="row">
							<div class="col-lg-2 col-sm-12">{{__('Dodatkowe informacje')}}:</div>
							<div class="col-lg-10 col-sm-12">
								{{$groupDescription[0]->apartament_additional_information}}
							</div>
						</div>
					</div>
				</div>
				@endif
					<div class="row mt-3 mb-3 font-12">
						<div class="col-12">
							<h4 id="map" class="anchor-destination"><b>{{__('Mapa')}}</b></h4>
						</div>
						<div class="col-12 mb-2">
							<ul class="nav nav-tabs">
								<li class="nav-item">
									<a class="nav-link active" data-toggle="tab" href="#showMap">Mapa</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" data-toggle="tab" href="#showStreetview">Okolica (Street view)</a>
								</li>
							</ul>
							<div class="tab-content">
								<div id="showMap" class="tab-pane active">
									<form name="wskazowki" action="#" onsubmit="znajdz_wskazowki(); return false;">
										<div class="row">
											<div class="col-12" style="font-size: 16px"><b>{{  $groupDescription[0]->descriptions[0]->apartament_name or '' }}</b></div>
											<div class="col-12 mb-4" style="font-size: 14px">{{ $groupDescription[0]->apartament_city }}, {{ $groupDescription[0]->apartament_address }}</div>
											<div class="col-12 mb-2" style="font-size: 14px">GPS: {{ $groupDescription[0]->apartament_gps }}</div>
										</div>
										<div class="row my-2 mx-0" style="position: relative;">
											<span class="col-12 px-0"style="font-size: 14px; margin-top: 5px">Wskazówki dojazdu: </span>
											<div class="col-6 col-md-3 px-0">
												<input class="font-12" name="skad" id="skad" style="width: 100%; height: 100%" placeholder="Lokalizacja początkowa" type="text">
											</div>
											<div class="col-3 col-md-2 px-1">
												<input class="btn btn-primary font-13 w-100 h-100 ml-0" value="Pokaż" type="submit">
											</div>
											<div class="col-3 col-md-2 col-lg-1 col-xl-2 font-12 pr-0 mr-lg-3">
												<div id="distance" class="row" style="font-weight: bold"></div>
												<div id="duration" class="row"></div>
											</div>
									</form>
									<form id="printDirections" action="{{route('printPdf')}}" class="mt-2 mt-md-0 pl-0" method="POST" name="wskazowki-print">
										<input type='hidden' id='wskazowkiContent' name='wskazowkiContent' value='' />
										<input id="drukujWskazowki" class="btn btn-default font-12 ml-0" value="Drukuj wskazówki dojazdu" style="display: none" type="submit">
									</form>
								</div>
								<div id="wskazowki"></div>
								<div id="mapka" style="width: 100%; height: 500px; margin-bottom: 30px;"></div>
							</div>
							<div id="showStreetview" class="tab-pane">
								<div id="streetView" style="width: 100%; height: 500px; margin-bottom: 30px;"></div>
							</div>
						</div>
					</div>
				</div>

				<div class="row mt-3 mb-3 font-12">
					<div class="col-12 mb-3">
						<span class="anchor-destination"></span>
						<h4 id="map" class="bold">{{__('Apartamenty w kompleksie')}} ({{$apartamentsAmount}})</h4>
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
												<a href="/apartaments/{{ $apartament->apartament_link }}" class="btn btn-see-more" style="width: 100%; color: black">{{ __("messages.see details") }}</a>
											</div>
										</div>
										<div class="desktop-none" style="width: 100%; height: 100%">
											<a style=" display: inline-block; width: 100%; height: 100%" href="/apartaments/{{ $apartament->apartament_link }}"></a>
										</div>
									</div>
									<div class="add-to-favourities"><a href="#"><img data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Add to favorites') }}" src='{{ asset("images/results/heart.png") }}'></a></div>

									<div class="map-description-top">{{ $apartament->min_price }} PLN</div>
									<div class="map-description-bottom">{{ __("messages.Breakfast included") }}</div>
									<div class="description-bottom-right d-none d-sm-inline-block">
										@for ($i = 0; $i < floor($apartament->ratingAvg/2); $i++)
											<img src='{{ asset("images/results/star.png") }}'>
										@endfor
										@if(floor($apartament->ratingAvg/2) != ceil($apartament->ratingAvg/2))
											<img src='{{ asset("images/results/star_half.png") }}'>
										@endif
										@for ($i = ceil($apartament->ratingAvg/2); $i < 5; $i++)
											<img src='{{ asset("images/results/star_empty.png") }}'>
										@endfor
										<br>
										@if($apartament->ratingAvg < 1)
											<span class="opinion-to-left" style="margin-right: 10px;"></span>
										@elseif($apartament->ratingAvg < 2.5)
											<span class="opinion-to-left txt-red" style="margin-right: 10px;">{{ __("messages.Awful") }}</span>
										@elseif($apartament->ratingAvg < 4.5)
											<span class="opinion-to-left txt-red" style="margin-right: 10px;">{{ __("messages.Bad") }}</span>
										@elseif($apartament->ratingAvg < 6.5)
											<span class="opinion-to-left txt-yellow" style="margin-right: 10px;">{{ __("messages.Average") }}</span>
										@elseif($apartament->ratingAvg < 8.5)
											<span class="opinion-to-left txt-green" style="margin-right: 10px;">{{ __("messages.Very good") }}</span>
										@else
											<span class="opinion-to-left txt-green" style="margin-right: 10px;">{{ __("messages.Perfect") }}</span>
										@endif
										<span class="txt-blue nr-reviews-right">{{$apartament->opinionAmount ?? 0}} {{trans_choice('messages.nrReviews', $apartament->opinionAmount ?? 0)}}</span>
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
	<script type="text/javascript">
        $(document).ready(function(){
            $('.t-datepicker').tDatePicker({
                autoClose: true,
                numCalendar : @handheld 1 @elsehandheld 2 @endhandheld,
                dateCheckIn: '{{$_GET['t-start'] ?? ''}}',
                dateCheckOut: '{{$_GET['t-end'] ?? ''}}',
                titleCheckIn: 'Data przyjazdu',
                titleCheckOut: 'Data wyjazdu',
                titleToday: 'Dzisiaj',
                titleDateRange: 'Doba',
                titleDateRanges: 'Doby',
                iconDate: '<i class="fa fa-lg fa-calendar" aria-hidden="true"></i>',
                titleDays: ['Pn','Wt','Śr','Cz','Pt','Sb','Nd'],
                titleMonths: ['Styczeń','Luty','Marzec','Kwiecień','Maj','Czerwiec','Lipiec','Sierpień','Wrzesień','Październik','Listopad','Grudzień'],
        	});

			@if(isset($_GET['t-start']) && isset($_GET['t-end']) && isset($request->dorosli))
                dateInc = $('input[name=t-start]').val();
            	dateOut = $('input[name=t-end]').val();
            	ajaxConenction();
			@endif
        });

        var firstArrival = '2018-01-01';
        var firstDeparture = '2018-01-01';

        function ajaxConenction(){
            var ids = [<?php echo '"'.implode('","', $idApartments).'"' ?>];
            var adults = $("#dorosli option:selected").val();
            $.ajax({
                type: "GET",
                url: '/checkGroup',
                dataType : 'json',
                data: {
                    przyjazd: dateInc,
                    powrot: dateOut,
                    ids: ids,
                    dorosli: adults,
                },
                success: function(data) {

                    $('#ilenocy').val(data.days_number);

                    if(data.is_available) {
                        $('.termin').css('color','green');
                        $('#not-Av-panel').hide();
                        $('#is-Av-panel').show();
                        if (data.message == 1) $('.termin').text("Apartament dostępny");
                        else $('.termin').text("Apartment is available");
                        $('#price').text(data.price+" PLN");
                        $('input[name="link"]').val(data.link);
                        $('input[name="id"]').val(data.id);
                        $('.res-info').show(1000);
                        $('.res-btn').show();
                        $("#lowestPricePerNight").hide();
                        $('#expand-price').html("(rozwiń) <img src='{{ asset("images/apartment_detal/arrow_down_24.png") }}'>");
                        $('#price-details').hide();
                        $("#price-details").text("");
                        for(var i=0, n = data.detailPrice.length; i < n; i ++) {
                            $("#price-details").append("<div>" + moment(data.detailPrice[i].date_of_price, "YYYY-MM-DD").format("DD.MM   ddd") + "<span class='pull-right'>" + data.detailPrice[i].price_value + " PLN</span></div>");
                        }
                        $("#price-details").append("<div class='mt-2 mb-3'>Opłata za obsługę<span class='pull-right'>"+data.servicesPrice+" PLN</span></div>");
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
                        $("#lowestPricePerNight").show();
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

        $('.t-datepicker').on('afterCheckOut',function(e, dataDate) {
            checkIn = new Date(dataDate[0]);
            checkInMonth = checkIn.getMonth()+1;
            if(checkInMonth < 10) checkInMonth = "0"+checkInMonth;
            dateInc = checkIn.getFullYear()+"-"+checkInMonth+"-"+checkIn.getDate();

            checkOut = new Date(dataDate[1]);
            checkOutMonth = checkOut.getMonth()+1;
            if(checkOutMonth < 10) checkOutMonth = "0"+checkOutMonth;
            dateOut = checkOut.getFullYear()+"-"+checkOutMonth+"-"+checkOut.getDate();
            ajaxConenction();
        });

        $('#firstFreeDate').click(function() {
            $('input[name=t-start]').val(firstArrival);
            $('input[name=t-end]').val(firstDeparture);
            dateInc = $('input[name=t-start]').val();
            dateOut = $('input[name=t-end]').val();
            $('.t-datepicker').tDatePicker('updateCI', dateInc);
            $('.t-datepicker').tDatePicker('updateCO', dateOut)
            ajaxConenction();
        });

        $('#expand-price').click(function() {
            $('#price-details').toggle();
            if($('#price-details').is(":visible")) $("#expand-price").html("(zwiń) <img src='{{ asset("images/apartment_detal/arrow_up_24.png") }}'>");
            else $("#expand-price").html("(rozwiń) <img src='{{ asset("images/apartment_detal/arrow_down_24.png") }}'>");
        });

        $("#dorosli").change(function() {
            ajaxConenction();
        });
	</script>
		<script src="http://maps.google.com/maps/api/js?key=AIzaSyBBEtTo5au09GsH6EvJhj1R_uc0BpTLVaw&language=PL" type="text/javascript"></script>
		<script type="text/javascript">

            var mapa;
            var dymek = new google.maps.InfoWindow();
            var greenMarkers = [];
            var trasa  		 = new google.maps.DirectionsService();
            var trasa_render = new google.maps.DirectionsRenderer();

            function mapaStart()
            {
                var wspolrzedne = new google.maps.LatLng({{ $groupDescription[0]->apartament_geo_lat }}, {{ $groupDescription[0]->apartament_geo_lan }});
                var greenIcon = new google.maps.MarkerImage('{{ asset("images/map/u3576.png") }}');
                var opcjeMapy = {
                    zoom: 13,
                    center: wspolrzedne,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                };

                mapa = new google.maps.Map(document.getElementById("mapka"), opcjeMapy);
                trasa_render.setMap(mapa);
                trasa_render.setPanel(document.getElementById('wskazowki'));
                var marker1 = dodajZielonyMarker( {{ $groupDescription[0]->apartament_geo_lat }}, {{ $groupDescription[0]->apartament_geo_lan }},'', greenIcon);
            }

            function znajdz_wskazowki()
            {
                $("#drukujWskazowki").hide();
                $("#wskazowkiContent").val("");
                var dane_trasy =
                    {
                        origin: document.getElementById('skad').value,
                        destination: "{{ $groupDescription[0]->apartament_city }}, {{ $groupDescription[0]->apartament_address }}",
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
                else
                {
                    trasa_render.setDirections(wynik);
                    $("#distance").text(wynik.routes[0].legs[0].distance.text);
                    $("#duration").text(wynik.routes[0].legs[0].duration.text);
                    $('#wskazowki').css({display: 'block'});
                    setTimeout(function(){
                        var pdfContent = $("#wskazowki").html();
                        $("#wskazowkiContent").val(pdfContent);
                        $("#drukujWskazowki").show();
                    }, 2000);
                }

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

@endsection