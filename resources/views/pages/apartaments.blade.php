@extends ('layout.layout')

@section('title', $apartament->apartament_city.' - '.$apartament->descriptions[0]->apartament_name.' - Zarezerwuj już teraz' )

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
					<input type="hidden" name="region" value="{{$apartament->apartament_city}}">
					<input type="hidden" name="t-start" value="{{$todayDate}}">
					<input type="hidden" name="t-end" value="{{$tomorrowDate}}">
					<input type="hidden" name="dzieci" value="0">
					<input type="hidden" name="dorosli" value="1">
					<input class="hrefSubmit" type="submit" style="color: #0066CC" value="{{$apartament->apartament_city}} >">
				</form>
				<span class="bold ml-1">{{$apartament->descriptions[0]->apartament_name}}</span>
			</div>
			<div class="d-md-none col-3 col-md-4 d-inline-block pl-0 pr-0 pr-sm-3 my-2">
				<a href="{{ url()->previous() }}" class="pointer-back" style="background-image: url('{{ asset("images/apartment_detal/backButtonMobile.png") }}')">
					<div  class="btn font-13 py-2 px-3" style="width: 100%" >
						{{ __('messages.Return') }}
					</div>
				</a>
			</div>
			<span class="pull-right my-2 my-md-0">
				<div class="d-inline-block">
					<div id="addApartamentToFavourites" @if($isInFavourites > 0) style="display:none" @endif onClick="addToFavourites({{$apartament->id}}, {{Auth::user()->id ?? 0}})">
						<div class="d-inline-block mr-1" style="width: 38px; background-color: rgba(242, 242, 242, 1); border: 1px solid rgba(153, 153, 153, 1); border-radius: 4px">
							<img style="padding: 5px 7px; max-width: 36px" src="{{asset('images/results/heart.png')}}">
						</div>
						<div class="mobile-none d-inline-block font-13 txt-blue" style="margin-top: 6px;">Zapisz</div>
					</div>
				</div>
				<div class="d-inline-block">
					<div id="deleteApartamentFromFavourites" @if($isInFavourites == 0) style="display:none" @endif onClick="deleteFromFavourites({{$apartament->id}}, {{Auth::user()->id ?? 0}})">
						<div class="d-inline-block mr-1" style="width: 38px; background-color: rgba(242, 242, 242, 1); border: 1px solid rgba(153, 153, 153, 1); border-radius: 4px">
							<img style="padding: 5px 7px; max-width: 36px" src="{{asset('images/results/heart.png')}}">
						</div>
						<div class="mobile-none d-inline-block font-13 txt-blue" style="margin-top: 6px;">Usuń z ulubionych</div>
					</div>
				</div>
				<div class="mobile-none d-inline-block">|</div>
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
	<div class="row mx-0 back" style="background-image: url( {{ asset("images/apartaments/$apartament->id/main_big.jpg") }} );">
		<div class="container">
			<div class="row apartament-info" >
				<div class="col-md-8">
					<div class="col transparent mt-2 mb-2 pb-1 pt-1 ">
						<h1 style="font-size: 26px"><b>{{  $apartament->descriptions[0]->apartament_name or '' }}</b></h1>
						<h2 style="font-size: 20px">{{ $apartament->apartament_city }}, {{ $apartament->apartament_address }}</h2>
					</div>
					<div class="col transparent mt-4 mb-2 pt-3 ">
						<div class="container">
							<div class="row">
								<div class="col-sm-6 col-md-3">
									<div class="row">
										<p class="pl-2"><img src="{{ asset("images/apartment_detal/User_24.png") }}"><div class="col pl-1">{{ __('dla') }} {{ $apartament->apartament_persons }} {{trans_choice('messages.persons',$apartament->apartament_persons)}}</div></p>
									</div>
								</div>
								<div class="col-sm-6 col-md-3">
									<div class="row">
										<p class="pl-2"><img src="{{ asset("images/apartment_detal/House_24.png") }}"> {{ $apartament->apartament_rooms_number }} {{trans_choice('messages.rooms_number',$apartament->apartament_rooms_number)}}</p>
									</div>
								</div>
								<div class="col-sm-6 col-md-3">
									<div class="row">
										<p class="pl-2"><img src="{{ asset("images/apartment_detal/Calculator_2_24.png") }}"> {{$apartament->apartament_living_area}} m²</p>
									</div>
								</div>
								<div class="col-sm-6 col-md-3">
									<div class="row">
										<p class="pl-2"><img src="{{ asset("images/apartment_detal/HotelSign1_24.png") }}"> {{ $beds }} {{trans_choice('messages.beds_number',$beds)}} </p>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="mobile-none col transparent mt-5 mb-3 pt-3" style="visibility: hidden;"></div>
					<div class="mobile-none col transparent mt-4 mb-2 pt-3" style="visibility: hidden;">Śniadanie w cenie</div>
					<div id="stickyAnchor-wrapper" class="mobile-none tablet-none">
						<span style="font-size: 12px; color: white; display: block"><b>{{  $apartament->descriptions[0]->apartament_name or '' }}</b></span>
						<span class="mb-2" style="font-size: 10px; color: white; display: block">{{ $apartament->apartament_city }}, {{ $apartament->apartament_address }}, {{ $apartament->apartament_address_2 }}</span>
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
				</div>
				<div id="stickyReservationPanel" class="col-12 col-md-4 ml-0">
					<div class="col transparent mt-2 mb-2 pb-1 pt-1">
						<div class="row" id="lowestPricePerNight">
							<div class="col-8">{{ __('messages.lowestpricepnight')}}</div>
							<div class="col-4 text-right">
								<p><b>{{ $priceFrom }} zł</b></p>
							</div>
						</div>
						{!! Form::open(array('route' => 'reservations.firstStep', 'method' => 'get', 'id' => 'resForm')) !!}
						{!! Form::hidden('link', $apartament->descriptions[0]->apartament_link) !!}
						{!! Form::hidden('id', $apartament->id) !!}
						<div class="form-row">
							<div class="w-100 t-datepicker pb-2">
								<div class="t-check-in" style="background-color: #fff"></div>
								<div class="t-check-out" style="background-color: #fff"></div>
							</div>
							<div class="form-row pb-3 w-100 mx-0">
								<div class="col-sm-6 pb-2 pl-0 pr-0 pr-lg-1">
									<div class="input-group mb-sm-0">
										<div class="input-group-addon" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.Adults') }}"><i class="fa fa-lg fa-male" aria-hidden="true" placeholder="{{ __('messages.adults')}}"></i></div>
										{{ Form::select('dorosli', $personsArray, $request->dorosli ?? $personsArray[""], array('class'=>'form-control', 'style'=>'width: 120px; height: 38px', 'required'=>'required', 'oninvalid'=>"this.setCustomValidity('Proszę wybrać liczbę osób')", 'oninput'=>"this.setCustomValidity('')"))}}
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
										<b>Ten termin nie jest dostępny - wybierz inną datę</b><br>
										<a id="firstFreeDate" href="#">Zobacz pierwszy wolny termin</a>
										<span>lub</span>
										<a href="#availability">idź do kalendarza</a>
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
						<p>{!! $apartament->descriptions[0]->apartament_description or '' !!}</p>
					</div>
				</div>
				<div class="row mb-3">
					<div class="col">
						<h4 id="photos" class="anchor-destination"><b>{{ __('messages.photos') }}</b></h4>
						<div class="fotorama" data-nav="thumbs" data-autoplay="true">
							@forelse($images as $image)
								<a href="{{ asset("images/apartaments/$image->id/$image->photo_link") }}"><img src="{{ asset("images/apartaments/$image->id/$image->photo_link") }}"></a>
							@empty
								<p>Brak zdjęć dla tego apartamentu</p>
							@endforelse
						</div>
					</div>
				</div>

				<div class=" mb-3" style="font-size: 14px">
					<h4 id="facilities" class="anchor-destination"><b>{{__('Udogodnienia')}}</b></h4>
					    <div class="row">
							<div class="col-6 col-md-4 mb-3"><img src="{{ asset("images/apartment_detal/User_24.png") }}"> {{ $apartament->apartament_persons }} {{trans_choice('messages.nrPersons',$apartament->apartament_persons)}}</div>
							<div class="col-6 col-md-4 mb-3"><img src="{{ asset("images/apartment_detal/House_24.png") }}"> {{ $apartament->apartament_rooms_number }} {{trans_choice('messages.rooms_number', $apartament->apartament_rooms_number )}}</div>
							<div class="col-6 col-md-4 mb-3"><img src="{{ asset("images/apartment_detal/Calculator_2_24.png") }}"> {{ $apartament->apartament_living_area}} m<sup>2</sup></div>
							<div class="col-6 col-md-4 mb-3"><img src="{{ asset("images/apartment_detal/double-bed.png") }}"> {{ $apartament->apartament_double_beds }} {{trans_choice('messages.nrDouble beds', $apartament->apartament_double_beds)}}</div>
							<div class="col-6 col-md-4 mb-3"><img src="{{ asset("images/apartment_detal/bed.png") }}"> {{ $apartament->apartament_single_beds }} {{trans_choice('messages.nrSingle beds', $apartament->apartament_single_beds)}}</div>
							<div class="col-6 col-md-4 mb-3"><img src="{{ asset("images/apartment_detal/bedroom.png") }}"> {{ $apartament->apartament_bedrooms }} {{trans_choice('messages.nrBedrooms', $apartament->apartament_bedrooms)}}</div>
							<div class="col-6 col-md-4 mb-3"><img src="{{ asset("images/apartment_detal/Bath_Tub_24.png") }}"> {{ $apartament->apartament_bathrooms }} {{trans_choice('messages.nrBathrooms', $apartament->apartament_bathrooms)}}</div>
							@if($apartament->apartament_levels_number > 1)
								<div class="col-6 col-md-4 mb-3"><img src="{{ asset("images/apartment_detal/stairs.png") }}"> {{ $apartament->apartament_levels_number }} {{trans_choice('messages.nrLevels', $apartament->apartament_levels_number)}}</div>
							@endif
							<div class="col-6 col-md-4 mb-3"><img src="{{ asset("images/apartment_detal/stairs.png") }}"> {{ $apartament->apartament_floors_number }} {{trans_choice('messages.nrFloors', $apartament->apartament_floors_number)}}</div>
							@if($apartament->apartament_wifi > 0)
								<div class="col-6 col-md-4 mb-3"><img src="{{ asset("images/apartment_detal/wifi.png") }}"> Wifi</div>
							@endif
							@if($apartament->apartament_parking > 0)
								<div class="col-6 col-md-4 mb-3"><img src="{{ asset("images/apartment_detal/parking.png") }}"> Parking</div>
							@endif
							@if($apartament->apartament_elevator > 0)
								<div class="col-6 col-md-4 mb-3"><img src="{{ asset("images/apartment_detal/elevator.png") }}"> Winda</div>
							@endif
							@if($apartament->apartament_spa > 0)
								<div class="col-6 col-md-4 mb-3"><img src="{{ asset("images/apartment_detal/Bathtub_24.png") }}"> Strefa SPA</div>
							@endif
							@if($apartament->apartament_balcony > 0)
								<div class="col-6 col-md-4 mb-3"><img src="{{ asset("images/apartment_detal/balcony.png") }}"> Balkon</div>
							@endif
							@if(1 > 0)
								<div class="col-6 col-md-4 mb-3"><img src="{{ asset("images/apartment_detal/towel.png") }}"> Ręczniki</div>
							@endif
							@if(1 > 0)
								<div class="col-6 col-md-4 mb-3"><img src="{{ asset("images/apartment_detal/CleaningWipes_24.png") }}"> Pościel</div>
							@endif
							@if($apartament->apartament_fireplace > 0)
								<div class="col-6 col-md-4 mb-3"><img src="{{ asset("images/apartment_detal/Fireplace_24.png") }}"> Kominek</div>
							@endif
							@if($apartament->apartament_tv > 0)
								<div class="col-6 col-md-4 mb-3"><img src="{{ asset("images/apartment_detal/television.png") }}"> TV</div>
							@endif
							@if($apartament->apartament_iron > 0)
								<div class="col-6 col-md-4 mb-3"><img src="{{ asset("images/apartment_detal/ironing-board.png") }}"> Żelazko</div>
							@endif
						</div>
						<div class="row">
							<div class="col-12 mb-3 mt-3"><b>Kuchnia</b></div>
						</div>
						<div class="row">
							@if(1 > 0)
								<div class="col-6 col-md-4 mb-3"><img src="{{ asset("images/apartment_detal/cutlery.png") }}"> Naczynia i sztućce</div>
							@endif
							@if($apartament->apartament_fridge > 0)
								<div class="col-6 col-md-4 mb-3"><img src="{{ asset("images/apartment_detal/Fridge.png") }}"> Lodówka</div>
							@endif
							@if($apartament->apartament_cooker > 0)
								<div class="col-6 col-md-4 mb-3"><img src="{{ asset("images/apartment_detal/GasStove.png") }}"> Kuchenka</div>
							@endif
							@if($apartament->apartament_electric_kettle > 0)
								<div class="col-6 col-md-4 mb-3"><img src="{{ asset("images/apartment_detal/Kettle.png") }}"> Czajnik</div>
							@endif
							@if($apartament->apartament_microvawe_owen > 0)
								<div class="col-6 col-md-4 mb-3"><img src="{{ asset("images/apartment_detal/MicrowaveOven_24.png") }}"> Mikrofala</div>
							@endif
							@if($apartament->apartament_washing_machine > 0)
								<div class="col-6 col-md-4 mb-3"><img src="{{ asset("images/apartment_detal/Dishwasher.png") }}"> Zmywarka</div>
							@endif
							@if($apartament->apartament_toaster > 0)
								<div class="col-6 col-md-4 mb-3"><img src="{{ asset("images/apartment_detal/toaster.png") }}"> Toster</div>
							@endif
						</div>
						<div class="row">
							<div class="col-12 mb-3 mt-3"><b>Łazienka</b></div>
						</div>
						<div class="row">
							@if($apartament->apartament_shower_cabin > 0)
								<div class="col-6 col-md-4 mb-3"><img src="{{ asset("images/apartment_detal/shower.png") }}"> Kabina prysznicowa</div>
							@endif
							@if($apartament->apartament_bathtub > 0)
								<div class="col-6 col-md-4 mb-3"><img src="{{ asset("images/apartment_detal/Bath_Tub_24.png") }}"> Wanna</div>
							@endif
							@if($apartament->apartament_washer > 0)
								<div class="col-6 col-md-4 mb-3"><img src="{{ asset("images/apartment_detal/laundry.png") }}"> Pralka</div>
							@endif
							@if($apartament->apartament_hair_dryer  > 0)
								<div class="col-6 col-md-4 mb-3"><img src="{{ asset("images/apartment_detal/hairdryer.png") }}"> Suszarka do włosów</div>
							@endif
						</div>
				</div>

				<div class="row mt-2 mb-3 font-12">
					<div class="col-12">
						<h4 id="rules" class="anchor-destination"><b>{{__('Zasady')}}</b></h4>
					</div>
					<div class="col-12 mb-2">
						<div class="row mb-2">
							<div class="col-4">{{__('messages.Check-in')}}: {{$apartament->apartament_registration_time }}</div>
							<div class="col-4">{{__('messages.Check-out')}}: {{$apartament->apartament_checkout_time }}</div>
							<div class="col-4">{{__('Kaucja zwrotna')}}: 300 PLN</div>
						</div>
						<div class="row mb-2">
							<div class="col-md-4 col-sm-12 sm-facilities"><img src="{{ asset("images/apartment_detal/Dog_24.png") }}">{{__('Przyjazny zwierzętom')}}</div>
							<div class="col-md-4 col-sm-12"><img src="{{ asset("images/apartment_detal/No-Smoking_24.png") }}">{{__('Zakaz palenia')}}</div>
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
					@if($apartament->descriptions[0]->apartament_additional_information != NULL)
					<div class="col-12 mb-2">
						<div class="row">
							<div class="col-lg-2 col-sm-12">{{__('Dodatkowe informacje')}}:</div>
							<div class="col-lg-10 col-sm-12">
								{{$apartament->descriptions[0]->apartament_additional_information}}
							</div>
						</div>
					</div>
					@endif
				</div>

				<div class="row mt-3 mb-3 font-12">
					<div class="col-12 row">
						<div class="col-lg-5 col-sm-12">
                            <h4 id="availability" class="anchor-destination"><b>{{__('Dostępność')}}</b></h4>
                        </div>
                        <!--div class="col-lg-7 col-sm-12 row mt-2"-->
                        <div style="margin-left: auto" class="mt-2">
                            <span class="" style="position: relative">
								<div id="detail-legend-av" class="detail-legend"></div>
								<div class="" style="position: relative; top: -5px; display: inline-block">Dostępny</div>
							</span>
							<span class="ml-4" style="position: relative">
								<div id="detail-legend-booked" class="detail-legend"></div>
								<div class="" style="position: relative; top: -5px; display: inline-block">Zajęty</div>
							</span>
							<span class="ml-4" style="position: relative">
								<div id="detail-legend-pre-booked" class="detail-legend"></div>
								<div class="" style="position: relative; top: -5px; display: inline-block">Wstępna rezerwacja</div>
							</span>
                        </div>
					</div>
					<span id="calendar-bar" class="ml-3 pt-2" style="display: inherit;">
                        <div id="calendar-bar-prev" class="calendar-bar-arrays" style="background-image: url({{ asset("images/apartment_detal/calendar-prev.png") }}"></div>
						@foreach($calendar as $month)
                        <div class="month-box" id="{{$loop->index}}">
                            <div class="" style="text-align: center; width: 93%">
								{{-- strftime("%b", strtotime("now")) --}}
                                <b>
									<?php
										if($language->id == 1){
											switch (date('F', strtotime("+$loop->index months", strtotime(date('Y-m-01'))))){
												case "January": echo "Styczeń"; break;
												case "February": echo "Luty"; break;
												case "March": echo "Marzec"; break;
												case "April": echo "Kwiecień"; break;
												case "May": echo "Maj"; break;
												case "June": echo "Czerwiec"; break;
												case "July": echo "Lipiec"; break;
												case "August": echo "Sierpień"; break;
												case "September": echo "Wrzesień"; break;
												case "October": echo "Październik"; break;
												case "November": echo "Listopad"; break;
												case "December": echo "Grudzień"; break;
											}
										}
										else echo date('F', strtotime("+$loop->index months", strtotime(date('Y-m-01'))));
									?>
								</b>
                            </div>
                            <div class="pt-2">
                                <table class="table-condensed table-bordered calendar-month mr-3">
                                    <tr class="calendar-thead">
                                        <td>Pon</td>
                                        <td>Wto</td>
                                        <td>Śro</td>
                                        <td>Czw</td>
                                        <td>Pią</td>
                                        <td>Sob</td>
                                        <td>Nie</td>
                                    </tr>
                                    @foreach($month as $week)
                                        {!! $week !!}
                                    @endforeach
                                </table>
                            </div>
                        </div>
						@endforeach
                        <div id="calendar-bar-next" class="calendar-bar-arrays" style="background-image: url({{ asset("images/apartment_detal/calendar-next.png") }}"></div>
					</span>
				</div>

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
										<div class="col-12" style="font-size: 16px"><b>{{  $apartament->descriptions[0]->apartament_name or '' }}</b></div>
										<div class="col-12 mb-4" style="font-size: 14px">{{ $apartament->apartament_city }}, {{ $apartament->apartament_address }}</div>
										<div class="col-12 mb-2" style="font-size: 14px">GPS: {{ $apartament->apartament_gps }}</div>
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
					<div class="col-12">
						<h4 id="opinions" class="anchor-destination"><b>{{__('Ocena')}}</b></h4>
					</div>
					@if($comments != '')
						@handheld
						<div id="rating-wrapper-mobile" class="col-12 mb-2">
							<div class="tab">
								<div id="chooseJourneyType" class="center-h-v font-16" onclick="openJourneyTypes()">▼</div>
								<div class="tablinks" onclick="openJourneyType(event, 'allOpinions', 'Wszystkie opinie')" id="defaultOpen">
									<img src='{{ asset("images/apartment_detal/journeyType0.png") }}'>Wszystkie opinie (<span class="allOpinionsAmount"></span>)
								</div>
								<div class="tablinks" onclick="openJourneyType(event, 'familyOpinions', 'Rodziny')" id="familyTab">
									<img src='{{ asset("images/apartment_detal/journeyType1.png") }}'>Rodziny (<span class="familyOpinionsAmount"></span>)
								</div>
								<div class="tablinks" onclick="openJourneyType(event, 'couplesOpinions', 'Pary')" id="couplesTab">
									<img src='{{ asset("images/apartment_detal/journeyType2.png") }}'>Pary (<span class="couplesOpinionsAmount"></span>)
								</div>
								<div class="tablinks" onclick="openJourneyType(event, 'businessOpinions', 'Biznesowe')" id="businessTab">
									<img src='{{ asset("images/apartment_detal/journeyType3.png") }}'>Biznesowe (<span class="businessOpinionsAmount"></span>)
								</div>
								<div class="tablinks" onclick="openJourneyType(event, 'friendsOpinions', 'Ze znajomymi')" id="friendsTab">
									<img src='{{ asset("images/apartment_detal/journeyType4.png") }}'>Ze znajomymi (<span class="friendsOpinionsAmount"></span>)
								</div>
								<div class="tablinks" onclick="openJourneyType(event, 'aloneOpinions', 'W pojedynkę')" id="aloneTab">
									<img src='{{ asset("images/apartment_detal/journeyType5.png") }}'>W pojedynkę (<span class="aloneOpinionsAmount"></span>)
								</div>
							</div>
						</div>
						<div class="col-12" style="margin-top: -14px;">
							<div id="allOpinions" class="tabcontent-mobile p-2">
								<div class="row mx-0 mb-2">
									<img id="allTotalAvgImg" class="totalAvgImg">
									<div  id="allTotalAvgWrapper" class="rating-box-apartment center-h-v">
										<span class="font-18 bold"><span id="allTotalAvg" class="ml-2"></span>/10</span>
										<span id="allDescription" class="font-12"></span>
									</div>
								</div>
								<div class="row mx-0 font-13 mb-1" style="font-weight: bold">
									Na podstawie&nbsp;
								<span class="allOpinionsAmount"></span>
									&nbsp;opinii.
								</div>
								<div class="row mx-0 font-11">
									To jest średnia ocena gości po ich pobycie w obiekcie {{  $apartament->descriptions[0]->apartament_name or '' }}.
								</div>
								<div class="row bars">
									<div class="avgBars font-11 col-sm-6 my-3">
										<div id="allPerfect" class="row">
											<div class="side left">
												<div>Doskonały</div>
											</div>
											<div class="middle">
												<div class="bar-container">
													<div style="width: 30%; background-color: #00f324;"></div>
												</div>
											</div>
											<div class="side right">0</div>
										</div>

										<div id="allVery-good" class="row">
											<div class="side left">
												<div>Bardzo dobry</div>
											</div>
											<div class="middle">
												<div class="bar-container">
													<div style="width: 70%; background-color: #00f324;"></div>
												</div>
											</div>
											<div class="side right">0</div>
										</div>

										<div id="allAverage" class="row">
											<div class="side left">
												<div>Średni</div>
											</div>
											<div class="middle">
												<div class="bar-container">
													<div style="width: 70%; background-color: #f3ef00;"></div>
												</div>
											</div>
											<div class="side right">0</div>
										</div>

										<div id="allBad" class="row">
											<div class="side left">
												<div>Zły</div>
											</div>
											<div class="middle">
												<div class="bar-container">
													<div style="width: 70%; background-color: #f30019;"></div>
												</div>
											</div>
											<div class="side right">0</div>
										</div>

										<div id="allAwful" class="row">
											<div class="side left">
												<div>Okropny</div>
											</div>
											<div class="middle">
												<div class="bar-container">
													<div style="width: 70%; background-color: #f30019;"></div>
												</div>
											</div>
											<div class="side right">0</div>
										</div>
										<div class="row" style="display: none">
											<div class="side left" onclick="openDefault()">Pokaż wszystkie</div>
										</div>
									</div>
									<div class="detail-bars col-9 col-sm-6 pl-0 my-0 my-sm-3">
										<div class="col-12 font-11 mb-1">
											Czystość
											<span class="pull-right rating-opinion-detail"><span id="allCleanliness"></span></span>
											<span class="pull-right" style="background-color: #fff">
													<img id="allCleanlinessImg" src='{{ asset("images/opinions/dot.png") }}'>
												</span>
										</div>
										<div class="col-12 font-11 mb-1">
											Lokalizacja
											<span class="pull-right rating-opinion-detail"><span id="allLocation"></span></span>
											<span class="pull-right" style="background-color: #fff">
													<img id="allLocationImg" src='{{ asset("images/opinions/dot.png") }}'>
												</span>
										</div>
										<div class="col-12 font-11 mb-1">
											Udogodnienia
											<span class="pull-right rating-opinion-detail"><span id="allFacilities"></span></span>
											<span class="pull-right" style="background-color: #fff">
														<img id="allFacilitiesImg" src='{{ asset("images/opinions/dot.png") }}'>
													</span>
										</div>
										<div class="col-12 font-11 mb-1">
											Obsługa
											<span class="pull-right rating-opinion-detail"><span id="allStaff"></span></span>
											<span class="pull-right" style="background-color: #fff">
													<img id="allStaffImg" src='{{ asset("images/opinions/dot.png") }}'>
												</span>
										</div>
										<div class="col-12 font-11 mb-1">
											Stosunek jakości<br> do ceny
											<span style="">
													<span class="pull-right rating-opinion-detail">
														<span id="allQuality_per_price"></span>
													</span>
													<span class="pull-right" style="background-color: #fff">
														<img id="allQuality_per_priceImg" src='{{ asset("images/opinions/dot.png") }}'>
													</span>
											</span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-12" style="margin-top: -14px;">
							<div id="familyOpinions" class="tabcontent-mobile p-2">
								<div class="row mx-0 mb-2">
									<img id="familyTotalAvgImg" class="totalAvgImg">
									<div  id="familyTotalAvgWrapper" class="rating-box-apartment center-h-v">
										<span class="font-18 bold"><span id="familyTotalAvg" class="ml-2"></span>/10</span>
										<span id="familyDescription" class="font-12"></span>
									</div>
								</div>
								<div class="row mx-0 font-13 mb-1" style="font-weight: bold">
									Na podstawie&nbsp;
								<span class="familyOpinionsAmount"></span>
									&nbsp;opinii.
								</div>
								<div class="row mx-0 font-11">
									To jest średnia ocena gości po ich pobycie w obiekcie {{  $apartament->descriptions[0]->apartament_name or '' }}.
								</div>
								<div class="row bars">
									<div class="avgBars font-11 col-sm-6 my-3">
										<div id="familyPerfect" class="row">
											<div class="side left">
												<div>Doskonały</div>
											</div>
											<div class="middle">
												<div class="bar-container">
													<div style="width: 30%; background-color: #00f324;"></div>
												</div>
											</div>
											<div class="side right">0</div>
										</div>

										<div id="familyVery-good" class="row">
											<div class="side left">
												<div>Bardzo dobry</div>
											</div>
											<div class="middle">
												<div class="bar-container">
													<div style="width: 70%; background-color: #00f324;"></div>
												</div>
											</div>
											<div class="side right">0</div>
										</div>

										<div id="familyAverage" class="row">
											<div class="side left">
												<div>Średni</div>
											</div>
											<div class="middle">
												<div class="bar-container">
													<div style="width: 70%; background-color: #f3ef00;"></div>
												</div>
											</div>
											<div class="side right">0</div>
										</div>

										<div id="familyBad" class="row">
											<div class="side left">
												<div>Zły</div>
											</div>
											<div class="middle">
												<div class="bar-container">
													<div style="width: 70%; background-color: #f30019;"></div>
												</div>
											</div>
											<div class="side right">0</div>
										</div>

										<div id="familyAwful" class="row">
											<div class="side left">
												<div>Okropny</div>
											</div>
											<div class="middle">
												<div class="bar-container">
													<div style="width: 70%; background-color: #f30019;"></div>
												</div>
											</div>
											<div class="side right">0</div>
										</div>
										<div class="row" style="display: none">
											<div class="side left" onclick="openFamily()">Pokaż wszystkie</div>
										</div>
									</div>
									<div class="detail-bars col-9 col-sm-6 pl-0 my-0 my-sm-3">
										<div class="col-12 font-11 mb-1">
											Czystość
											<span class="pull-right rating-opinion-detail"><span id="familyCleanliness"></span></span>
											<span class="pull-right" style="background-color: #fff">
													<img id="familyCleanlinessImg" src='{{ asset("images/opinions/dot.png") }}'>
												</span>
										</div>
										<div class="col-12 font-11 mb-1">
											Lokalizacja
											<span class="pull-right rating-opinion-detail"><span id="familyLocation"></span></span>
											<span class="pull-right" style="background-color: #fff">
													<img id="familyLocationImg" src='{{ asset("images/opinions/dot.png") }}'>
												</span>
										</div>
										<div class="col-12 font-11 mb-1">
											Udogodnienia
											<span class="pull-right rating-opinion-detail"><span id="familyFacilities"></span></span>
											<span class="pull-right" style="background-color: #fff">
														<img id="familyFacilitiesImg" src='{{ asset("images/opinions/dot.png") }}'>
													</span>
										</div>
										<div class="col-12 font-11 mb-1">
											Obsługa
											<span class="pull-right rating-opinion-detail"><span id="familyStaff"></span></span>
											<span class="pull-right" style="background-color: #fff">
													<img id="familyStaffImg" src='{{ asset("images/opinions/dot.png") }}'>
												</span>
										</div>
										<div class="col-12 font-11 mb-1">
											Stosunek jakości<br> do ceny
											<span style="">
													<span class="pull-right rating-opinion-detail">
														<span id="familyQuality_per_price"></span>
													</span>
													<span class="pull-right" style="background-color: #fff">
														<img id="familyQuality_per_priceImg" src='{{ asset("images/opinions/dot.png") }}'>
													</span>
											</span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-12" style="margin-top: -14px;">
							<div id="couplesOpinions" class="tabcontent-mobile p-2">
								<div class="row mx-0 mb-2">
									<img id="couplesTotalAvgImg" class="totalAvgImg">
									<div  id="couplesTotalAvgWrapper" class="rating-box-apartment center-h-v">
										<span class="font-18 bold"><span id="couplesTotalAvg" class="ml-2"></span>/10</span>
										<span id="couplesDescription" class="font-12"></span>
									</div>
								</div>
								<div class="row mx-0 font-13 mb-1" style="font-weight: bold">
									Na podstawie&nbsp;
								<span class="couplesOpinionsAmount"></span>
									&nbsp;opinii.
								</div>
								<div class="row mx-0 font-11">
									To jest średnia ocena gości po ich pobycie w obiekcie {{  $apartament->descriptions[0]->apartament_name or '' }}.
								</div>
								<div class="row bars">
									<div class="avgBars font-11 col-sm-6 my-3">
										<div id="couplesPerfect" class="row">
											<div class="side left">
												<div>Doskonały</div>
											</div>
											<div class="middle">
												<div class="bar-container">
													<div style="width: 30%; background-color: #00f324;"></div>
												</div>
											</div>
											<div class="side right">0</div>
										</div>

										<div id="couplesVery-good" class="row">
											<div class="side left">
												<div>Bardzo dobry</div>
											</div>
											<div class="middle">
												<div class="bar-container">
													<div style="width: 70%; background-color: #00f324;"></div>
												</div>
											</div>
											<div class="side right">0</div>
										</div>

										<div id="couplesAverage" class="row">
											<div class="side left">
												<div>Średni</div>
											</div>
											<div class="middle">
												<div class="bar-container">
													<div style="width: 70%; background-color: #f3ef00;"></div>
												</div>
											</div>
											<div class="side right">0</div>
										</div>

										<div id="couplesBad" class="row">
											<div class="side left">
												<div>Zły</div>
											</div>
											<div class="middle">
												<div class="bar-container">
													<div style="width: 70%; background-color: #f30019;"></div>
												</div>
											</div>
											<div class="side right">0</div>
										</div>

										<div id="couplesAwful" class="row">
											<div class="side left">
												<div>Okropny</div>
											</div>
											<div class="middle">
												<div class="bar-container">
													<div style="width: 70%; background-color: #f30019;"></div>
												</div>
											</div>
											<div class="side right">0</div>
										</div>
										<div class="row" style="display: none">
											<div class="side left" onclick="openCouples()">Pokaż wszystkie</div>
										</div>
									</div>
									<div class="detail-bars col-9 col-sm-6 pl-0 my-0 my-sm-3">
										<div class="col-12 font-11 mb-1">
											Czystość
											<span class="pull-right rating-opinion-detail"><span id="couplesCleanliness"></span></span>
											<span class="pull-right" style="background-color: #fff">
													<img id="couplesCleanlinessImg" src='{{ asset("images/opinions/dot.png") }}'>
												</span>
										</div>
										<div class="col-12 font-11 mb-1">
											Lokalizacja
											<span class="pull-right rating-opinion-detail"><span id="couplesLocation"></span></span>
											<span class="pull-right" style="background-color: #fff">
													<img id="couplesLocationImg" src='{{ asset("images/opinions/dot.png") }}'>
												</span>
										</div>
										<div class="col-12 font-11 mb-1">
											Udogodnienia
											<span class="pull-right rating-opinion-detail"><span id="couplesFacilities"></span></span>
											<span class="pull-right" style="background-color: #fff">
														<img id="couplesFacilitiesImg" src='{{ asset("images/opinions/dot.png") }}'>
													</span>
										</div>
										<div class="col-12 font-11 mb-1">
											Obsługa
											<span class="pull-right rating-opinion-detail"><span id="couplesStaff"></span></span>
											<span class="pull-right" style="background-color: #fff">
													<img id="couplesStaffImg" src='{{ asset("images/opinions/dot.png") }}'>
												</span>
										</div>
										<div class="col-12 font-11 mb-1">
											Stosunek jakości<br> do ceny
											<span style="">
													<span class="pull-right rating-opinion-detail">
														<span id="couplesQuality_per_price"></span>
													</span>
													<span class="pull-right" style="background-color: #fff">
														<img id="couplesQuality_per_priceImg" src='{{ asset("images/opinions/dot.png") }}'>
													</span>
											</span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-12" style="margin-top: -14px;">
							<div id="businessOpinions" class="tabcontent-mobile p-2">
								<div class="row mx-0 mb-2">
									<img id="businessTotalAvgImg" class="totalAvgImg">
									<div  id="businessTotalAvgWrapper" class="rating-box-apartment center-h-v">
										<span class="font-18 bold"><span id="businessTotalAvg" class="ml-2"></span>/10</span>
										<span id="businessDescription" class="font-12"></span>
									</div>
								</div>
								<div class="row mx-0 font-13 mb-1" style="font-weight: bold">
									Na podstawie&nbsp;
								<span class="businessOpinionsAmount"></span>
									&nbsp;opinii.
								</div>
								<div class="row mx-0 font-11">
									To jest średnia ocena gości po ich pobycie w obiekcie {{  $apartament->descriptions[0]->apartament_name or '' }}.
								</div>
								<div class="row bars">
									<div class="avgBars font-11 col-sm-6 my-3">
										<div id="businessPerfect" class="row">
											<div class="side left">
												<div>Doskonały</div>
											</div>
											<div class="middle">
												<div class="bar-container">
													<div style="width: 30%; background-color: #00f324;"></div>
												</div>
											</div>
											<div class="side right">0</div>
										</div>

										<div id="businessVery-good" class="row">
											<div class="side left">
												<div>Bardzo dobry</div>
											</div>
											<div class="middle">
												<div class="bar-container">
													<div style="width: 70%; background-color: #00f324;"></div>
												</div>
											</div>
											<div class="side right">0</div>
										</div>

										<div id="businessAverage" class="row">
											<div class="side left">
												<div>Średni</div>
											</div>
											<div class="middle">
												<div class="bar-container">
													<div style="width: 70%; background-color: #f3ef00;"></div>
												</div>
											</div>
											<div class="side right">0</div>
										</div>

										<div id="businessBad" class="row">
											<div class="side left">
												<div>Zły</div>
											</div>
											<div class="middle">
												<div class="bar-container">
													<div style="width: 70%; background-color: #f30019;"></div>
												</div>
											</div>
											<div class="side right">0</div>
										</div>

										<div id="businessAwful" class="row">
											<div class="side left">
												<div>Okropny</div>
											</div>
											<div class="middle">
												<div class="bar-container">
													<div style="width: 70%; background-color: #f30019;"></div>
												</div>
											</div>
											<div class="side right">0</div>
										</div>
										<div class="row" style="display: none">
											<div class="side left" onclick="openBusiness()">Pokaż wszystkie</div>
										</div>
									</div>
									<div class="detail-bars col-9 col-sm-6 pl-0 my-0 my-sm-3">
										<div class="col-12 font-11 mb-1">
											Czystość
											<span class="pull-right rating-opinion-detail"><span id="businessCleanliness"></span></span>
											<span class="pull-right" style="background-color: #fff">
													<img id="businessCleanlinessImg" src='{{ asset("images/opinions/dot.png") }}'>
												</span>
										</div>
										<div class="col-12 font-11 mb-1">
											Lokalizacja
											<span class="pull-right rating-opinion-detail"><span id="businessLocation"></span></span>
											<span class="pull-right" style="background-color: #fff">
													<img id="businessLocationImg" src='{{ asset("images/opinions/dot.png") }}'>
												</span>
										</div>
										<div class="col-12 font-11 mb-1">
											Udogodnienia
											<span class="pull-right rating-opinion-detail"><span id="businessFacilities"></span></span>
											<span class="pull-right" style="background-color: #fff">
														<img id="businessFacilitiesImg" src='{{ asset("images/opinions/dot.png") }}'>
													</span>
										</div>
										<div class="col-12 font-11 mb-1">
											Obsługa
											<span class="pull-right rating-opinion-detail"><span id="businessStaff"></span></span>
											<span class="pull-right" style="background-color: #fff">
													<img id="businessStaffImg" src='{{ asset("images/opinions/dot.png") }}'>
												</span>
										</div>
										<div class="col-12 font-11 mb-1">
											Stosunek jakości<br> do ceny
											<span style="">
													<span class="pull-right rating-opinion-detail">
														<span id="businessQuality_per_price"></span>
													</span>
													<span class="pull-right" style="background-color: #fff">
														<img id="businessQuality_per_priceImg" src='{{ asset("images/opinions/dot.png") }}'>
													</span>
											</span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-12" style="margin-top: -14px;">
							<div id="friendsOpinions" class="tabcontent-mobile p-2">
								<div class="row mx-0 mb-2">
									<img id="friendsTotalAvgImg" class="totalAvgImg">
									<div  id="friendsTotalAvgWrapper" class="rating-box-apartment center-h-v">
										<span class="font-18 bold"><span id="friendsTotalAvg" class="ml-2"></span>/10</span>
										<span id="friendsDescription" class="font-12"></span>
									</div>
								</div>
								<div class="row mx-0 font-13 mb-1" style="font-weight: bold">
									Na podstawie&nbsp;
								<span class="friendsOpinionsAmount"></span>
									&nbsp;opinii.
								</div>
								<div class="row mx-0 font-11">
									To jest średnia ocena gości po ich pobycie w obiekcie {{  $apartament->descriptions[0]->apartament_name or '' }}.
								</div>
								<div class="row bars">
									<div class="avgBars font-11 col-sm-6 my-3">
										<div id="friendsPerfect" class="row">
											<div class="side left">
												<div>Doskonały</div>
											</div>
											<div class="middle">
												<div class="bar-container">
													<div style="width: 30%; background-color: #00f324;"></div>
												</div>
											</div>
											<div class="side right">0</div>
										</div>

										<div id="friendsVery-good" class="row">
											<div class="side left">
												<div>Bardzo dobry</div>
											</div>
											<div class="middle">
												<div class="bar-container">
													<div style="width: 70%; background-color: #00f324;"></div>
												</div>
											</div>
											<div class="side right">0</div>
										</div>

										<div id="friendsAverage" class="row">
											<div class="side left">
												<div>Średni</div>
											</div>
											<div class="middle">
												<div class="bar-container">
													<div style="width: 70%; background-color: #f3ef00;"></div>
												</div>
											</div>
											<div class="side right">0</div>
										</div>

										<div id="friendsBad" class="row">
											<div class="side left">
												<div>Zły</div>
											</div>
											<div class="middle">
												<div class="bar-container">
													<div style="width: 70%; background-color: #f30019;"></div>
												</div>
											</div>
											<div class="side right">0</div>
										</div>

										<div id="friendsAwful" class="row">
											<div class="side left">
												<div>Okropny</div>
											</div>
											<div class="middle">
												<div class="bar-container">
													<div style="width: 70%; background-color: #f30019;"></div>
												</div>
											</div>
											<div class="side right">0</div>
										</div>
										<div class="row" style="display: none">
											<div class="side left" onclick="openFriends()">Pokaż wszystkie</div>
										</div>
									</div>
									<div class="detail-bars col-9 col-sm-6 pl-0 my-0 my-sm-3">
										<div class="col-12 font-11 mb-1">
											Czystość
											<span class="pull-right rating-opinion-detail"><span id="friendsCleanliness"></span></span>
											<span class="pull-right" style="background-color: #fff">
													<img id="friendsCleanlinessImg" src='{{ asset("images/opinions/dot.png") }}'>
												</span>
										</div>
										<div class="col-12 font-11 mb-1">
											Lokalizacja
											<span class="pull-right rating-opinion-detail"><span id="friendsLocation"></span></span>
											<span class="pull-right" style="background-color: #fff">
													<img id="friendsLocationImg" src='{{ asset("images/opinions/dot.png") }}'>
												</span>
										</div>
										<div class="col-12 font-11 mb-1">
											Udogodnienia
											<span class="pull-right rating-opinion-detail"><span id="friendsFacilities"></span></span>
											<span class="pull-right" style="background-color: #fff">
														<img id="friendsFacilitiesImg" src='{{ asset("images/opinions/dot.png") }}'>
													</span>
										</div>
										<div class="col-12 font-11 mb-1">
											Obsługa
											<span class="pull-right rating-opinion-detail"><span id="friendsStaff"></span></span>
											<span class="pull-right" style="background-color: #fff">
													<img id="friendsStaffImg" src='{{ asset("images/opinions/dot.png") }}'>
												</span>
										</div>
										<div class="col-12 font-11 mb-1">
											Stosunek jakości<br> do ceny
											<span style="">
													<span class="pull-right rating-opinion-detail">
														<span id="friendsQuality_per_price"></span>
													</span>
													<span class="pull-right" style="background-color: #fff">
														<img id="friendsQuality_per_priceImg" src='{{ asset("images/opinions/dot.png") }}'>
													</span>
											</span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-12" style="margin-top: -14px;">
							<div id="aloneOpinions" class="tabcontent-mobile p-2">
								<div class="row mx-0 mb-2">
									<img id="aloneTotalAvgImg" class="totalAvgImg">
									<div  id="aloneTotalAvgWrapper" class="rating-box-apartment center-h-v">
										<span class="font-18 bold"><span id="aloneTotalAvg" class="ml-2"></span>/10</span>
										<span id="aloneDescription" class="font-12"></span>
									</div>
								</div>
								<div class="row mx-0 font-13 mb-1" style="font-weight: bold">
									Na podstawie&nbsp;
								<span class="aloneOpinionsAmount"></span>
									&nbsp;opinii.
								</div>
								<div class="row mx-0 font-11">
									To jest średnia ocena gości po ich pobycie w obiekcie {{  $apartament->descriptions[0]->apartament_name or '' }}.
								</div>
								<div class="row bars">
									<div class="avgBars font-11 col-sm-6 my-3">
										<div id="alonePerfect" class="row">
											<div class="side left">
												<div>Doskonały</div>
											</div>
											<div class="middle">
												<div class="bar-container">
													<div style="width: 30%; background-color: #00f324;"></div>
												</div>
											</div>
											<div class="side right">0</div>
										</div>

										<div id="aloneVery-good" class="row">
											<div class="side left">
												<div>Bardzo dobry</div>
											</div>
											<div class="middle">
												<div class="bar-container">
													<div style="width: 70%; background-color: #00f324;"></div>
												</div>
											</div>
											<div class="side right">0</div>
										</div>

										<div id="aloneAverage" class="row">
											<div class="side left">
												<div>Średni</div>
											</div>
											<div class="middle">
												<div class="bar-container">
													<div style="width: 70%; background-color: #f3ef00;"></div>
												</div>
											</div>
											<div class="side right">0</div>
										</div>

										<div id="aloneBad" class="row">
											<div class="side left">
												<div>Zły</div>
											</div>
											<div class="middle">
												<div class="bar-container">
													<div style="width: 70%; background-color: #f30019;"></div>
												</div>
											</div>
											<div class="side right">0</div>
										</div>

										<div id="aloneAwful" class="row">
											<div class="side left">
												<div>Okropny</div>
											</div>
											<div class="middle">
												<div class="bar-container">
													<div style="width: 70%; background-color: #f30019;"></div>
												</div>
											</div>
											<div class="side right">0</div>
										</div>
										<div class="row" style="display: none">
											<div class="side left" onclick="openAlone()">Pokaż wszystkie</div>
										</div>
									</div>
									<div class="detail-bars col-9 col-sm-6 pl-0 my-0 my-sm-3">
										<div class="col-12 font-11 mb-1">
											Czystość
											<span class="pull-right rating-opinion-detail"><span id="aloneCleanliness"></span></span>
											<span class="pull-right" style="background-color: #fff">
													<img id="aloneCleanlinessImg" src='{{ asset("images/opinions/dot.png") }}'>
												</span>
										</div>
										<div class="col-12 font-11 mb-1">
											Lokalizacja
											<span class="pull-right rating-opinion-detail"><span id="aloneLocation"></span></span>
											<span class="pull-right" style="background-color: #fff">
													<img id="aloneLocationImg" src='{{ asset("images/opinions/dot.png") }}'>
												</span>
										</div>
										<div class="col-12 font-11 mb-1">
											Udogodnienia
											<span class="pull-right rating-opinion-detail"><span id="aloneFacilities"></span></span>
											<span class="pull-right" style="background-color: #fff">
														<img id="aloneFacilitiesImg" src='{{ asset("images/opinions/dot.png") }}'>
													</span>
										</div>
										<div class="col-12 font-11 mb-1">
											Obsługa
											<span class="pull-right rating-opinion-detail"><span id="aloneStaff"></span></span>
											<span class="pull-right" style="background-color: #fff">
													<img id="aloneStaffImg" src='{{ asset("images/opinions/dot.png") }}'>
												</span>
										</div>
										<div class="col-12 font-11 mb-1">
											Stosunek jakości<br> do ceny
											<span style="">
													<span class="pull-right rating-opinion-detail">
														<span id="aloneQuality_per_price"></span>
													</span>
													<span class="pull-right" style="background-color: #fff">
														<img id="aloneQuality_per_priceImg" src='{{ asset("images/opinions/dot.png") }}'>
													</span>
											</span>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="row mt-3 mb-1 mx-0 font-12">
							<div class="col-12 mb-2 font-18 bold">
								<span id="opinionHeader">Wszystkie opinie</span> (<span id="allOpinionsAmount"></span>) <span id="allOpinionsAfter"></span>
							</div>
							<div class="col-12">
								<label for="sortType" style="font-size: 13px">Sortuj:</label>
								<select id="sortType">
									<option value="1">Najnowsze opinie</option>
									<option value="2">Najstarsze opinie</option>
									<option value="3">Najbardziej pomocne</option>
									<option value="4">Najwyższe oceny</option>
									<option value="5">Najniższe oceny</option>
								</select>
							</div>
						</div>
						<div class="col-12 mb-2 row user-comments"></div>
						<div id="showMoreOpinions" class="col mx-3 center-h-v font-13">Pokaż kolejne ▼</div>
						@elsehandheld
						<div id="rating-wrapper" class="col-12 mb-2">
							<div class="tab">
								<div class="tablinks" onclick="openJourneyType(event, 'allOpinions', 'Wszystkie opinie')" id="defaultOpen">
									<img src='{{ asset("images/apartment_detal/journeyType0.png") }}'>Wszystkie opinie (<span class="allOpinionsAmount"></span>)
								</div>
								<div class="tablinks" onclick="openJourneyType(event, 'familyOpinions', 'Rodziny')" id="familyTab">
									<img src='{{ asset("images/apartment_detal/journeyType1.png") }}'>Rodziny (<span class="familyOpinionsAmount"></span>)
								</div>
								<div class="tablinks" onclick="openJourneyType(event, 'couplesOpinions', 'Pary')" id="couplesTab">
									<img src='{{ asset("images/apartment_detal/journeyType2.png") }}'>Pary (<span class="couplesOpinionsAmount"></span>)
								</div>
								<div class="tablinks" onclick="openJourneyType(event, 'businessOpinions', 'Biznesowe')" id="businessTab">
									<img src='{{ asset("images/apartment_detal/journeyType3.png") }}'>Biznesowe (<span class="businessOpinionsAmount"></span>)
								</div>
								<div class="tablinks" onclick="openJourneyType(event, 'friendsOpinions', 'Ze znajomymi')" id="friendsTab">
									<img src='{{ asset("images/apartment_detal/journeyType4.png") }}'>Ze znajomymi (<span class="friendsOpinionsAmount"></span>)
								</div>
								<div class="tablinks" onclick="openJourneyType(event, 'aloneOpinions', 'W pojedynkę')" id="aloneTab">
									<img src='{{ asset("images/apartment_detal/journeyType5.png") }}'>W pojedynkę (<span class="aloneOpinionsAmount"></span>)
								</div>
							</div>

							<div id="allOpinions" class="tabcontent">
								<div class="row mt-2">
									<div class="col-3">
										<div  id="allTotalAvgWrapper" class="rating-box-apartment center-h-v">
											<span>Ocena obiektu</span>
											<span id="allTotalAvg"></span>
										</div>
									</div>
									<div class="col-9 mb-3">
										<div class="row mb-2">
											<img id="allTotalAvgImg">
										</div>
										<div class="row font-16 mb-1" style="font-weight: bold">
											Na podstawie&nbsp;
											<span class="allOpinionsAmount"></span>
											&nbsp;opinii.
										</div>
										<div class="row font-11">
											To jest średnia ocena gości po ich pobycie w obiekcie {{  $apartament->descriptions[0]->apartament_name or '' }}.
										</div>
										<div class="row font-11">
											<a href="#">Sprawdź, jak to działa.</a>
										</div>
									</div>
								</div>
								<div class="row bars">
									<div class="avgBars font-11 col-6">
										<div id="allPerfect" class="row">
											<div class="side left">
												<div>Doskonały</div>
											</div>
											<div class="middle">
												<div class="bar-container">
													<div style="width: 30%; background-color: #00f324;"></div>
												</div>
											</div>
											<div class="side right">0</div>
											<!--div class="side right-cancel" onclick="openDefault()">x</div-->
										</div>

										<div id="allVery-good" class="row">
											<div class="side left">
												<div>Bardzo dobry</div>
											</div>
											<div class="middle">
												<div class="bar-container">
													<div style="width: 70%; background-color: #00f324;"></div>
												</div>
											</div>
											<div class="side right">0</div>
										</div>

										<div id="allAverage" class="row">
											<div class="side left">
												<div>Średni</div>
											</div>
											<div class="middle">
												<div class="bar-container">
													<div style="width: 70%; background-color: #f3ef00;"></div>
												</div>
											</div>
											<div class="side right">0</div>
										</div>

										<div id="allBad" class="row">
											<div class="side left">
												<div>Zły</div>
											</div>
											<div class="middle">
												<div class="bar-container">
													<div style="width: 70%; background-color: #f30019;"></div>
												</div>
											</div>
											<div class="side right">0</div>
										</div>

										<div id="allAwful" class="row">
											<div class="side left">
												<div>Okropny</div>
											</div>
											<div class="middle">
												<div class="bar-container">
													<div style="width: 70%; background-color: #f30019;"></div>
												</div>
											</div>
											<div class="side right">0</div>
										</div>
										<div class="row" style="display: none">
											<div class="side left" onclick="openDefault()">Pokaż wszystkie</div>
										</div>
									</div>
									<div class="col-6 detail-bars">
										<div class="col-12 font-11 mb-1">
											Czystość
											<span class="pull-right rating-opinion-detail"><span id="allCleanliness"></span></span>
											<span class="pull-right" style="background-color: #fff">
												<img id="allCleanlinessImg" src='{{ asset("images/opinions/dot.png") }}'>
											</span>
										</div>
										<div class="col-12 font-11 mb-1">
											Lokalizacja
											<span class="pull-right rating-opinion-detail"><span id="allLocation"></span></span>
											<span class="pull-right" style="background-color: #fff">
												<img id="allLocationImg" src='{{ asset("images/opinions/dot.png") }}'>
											</span>
										</div>
										<div class="col-12 font-11 mb-1">
											Udogodnienia
											<span class="pull-right rating-opinion-detail"><span id="allFacilities"></span></span>
											<span class="pull-right" style="background-color: #fff">
													<img id="allFacilitiesImg" src='{{ asset("images/opinions/dot.png") }}'>
												</span>
										</div>
										<div class="col-12 font-11 mb-1">
											Obsługa
											<span class="pull-right rating-opinion-detail"><span id="allStaff"></span></span>
											<span class="pull-right" style="background-color: #fff">
												<img id="allStaffImg" src='{{ asset("images/opinions/dot.png") }}'>
											</span>
										</div>
										<div class="col-12 font-11 mb-1">
											Stosunek jakości<br> do ceny
											<span style="position: absolute;right: 0px;top: 0px;">
												<span class="pull-right rating-opinion-detail">
													<span id="allQuality_per_price"></span>
												</span>
												<span class="pull-right" style="background-color: #fff">
													<img id="allQuality_per_priceImg" src='{{ asset("images/opinions/dot.png") }}'>
												</span>
											</span>
										</div>
									</div>
								</div>
							</div>

							<div id="familyOpinions" class="tabcontent">
								<div class="row mt-2">
									<div class="col-3">
										<div  id="familyTotalAvgWrapper" class="rating-box-apartment center-h-v">
											<span>Ocena obiektu</span>
											<span id="familyTotalAvg"></span>
										</div>
									</div>
									<div class="col-9 mb-3">
										<div class="row mb-2">
											<img id="familyTotalAvgImg">
										</div>
										<div class="row font-16 mb-1" style="font-weight: bold">
											Na podstawie&nbsp;
											<span class="familyOpinionsAmount"></span>
											&nbsp;opinii.
										</div>
										<div class="row font-11">
											To jest średnia ocena gości po ich pobycie w obiekcie {{  $apartament->descriptions[0]->apartament_name or '' }}.
										</div>
										<div class="row font-11">
											<a href="#">Sprawdź, jak to działa.</a>
										</div>
									</div>
								</div>
								<div class="row bars">
									<div class="avgBars font-11 col-6">
										<div id="familyPerfect" class="row">
											<div class="side left">
												<div>Doskonały</div>
											</div>
											<div class="middle">
												<div class="bar-container">
													<div style="width: 30%; background-color: #00f324;"></div>
												</div>
											</div>
											<div class="side right">0</div>
										</div>

										<div id="familyVery-good" class="row">
											<div class="side left">
												<div>Bardzo dobry</div>
											</div>
											<div class="middle">
												<div class="bar-container">
													<div style="width: 70%; background-color: #00f324;"></div>
												</div>
											</div>
											<div class="side right">0</div>
										</div>

										<div id="familyAverage" class="row">
											<div class="side left">
												<div>Średni</div>
											</div>
											<div class="middle">
												<div class="bar-container">
													<div style="width: 70%; background-color: #f3ef00;"></div>
												</div>
											</div>
											<div class="side right">
												<div>9</div>
											</div>
										</div>

										<div id="familyBad" class="row">
											<div class="side left">
												<div>Zły</div>
											</div>
											<div class="middle">
												<div class="bar-container">
													<div style="width: 70%; background-color: #f30019;"></div>
												</div>
											</div>
											<div class="side right">0</div>
										</div>

										<div id="familyAwful" class="row">
											<div class="side left">
												<div>Okropny</div>
											</div>
											<div class="middle">
												<div class="bar-container">
													<div style="width: 70%; background-color: #f30019;"></div>
												</div>
											</div>
											<div class="side right">0</div>
										</div>
										<div class="row" style="display: none">
											<div class="side left" onclick="openFamily()">Pokaż wszystkie</div>
										</div>
									</div>
									<div class="col-6 detail-bars">
										<div class="col-12 font-11 mb-1">
											Czystość
											<span class="pull-right rating-opinion-detail"><span id="familyCleanliness"></span></span>
											<span class="pull-right" style="background-color: #fff">
												<img id="familyCleanlinessImg" src='{{ asset("images/opinions/dot.png") }}'>
											</span>
										</div>
										<div class="col-12 font-11 mb-1">
											Lokalizacja
											<span class="pull-right rating-opinion-detail"><span id="familyLocation"></span></span>
											<span class="pull-right" style="background-color: #fff">
												<img id="familyLocationImg" src='{{ asset("images/opinions/dot.png") }}'>
											</span>
										</div>
										<div class="col-12 font-11 mb-1">
											Udogodnienia
											<span class="pull-right rating-opinion-detail"><span id="familyFacilities"></span></span>
											<span class="pull-right" style="background-color: #fff">
													<img id="familyFacilitiesImg" src='{{ asset("images/opinions/dot.png") }}'>
												</span>
										</div>
										<div class="col-12 font-11 mb-1">
											Obsługa
											<span class="pull-right rating-opinion-detail"><span id="familyStaff"></span></span>
											<span class="pull-right" style="background-color: #fff">
												<img id="familyStaffImg" src='{{ asset("images/opinions/dot.png") }}'>
											</span>
										</div>
										<div class="col-12 font-11 mb-1">
											Stosunek jakości<br> do ceny
											<span style="position: absolute;right: 0px;top: 0px;">
												<span class="pull-right rating-opinion-detail">
													<span id="familyQuality_per_price"></span>
												</span>
												<span class="pull-right" style="background-color: #fff">
													<img id="familyQuality_per_priceImg" src='{{ asset("images/opinions/dot.png") }}'>
												</span>
											</span>
										</div>
									</div>
								</div>
							</div>

							<div id="couplesOpinions" class="tabcontent">
								<div class="row mt-2">
									<div class="col-3">
										<div  id="couplesTotalAvgWrapper" class="rating-box-apartment center-h-v">
											<span>Ocena obiektu</span>
											<span id="couplesTotalAvg"></span>
										</div>
									</div>
									<div class="col-9 mb-3">
										<div class="row mb-2">
											<img id="couplesTotalAvgImg">
										</div>
										<div class="row font-16 mb-1" style="font-weight: bold">
											Na podstawie&nbsp;
											<span class="couplesOpinionsAmount"></span>
											&nbsp;opinii.
										</div>
										<div class="row font-11">
											To jest średnia ocena gości po ich pobycie w obiekcie {{  $apartament->descriptions[0]->apartament_name or '' }}.
										</div>
										<div class="row font-11">
											<a href="#">Sprawdź, jak to działa.</a>
										</div>
									</div>
								</div>
								<div class="row bars">
									<div class="avgBars font-11 col-6">
										<div id="couplesPerfect" class="row">
											<div class="side left">
												<div>Doskonały</div>
											</div>
											<div class="middle">
												<div class="bar-container">
													<div style="width: 30%; background-color: #00f324;"></div>
												</div>
											</div>
											<div class="side right">0</div>
										</div>

										<div id="couplesVery-good" class="row">
											<div class="side left">
												<div>Bardzo dobry</div>
											</div>
											<div class="middle">
												<div class="bar-container">
													<div style="width: 70%; background-color: #00f324;"></div>
												</div>
											</div>
											<div class="side right">0</div>
										</div>

										<div id="couplesAverage" class="row">
											<div class="side left">
												<div>Średni</div>
											</div>
											<div class="middle">
												<div class="bar-container">
													<div style="width: 70%; background-color: #f3ef00;"></div>
												</div>
											</div>
											<div class="side right">0</div>
										</div>

										<div id="couplesBad" class="row">
											<div class="side left">
												<div>Zły</div>
											</div>
											<div class="middle">
												<div class="bar-container">
													<div style="width: 70%; background-color: #f30019;"></div>
												</div>
											</div>
											<div class="side right">0</div>
										</div>

										<div id="couplesAwful" class="row">
											<div class="side left">
												<div>Okropny</div>
											</div>
											<div class="middle">
												<div class="bar-container">
													<div style="width: 70%; background-color: #f30019;"></div>
												</div>
											</div>
											<div class="side right">
												<div>9</div>
											</div>
										</div>
										<div class="row" style="display: none">
											<div class="side left" onclick="openCouples()">Pokaż wszystkie</div>
										</div>
									</div>
									<div class="col-6 detail-bars">
										<div class="col-12 font-11 mb-1">
											Czystość
											<span class="pull-right rating-opinion-detail"><span id="couplesCleanliness"></span></span>
											<span class="pull-right" style="background-color: #fff">
												<img id="couplesCleanlinessImg" src='{{ asset("images/opinions/dot.png") }}'>
											</span>
										</div>
										<div class="col-12 font-11 mb-1">
											Lokalizacja
											<span class="pull-right rating-opinion-detail"><span id="couplesLocation"></span></span>
											<span class="pull-right" style="background-color: #fff">
												<img id="couplesLocationImg" src='{{ asset("images/opinions/dot.png") }}'>
											</span>
										</div>
										<div class="col-12 font-11 mb-1">
											Udogodnienia
											<span class="pull-right rating-opinion-detail"><span id="couplesFacilities"></span></span>
											<span class="pull-right" style="background-color: #fff">
													<img id="couplesFacilitiesImg" src='{{ asset("images/opinions/dot.png") }}'>
												</span>
										</div>
										<div class="col-12 font-11 mb-1">
											Obsługa
											<span class="pull-right rating-opinion-detail"><span id="couplesStaff"></span></span>
											<span class="pull-right" style="background-color: #fff">
												<img id="couplesStaffImg" src='{{ asset("images/opinions/dot.png") }}'>
											</span>
										</div>
										<div class="col-12 font-11 mb-1">
											Stosunek jakości<br> do ceny
											<span style="position: absolute;right: 0px;top: 0px;">
												<span class="pull-right rating-opinion-detail">
													<span id="couplesQuality_per_price"></span>
												</span>
												<span class="pull-right" style="background-color: #fff">
													<img id="couplesQuality_per_priceImg" src='{{ asset("images/opinions/dot.png") }}'>
												</span>
											</span>

										</div>
									</div>
								</div>
							</div>

							<div id="businessOpinions" class="tabcontent">
								<div class="row mt-2">
									<div class="col-3">
										<div  id="businessTotalAvgWrapper" class="rating-box-apartment center-h-v">
											<span>Ocena obiektu</span>
											<span id="businessTotalAvg"></span>
										</div>
									</div>
									<div class="col-9 mb-3">
										<div class="row mb-2">
											<img id="businessTotalAvgImg">
										</div>
										<div class="row font-16 mb-1" style="font-weight: bold">
											Na podstawie&nbsp;
											<span class="businessOpinionsAmount"></span>
											&nbsp;opinii.
										</div>
										<div class="row font-11">
											To jest średnia ocena gości po ich pobycie w obiekcie {{  $apartament->descriptions[0]->apartament_name or '' }}.
										</div>
										<div class="row font-11">
											<a href="#">Sprawdź, jak to działa.</a>
										</div>
									</div>
								</div>
								<div class="row bars">
									<div class="avgBars font-11 col-6">
										<div id="businessPerfect" class="row">
											<div class="side left">
												<div>Doskonały</div>
											</div>
											<div class="middle">
												<div class="bar-container">
													<div style="width: 30%; background-color: #00f324;"></div>
												</div>
											</div>
											<div class="side right">0</div>
										</div>

										<div id="businessVery-good" class="row">
											<div class="side left">
												<div>Bardzo dobry</div>
											</div>
											<div class="middle">
												<div class="bar-container">
													<div style="width: 70%; background-color: #00f324;"></div>
												</div>
											</div>
											<div class="side right">0</div>
										</div>

										<div id="businessAverage" class="row">
											<div class="side left">
												<div>Średni</div>
											</div>
											<div class="middle">
												<div class="bar-container">
													<div style="width: 70%; background-color: #f3ef00;"></div>
												</div>
											</div>
											<div class="side right">0</div>
										</div>

										<div id="businessBad" class="row">
											<div class="side left">
												<div>Zły</div>
											</div>
											<div class="middle">
												<div class="bar-container">
													<div style="width: 70%; background-color: #f30019;"></div>
												</div>
											</div>
											<div class="side right">0</div>
										</div>

										<div id="businessAwful" class="row">
											<div class="side left">
												<div>Okropny</div>
											</div>
											<div class="middle">
												<div class="bar-container">
													<div style="width: 70%; background-color: #f30019;"></div>
												</div>
											</div>
											<div class="side right">
												<div>9</div>
											</div>
										</div>
										<div class="row" style="display: none">
											<div class="side left" onclick="openBusiness()">Pokaż wszystkie</div>
										</div>
									</div>
									<div class="col-6 detail-bars">
										<div class="col-12 font-11 mb-1">
											Czystość
											<span class="pull-right rating-opinion-detail"><span id="businessCleanliness"></span></span>
											<span class="pull-right" style="background-color: #fff">
												<img id="businessCleanlinessImg" src='{{ asset("images/opinions/dot.png") }}'>
											</span>
										</div>
										<div class="col-12 font-11 mb-1">
											Lokalizacja
											<span class="pull-right rating-opinion-detail"><span id="businessLocation"></span></span>
											<span class="pull-right" style="background-color: #fff">
												<img id="businessLocationImg" src='{{ asset("images/opinions/dot.png") }}'>
											</span>
										</div>
										<div class="col-12 font-11 mb-1">
											Udogodnienia
											<span class="pull-right rating-opinion-detail"><span id="businessFacilities"></span></span>
											<span class="pull-right" style="background-color: #fff">
													<img id="businessFacilitiesImg" src='{{ asset("images/opinions/dot.png") }}'>
												</span>
										</div>
										<div class="col-12 font-11 mb-1">
											Obsługa
											<span class="pull-right rating-opinion-detail"><span id="businessStaff"></span></span>
											<span class="pull-right" style="background-color: #fff">
												<img id="businessStaffImg" src='{{ asset("images/opinions/dot.png") }}'>
											</span>
										</div>
										<div class="col-12 font-11 mb-1">
											Stosunek jakości<br> do ceny
											<span style="position: absolute;right: 0px;top: 0px;">
												<span class="pull-right rating-opinion-detail">
													<span id="businessQuality_per_price"></span>
												</span>
												<span class="pull-right" style="background-color: #fff">
													<img id="businessQuality_per_priceImg" src='{{ asset("images/opinions/dot.png") }}'>
												</span>
											</span>

										</div>
									</div>
								</div>
							</div>

							<div id="friendsOpinions" class="tabcontent">
								<div class="row mt-2">
									<div class="col-3">
										<div  id="friendsTotalAvgWrapper" class="rating-box-apartment center-h-v">
											<span>Ocena obiektu</span>
											<span id="friendsTotalAvg"></span>
										</div>
									</div>
									<div class="col-9 mb-3">
										<div class="row mb-2">
											<img id="friendsTotalAvgImg">
										</div>
										<div class="row font-16 mb-1" style="font-weight: bold">
											Na podstawie&nbsp;
											<span class="friendsOpinionsAmount"></span>
											&nbsp;opinii.
										</div>
										<div class="row font-11">
											To jest średnia ocena gości po ich pobycie w obiekcie {{  $apartament->descriptions[0]->apartament_name or '' }}.
										</div>
										<div class="row font-11">
											<a href="#">Sprawdź, jak to działa.</a>
										</div>
									</div>
								</div>
								<div class="row bars">
									<div class="avgBars font-11 col-6">
										<div id="friendsPerfect" class="row">
											<div class="side left">
												<div>Doskonały</div>
											</div>
											<div class="middle">
												<div class="bar-container">
													<div style="width: 30%; background-color: #00f324;"></div>
												</div>
											</div>
											<div class="side right">0</div>
										</div>

										<div id="friendsVery-good" class="row">
											<div class="side left">
												<div>Bardzo dobry</div>
											</div>
											<div class="middle">
												<div class="bar-container">
													<div style="width: 70%; background-color: #00f324;"></div>
												</div>
											</div>
											<div class="side right">0</div>
										</div>

										<div id="friendsAverage" class="row">
											<div class="side left">
												<div>Średni</div>
											</div>
											<div class="middle">
												<div class="bar-container">
													<div style="width: 70%; background-color: #f3ef00;"></div>
												</div>
											</div>
											<div class="side right">0</div>
										</div>

										<div id="friendsBad" class="row">
											<div class="side left">
												<div>Zły</div>
											</div>
											<div class="middle">
												<div class="bar-container">
													<div style="width: 70%; background-color: #f30019;"></div>
												</div>
											</div>
											<div class="side right">0</div>
										</div>

										<div id="friendsAwful" class="row">
											<div class="side left">
												<div>Okropny</div>
											</div>
											<div class="middle">
												<div class="bar-container">
													<div style="width: 70%; background-color: #f30019;"></div>
												</div>
											</div>
											<div class="side right">0</div>
										</div>
										<div class="row" style="display: none">
											<div class="side left" onclick="openFriends()">Pokaż wszystkie</div>
										</div>
									</div>
									<div class="col-6 detail-bars">
										<div class="col-12 font-11 mb-1">
											Czystość
											<span class="pull-right rating-opinion-detail"><span id="friendsCleanliness"></span></span>
											<span class="pull-right" style="background-color: #fff">
												<img id="friendsCleanlinessImg" src='{{ asset("images/opinions/dot.png") }}'>
											</span>
										</div>
										<div class="col-12 font-11 mb-1">
											Lokalizacja
											<span class="pull-right rating-opinion-detail"><span id="friendsLocation"></span></span>
											<span class="pull-right" style="background-color: #fff">
												<img id="friendsLocationImg" src='{{ asset("images/opinions/dot.png") }}'>
											</span>
										</div>
										<div class="col-12 font-11 mb-1">
											Udogodnienia
											<span class="pull-right rating-opinion-detail"><span id="friendsFacilities"></span></span>
											<span class="pull-right" style="background-color: #fff">
													<img id="friendsFacilitiesImg" src='{{ asset("images/opinions/dot.png") }}'>
												</span>
										</div>
										<div class="col-12 font-11 mb-1">
											Obsługa
											<span class="pull-right rating-opinion-detail"><span id="friendsStaff"></span></span>
											<span class="pull-right" style="background-color: #fff">
												<img id="friendsStaffImg" src='{{ asset("images/opinions/dot.png") }}'>
											</span>
										</div>
										<div class="col-12 font-11 mb-1">
											Stosunek jakości<br> do ceny
											<span style="position: absolute;right: 0px;top: 0px;">
												<span class="pull-right rating-opinion-detail">
													<span id="friendsQuality_per_price"></span>
												</span>
												<span class="pull-right" style="background-color: #fff">
													<img id="friendsQuality_per_priceImg" src='{{ asset("images/opinions/dot.png") }}'>
												</span>
											</span>

										</div>
									</div>
								</div>
							</div>

							<div id="aloneOpinions" class="tabcontent">
								<div class="row mt-2">
									<div class="col-3">
										<div  id="aloneTotalAvgWrapper" class="rating-box-apartment center-h-v">
											<span>Ocena obiektu</span>
											<span id="aloneTotalAvg"></span>
										</div>
									</div>
									<div class="col-9 mb-3">
										<div class="row mb-2">
											<img id="aloneTotalAvgImg">
										</div>
										<div class="row font-16 mb-1" style="font-weight: bold">
											Na podstawie&nbsp;
											<span class="aloneOpinionsAmount"></span>
											&nbsp;opinii.
										</div>
										<div class="row font-11">
											To jest średnia ocena gości po ich pobycie w obiekcie {{  $apartament->descriptions[0]->apartament_name or '' }}.
										</div>
										<div class="row font-11">
											<a href="#">Sprawdź, jak to działa.</a>
										</div>
									</div>
								</div>
								<div class="row bars">
									<div class="avgBars font-11 col-6">
										<div id="alonePerfect" class="row">
											<div class="side left">
												<div>Doskonały</div>
											</div>
											<div class="middle">
												<div class="bar-container">
													<div style="width: 30%; background-color: #00f324;"></div>
												</div>
											</div>
											<div class="side right">0</div>
										</div>

										<div id="aloneVery-good" class="row">
											<div class="side left">
												<div>Bardzo dobry</div>
											</div>
											<div class="middle">
												<div class="bar-container">
													<div style="width: 70%; background-color: #00f324;"></div>
												</div>
											</div>
											<div class="side right">0</div>
										</div>

										<div id="aloneAverage" class="row">
											<div class="side left">
												<div>Średni</div>
											</div>
											<div class="middle">
												<div class="bar-container">
													<div style="width: 70%; background-color: #f3ef00;"></div>
												</div>
											</div>
											<div class="side right">0</div>
										</div>

										<div id="aloneBad" class="row">
											<div class="side left">
												<div>Zły</div>
											</div>
											<div class="middle">
												<div class="bar-container">
													<div style="width: 70%; background-color: #f30019;"></div>
												</div>
											</div>
											<div class="side right">0</div>
										</div>

										<div id="aloneAwful" class="row">
											<div class="side left">
												<div>Okropny</div>
											</div>
											<div class="middle">
												<div class="bar-container">
													<div style="width: 70%; background-color: #f30019;"></div>
												</div>
											</div>
											<div class="side right">0</div>
										</div>
										<div class="row" style="display: none">
											<div class="side left" onclick="openAlone()">Pokaż wszystkie</div>
										</div>
									</div>
									<div class="col-6 detail-bars">
										<div class="col-12 font-11 mb-1">
											Czystość
											<span class="pull-right rating-opinion-detail"><span id="aloneCleanliness"></span></span>
											<span class="pull-right" style="background-color: #fff">
												<img id="aloneCleanlinessImg" src='{{ asset("images/opinions/dot.png") }}'>
											</span>
										</div>
										<div class="col-12 font-11 mb-1">
											Lokalizacja
											<span class="pull-right rating-opinion-detail"><span id="aloneLocation"></span></span>
											<span class="pull-right" style="background-color: #fff">
												<img id="aloneLocationImg" src='{{ asset("images/opinions/dot.png") }}'>
											</span>
										</div>
										<div class="col-12 font-11 mb-1">
											Udogodnienia
											<span class="pull-right rating-opinion-detail"><span id="aloneFacilities"></span></span>
											<span class="pull-right" style="background-color: #fff">
													<img id="aloneFacilitiesImg" src='{{ asset("images/opinions/dot.png") }}'>
												</span>
										</div>
										<div class="col-12 font-11 mb-1">
											Obsługa
											<span class="pull-right rating-opinion-detail"><span id="aloneStaff"></span></span>
											<span class="pull-right" style="background-color: #fff">
												<img id="aloneStaffImg" src='{{ asset("images/opinions/dot.png") }}'>
											</span>
										</div>
										<div class="col-12 font-11 mb-1">
											Stosunek jakości<br> do ceny
											<span style="position: absolute;right: 0px;top: 0px;">
												<span class="pull-right rating-opinion-detail">
													<span id="aloneQuality_per_price"></span>
												</span>
												<span class="pull-right" style="background-color: #fff">
													<img id="aloneQuality_per_priceImg" src='{{ asset("images/opinions/dot.png") }}'>
												</span>
											</span>

										</div>
									</div>
								</div>
							</div>
						</div>
				</div>
				<div class="row mt-3 mb-3 font-12">
					<div class="col-12">
                        <div style="font-size: 1.5rem;">
							<b><span id="opinionHeader">Wszystkie opinie</span> (<span id="allOpinionsAmount"></span>) <span id="allOpinionsAfter"></span></b>
							<span class="pull-right">
								<label for="sortType" style="font-size: 13px">Sortuj:</label>
								<select id="sortType">
									<option value="1">Najnowsze opinie</option>
									<option value="2">Najstarsze opinie</option>
									<option value="3">Najbardziej pomocne</option>
									<option value="4">Najwyższe oceny</option>
									<option value="5">Najniższe oceny</option>
								</select>
							</span>
						</div>
					</div>
					<div class="col-12 mb-2 row user-comments"></div>
					<div id="showMoreOpinions" class="col mx-3 center-h-v font-13">Pokaż kolejne ▼</div>
					@endhandheld
					@else
						<div class="col-12 mb-2">Apartament nie otrzymał jeszcze żadnych opinii</div>
					@endif
				</div>
			</div>
			<span id="similarApartments" class="mx-3 w-100">
				<h2 class="pb-2 bold" style="margin-top: 40px; font-size: 26px">{{__('Osoby, które oglądały ten obiekt oglądały również')}}</h2>
				@include('includes.see-also-apartment')
			</span>
			<span class="mobile-none mx-3 w-100">
				@if($countedCookies > 0)
					<h2 class="pb-2 bold" style="margin-top: 40px; font-size: 26px">{{__('messages.lastSeen')}}</h2>
					@include('includes.last-seen-apartment-detail')
				@endif
			</span>
		</div>
	</div>
	<div id="send-news">
		<span style="font-size: 24px; font-weight: bold">Wyślij znajomemu</span><br>
		<div class="row">
			<div class="col-2"><span class="font-14">Link:</span></div>
			<div class="col-10">
				<ul class="font-13">
					<li>
						<span id="link">{{Request::url()}}</span>
						<span class="txt-blue copy-to-clipboard" onclick="copyToClipboard('#link')">Skopiuj</span>
					</li>
				</ul>
			</div>
		</div>

		<label for="emails2">Adresy e-mail:</label>
		<input id="emails2" name="emails2" type="text" placeholder="Wpisz adresy e-mail (rozdziel je przecinkami)">
		<input id="links" name="links" type="hidden" value="{{Request::url()}}">
		<hr>
		<div style="text-align: center;">
			<button id="send-mail-with-news" class="btn btn-primary">Wyślij</button>
			<button class="btn btn-default close-send-news-friends">Anuluj</button>
		</div>
		<div id="close-send-news" class="close-send-news-friends">x</div>
	</div>

	<div id="confirm-send-news-friends" class="text-center">
		<br><span style="font-size: 24px; font-weight: bold">Wiadomość e-mail została wysłana</span><br><br><br>
		<button class="btn btn-default close-confirm-news">OK</button>
	</div>
	<script type="text/javascript">
		moment.locale('pl');
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
                dateInc = '{{$_GET['t-start']}}';
            	dateOut = '{{$_GET['t-end']}}';
                ajaxConenction();
			@endif
        });

        var firstArrival = '2018-01-01';
        var firstDeparture = '2018-01-01';

        function ajaxConenction(){
            var id = {{ $apartament->id }};

            $.ajax({
                type: "GET",
                url: '/test',
                dataType : 'json',
                data: {
                    przyjazd: dateInc,
                    powrot: dateOut,
                    id: id,
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
                        $('#is-Av-panel').hide();
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
	</script>
	@if(\App::environment('production'))
	<script src="https://maps.google.com/maps/api/js?key=AIzaSyBBEtTo5au09GsH6EvJhj1R_uc0BpTLVaw&language=PL" type="text/javascript"></script>
	@else
	<script src="http://maps.google.com/maps/api/js?key=AIzaSyBBEtTo5au09GsH6EvJhj1R_uc0BpTLVaw&language=PL" type="text/javascript"></script>
	@endif
	<script type="text/javascript">

        var mapa;
        var dymek = new google.maps.InfoWindow();
        var greenMarkers = [];
        var trasa  		 = new google.maps.DirectionsService();
        var trasa_render = new google.maps.DirectionsRenderer();
        var wspolrzedne = new google.maps.LatLng({{ $apartament->apartament_geo_lat }}, {{ $apartament->apartament_geo_lan }});

        function mapaStart()
        {
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
            $("#drukujWskazowki").hide();
            $("#wskazowkiContent").val("");
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

        function setStreetView(){

            var mapS = new google.maps.Map(document.getElementById('streetView'), {
                center: wspolrzedne,
                zoom: 14
            });

            var panorama = new google.maps.StreetViewPanorama(
                document.getElementById('streetView'), {
                    position: wspolrzedne,
                    pov: {
                        heading: 34,
                        pitch: 0
                    },
                    addressControl: false,
                });
            mapS.setStreetView(panorama);
		}

        $(document).ready(function(){
            mapaStart();
            setStreetView();
        });
	</script>

    @mobile

    <script type="text/javascript">
        var middle = 0;

        function calendarMonthShow(){
            $('.month-box').css({display: 'none'});
            document.getElementById(middle).style.display = 'inline-block';

            if(middle == 0){
                $("#calendar-bar-prev").css({display: 'none'});
                $("#calendar-bar").css({'padding-left': '0px'});
            }
            else{
                $("#calendar-bar-prev").css({display: 'inline-block'});
                $("#calendar-bar").css({'padding-left': '40px'});
            }

            if(middle == 11){
                $("#calendar-bar-next").css({display: 'none'});
                $("#calendar-bar").css({'padding-right': '0px'});
            }
            else{
                $("#calendar-bar-next").css({display: 'inline-block'});
                $("#calendar-bar").css({'padding-right': '40px'});
            }
        };

        $(function(){
            calendarMonthShow();
        });

        $('#calendar-bar-next').click(function() {
            if(middle < 11) middle++;
            calendarMonthShow();
        });

        $("#calendar-bar-prev").on('click', function(){
            if(middle > 0) middle--;
            calendarMonthShow();
        });
    </script>

	@else
	<script type="text/javascript">
        var middle = 1;

        function calendarMonthShow(){
            $('.month-box').css({display: 'none'});
            document.getElementById(middle-1).style.display = 'inline-block';
            document.getElementById(middle).style.display = 'inline-block';
            document.getElementById(middle+1).style.display = 'inline-block';

            if(middle == 1){
                $("#calendar-bar-prev").css({display: 'none'});
                $("#calendar-bar").css({'padding-left': '0px'});
			}
			else{
                $("#calendar-bar-prev").css({display: 'inline-block'});
                $("#calendar-bar").css({'padding-left': '40px'});
			}

			if(middle == 10){
                $("#calendar-bar-next").css({display: 'none'});
                $("#calendar-bar").css({'padding-right': '0px'});
			}
			else{
                $("#calendar-bar-next").css({display: 'inline-block'});
                $("#calendar-bar").css({'padding-right': '40px'});
			}
        };

        $(function(){
            calendarMonthShow();
        });

        $('#calendar-bar-next').click(function() {
            if(middle < 10) middle++;
            calendarMonthShow();
        });

        $("#calendar-bar-prev").on('click', function(){
            if(middle > 1) middle--;
            calendarMonthShow();
        });
        </script>

	@endmobile

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
            similarApartmentsTop = $('#similarApartments').offset().top;

            $(window).scroll(function(){
                var reservationPanelHeight = $('#stickyReservationPanel').outerHeight();
                var sumHeight = similarApartmentsTop - reservationPanelHeight;

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
        $(function(){
            // Check the initial Poistion of the Sticky Header
            var stickyAnchorTop = $('#stickyAnchor').offset().top;
            var stickyAnchorRight = $('#stickyAnchor').offset().left;

            $(window).scroll(function(){
                if( $(window).scrollTop() > stickyAnchorTop ) {
                    $('#stickyAnchor-wrapper').css({position: 'fixed', top: '0px', left: stickyAnchorRight, 'margin-right': '0px', visibility: 'visible', 'margin-top': '0px'});
                    $('#stickyAnchor').css({'margin-right': '0px'});
                } else {
                    $('#stickyAnchor-wrapper').css({position: 'static', top: '0px', left: stickyAnchorRight, visibility: 'hidden', 'margin-top': '-40px'});
                    $('#stickyAnchor').css({'margin-right': ''});
                }
            });
        });

        function addToFavourites(apartamentId, userId){

            if(userId == 0) alert("Aby dodać apartament do ulubionych musisz się zalogować");

            else{
                $.ajax({
                    type: "GET",
                    url: '/addToFavourites/'+apartamentId+'/'+userId,
                    dataType : 'json',
                    data: {
                        apartamentId: apartamentId,
                        userId: userId,
                    },
                    success: function(responseMessage) {

                        $("#deleteApartamentFromFavourites").show();
                        $("#addApartamentToFavourites").hide();

                        if(responseMessage[0] == 1) {
                            var htmlForeach = '';
                            var htmlForeach2 = '';
                            var foreachLinks = '';

                            for (var i = 0; i < responseMessage[2].length; i++) {
                                htmlForeach += '<div class="row"> <div class="col-3" style="background-image: url(\'{{ url('/') }}/images/apartaments/' + responseMessage[2][i].id + '/main.jpg\'); background-size: cover; position: relative; margin-bottom: 0px; margin-left: 15px; padding-left: 0px; max-height: 52px;"></div> <div class="col-8 row" style="margin-right: -20px"> <div class="col-12 font-13 txt-blue"><a href="/apartaments/' + responseMessage[2][i].apartament_link + '">' + responseMessage[2][i].apartament_name + '</a></div> <div class="col-12 font-11 bold">' + responseMessage[2][i].apartament_address + '</div> <div class="col-12 font-11">' + responseMessage[2][i].apartament_address_2 + '</div> </div> <div class=""><img src="{{ asset("images/favourites/heart.png") }}"></div> </div> <hr>';
                            }

                            html = $('<span id="favourites-nav" onclick="$(\'#favourites-bar\').toggle();" class="nav-link">{{ __('messages.My favourites') }} (' + responseMessage[1] + ')</span> <div id="favourites-bar" style="border-bottom: 1px solid black; background-image: url({{ asset('images/account/favouritesPopup.png') }}); background-repeat: no-repeat; background-position: left top; display: none; position: absolute; left: 8px; width: 320px; z-index: 2000;"> <div class="p-3 pt-4"> <span class="bold" style="font-size: 24px">Ulubione (' + responseMessage[1] + ')</span> <a class="font-11" onclick="clearFavouritesPopup()" href="#">Wyczyść listę</a> ' + htmlForeach + '<a class="btn btn-black px-2" href="{{route('myFavourites')}}">Wszystkie (' + responseMessage[1] + ')</a> <a class="btn btn-black px-2" href="{{route('myFavouritesCompare')}}">Porównaj</a> <button class="send-to-friends btn btn-black px-2" onclick="$(\'#favourites-bar\').hide(); $(\'#send-to\').show();">Wyślij</button> </div> </div>');
                            $('#fav-nav').html('');
                            html.appendTo('#fav-nav');

                            for (var i = 0; i < responseMessage[3].length; i++) {
                                htmlForeach2 += '<li> <span id="link'+responseMessage[3][i].id+'">{{ url('/') }}/pl/apartaments/'+responseMessage[3][i].apartament_link+'</span> <span class="txt-blue copy-to-clipboard" onclick="copyToClipboard(\'#link'+responseMessage[3][i].id+'\')">Skopiuj</span> </li>';
                                foreachLinks += '{{ url('/') }}/pl/apartaments/'+responseMessage[3][i].apartament_link+',';
                            }

                            html2 = $('<span style="font-size: 24px; font-weight: bold">Wyślij znajomemu</span><br><div class="row"><div class="col-2"><span class="font-14">Linki:</span></div><div class="col-10"><ul class="font-13">'+ htmlForeach2 +'</ul></div></div><label for="emails">Adresy e-mail:</label><input id="emails" name="emails" type="text" placeholder="Wpisz adresy e-mail (rozdziel je przecinkami)"><input id="links" name="links" type="hidden" value="'+foreachLinks+'"><hr><button onclick="sendMailToFriends()" class="btn btn-default">Wyślij</button><button onClick="closeSendTo()" class="btn btn-default">Anuluj</button><div onClick="closeSendTo()" id="close-send-to" class="close-send-to">x</div>');
                            $('#send-to').html('');
                            html2.appendTo('#send-to');
                        }

						@if($favouritesAmount == 0 && Auth::check())
                        if(responseMessage[0] == 1) $("#first-added-favourites").show();
                        else alert("Apartament znajduje się już w ulubionych");
						@else
                        if(responseMessage[0] == 1) responseAlert = "Apartament dodano do ulubionych";
                        else responseAlert = "Apartament znajduje się już w ulubionych";
                        alert(responseAlert);
						@endif
                    },
                    error: function() {
                        console.log( "Error in connection with controller");
                    },
                });
            }
        }

        function closeSendTo(){
            $("#send-to").hide();
        }

        function deleteFromFavourites(apartamentId, userId){

            $.ajax({
                type: "GET",
                url: '/deleteFromFavourites/'+apartamentId+'/'+userId,
                dataType : 'json',
                data: {
                    apartamentId: apartamentId,
                    userId: userId,
                },
                success: function(responseMessage) {
                    $("#deleteApartamentFromFavourites").hide();
                    $("#addApartamentToFavourites").show();

                    var htmlForeach = '';
                    var htmlForeach2 = '';
                    var foreachLinks = '';

                    for (var i = 0; i < responseMessage[2].length; i++) {
                        htmlForeach += '<div class="row"> <div class="col-3" style="background-image: url(\'{{ url('/') }}/images/apartaments/' + responseMessage[2][i].id + '/main.jpg\'); background-size: cover; position: relative; margin-bottom: 0px; margin-left: 15px; padding-left: 0px; max-height: 52px;"></div> <div class="col-8 row" style="margin-right: -20px"> <div class="col-12 font-13 txt-blue"><a href="/apartaments/' + responseMessage[2][i].apartament_link + '">' + responseMessage[2][i].apartament_name + '</a></div> <div class="col-12 font-11 bold">' + responseMessage[2][i].apartament_address + '</div> <div class="col-12 font-11">' + responseMessage[2][i].apartament_address_2 + '</div> </div> <div class=""><img src="{{ asset("images/favourites/heart.png") }}"></div> </div> <hr>';
                    }

                    html = $('<span id="favourites-nav" onclick="$(\'#favourites-bar\').toggle();" class="nav-link">{{ __('messages.My favourites') }} (' + responseMessage[1] + ')</span> <div id="favourites-bar" style="border-bottom: 1px solid black; background-image: url({{ asset('images/account/favouritesPopup.png') }}); background-repeat: no-repeat; background-position: left top; display: none; position: absolute; left: 8px; width: 320px; z-index: 2000;"> <div class="p-3 pt-4"> <span class="bold" style="font-size: 24px">Ulubione (' + responseMessage[1] + ')</span> <a class="font-11" onclick="clearFavouritesPopup()" href="#">Wyczyść listę</a> ' + htmlForeach + '<a class="btn btn-black px-2" href="{{route('myFavourites')}}">Wszystkie (' + responseMessage[1] + ')</a> <a class="btn btn-black px-2" href="{{route('myFavouritesCompare')}}">Porównaj</a> <button class="send-to-friends btn btn-black px-2" onclick="$(\'#favourites-bar\').hide(); $(\'#send-to\').show();">Wyślij</button> </div> </div>');
                    $('#fav-nav').html('');
                    html.appendTo('#fav-nav');

                    for (var i = 0; i < responseMessage[3].length; i++) {
                        htmlForeach2 += '<li> <span id="link'+responseMessage[3][i].id+'">{{ url('/') }}/pl/apartaments/'+responseMessage[3][i].apartament_link+'</span> <span class="txt-blue copy-to-clipboard" onclick="copyToClipboard(\'#link'+responseMessage[3][i].id+'\')">Skopiuj</span> </li>';
                        foreachLinks += '{{ url('/') }}/pl/apartaments/'+responseMessage[3][i].apartament_link+',';
                    }

                    html2 = $('<span style="font-size: 24px; font-weight: bold">Wyślij znajomemu</span><br><div class="row"><div class="col-2"><span class="font-14">Linki:</span></div><div class="col-10"><ul class="font-13">'+ htmlForeach2 +'</ul></div></div><label for="emails">Adresy e-mail:</label><input id="emails" name="emails" type="text" placeholder="Wpisz adresy e-mail (rozdziel je przecinkami)"><input id="links" name="links" type="hidden" value="'+foreachLinks+'"><hr><button onclick="sendMailToFriends()" class="btn btn-default">Wyślij</button><button onClick="closeSendTo()" class="btn btn-default">Anuluj</button><div onClick="closeSendTo()" id="close-send-to" class="close-send-to">x</div>');
                    $('#send-to').html('');
                    html2.appendTo('#send-to');

                    alert(responseMessage[0]);
                },
                error: function() {
                    console.log( "Error in connection with controller");
                },
            });
        }

	</script>

{{-- Don't do this if there is no comments--}}
@if($comments != '')
			<script>
                allComments = {!! $comments !!};
                familyComments = {!! $familyComments !!};
                couplesComments = {!! $couplesComments !!};
                businessComments = {!! $businessComments !!};
                friendsComments = {!! $friendsComments !!};
                aloneComments = {!! $aloneComments !!};

                allOpinions = {!! $allOpinions !!};
                familyOpinions = {!! $familyOpinions !!};
                couplesOpinions = {!! $couplesOpinions !!};
                businessOpinions = {!! $businessOpinions !!};
                friendsOpinions = {!! $friendsOpinions !!};
                aloneOpinions = {!! $aloneOpinions !!};

                allStars = {!! $allStars !!};
                familyStars = {!! $familyStars !!};
                couplesStars = {!! $couplesStars !!};
                businessStars = {!! $businessStars !!};
                friendsStars = {!! $friendsStars !!};
                aloneStars = {!! $aloneStars !!};
			</script>
	<script>
		function setRatingAllTypes(){
            $(".allOpinionsAmount").text(allOpinions.opinionsAmount);
            $("#allOpinionsAmount").text(allOpinions.opinionsAmount);

            if(familyOpinions.opinionsAmount == 0) $("#familyTab").addClass('display-none-permanent');
            else{
                $(".familyOpinionsAmount").text(familyOpinions.opinionsAmount);
                $("#familyOpinionsAmount").text(familyOpinions.opinionsAmount);
			}

            if(couplesOpinions.opinionsAmount == 0) $("#couplesTab").addClass('display-none-permanent');
			else{
				$(".couplesOpinionsAmount").text(couplesOpinions.opinionsAmount);
				$("#couplesOpinionsAmount").text(couplesOpinions.opinionsAmount);
            }

            if(businessOpinions.opinionsAmount == 0) $("#businessTab").addClass('display-none-permanent');
            else{
                $(".businessOpinionsAmount").text(businessOpinions.opinionsAmount);
                $("#businessOpinionsAmount").text(businessOpinions.opinionsAmount);
			}

            if(friendsOpinions.opinionsAmount == 0) $("#friendsTab").addClass('display-none-permanent');
            else{
                $(".friendsOpinionsAmount").text(friendsOpinions.opinionsAmount);
                $("#friendsOpinionsAmount").text(friendsOpinions.opinionsAmount);
			}

            if(aloneOpinions.opinionsAmount == 0) $("#aloneTab").addClass('display-none-permanent');
            else{
                $(".aloneOpinionsAmount").text(aloneOpinions.opinionsAmount);
                $("#aloneOpinionsAmount").text(aloneOpinions.opinionsAmount);
			}
		}

		function setRating(journeyTypeObj, journeyType, starsType){
		    switch (journeyType){
				case 0: journeyName = "all"; break;
				case 1: journeyName = "family"; break;
				case 2: journeyName = "couples"; break;
				case 3: journeyName = "business"; break;
				case 4: journeyName = "friends"; break;
				case 5: journeyName = "alone"; break;
			}
            $("#"+journeyName+"TotalAvg").text(journeyTypeObj.totalAvg);
            $("#"+journeyName+"Cleanliness").text(journeyTypeObj.cleanlinessAvg);
            $("#"+journeyName+"Location").text(journeyTypeObj.locationAvg);
            $("#"+journeyName+"Facilities").text(journeyTypeObj.facilitiesAvg);
            $("#"+journeyName+"Staff").text(journeyTypeObj.staffAvg);
            $("#"+journeyName+"Quality_per_price").text(journeyTypeObj.quality_per_priceAvg);

            @handheld
            //set color of text for total avg rating
            if(journeyTypeObj.totalAvg <= 3 && journeyTypeObj.totalAvg >= 1){
                $("#"+journeyName+"TotalAvgWrapper").addClass("txt-red");
            }
            else if(journeyTypeObj.totalAvg > 3 && journeyTypeObj.totalAvg <= 6){
                $("#"+journeyName+"TotalAvgWrapper").addClass("txt-yellow");
            }
            else if(journeyTypeObj.totalAvg > 6){
                $("#"+journeyName+"TotalAvgWrapper").addClass("txt-green");
            }

            if(journeyTypeObj.totalAvg < 2) {
                $("#"+journeyName+"Description").text("Okropny");
            }
            else if(journeyTypeObj.totalAvg >= 2 && journeyTypeObj.totalAvg < 4){
                $("#"+journeyName+"Description").text("Zły");
            }
            else if(journeyTypeObj.totalAvg >= 4 && journeyTypeObj.totalAvg < 6){
                $("#"+journeyName+"Description").text("Średni");
            }
            else if(journeyTypeObj.totalAvg >= 6 && journeyTypeObj.totalAvg < 8){
                $("#"+journeyName+"Description").text("Bardzo dobry");
            }
            else if(journeyTypeObj.totalAvg >= 8){
                $("#"+journeyName+"Description").text("Doskonały");
            }
            @elsehandheld
            //set color box for total avg rating
            if(journeyTypeObj.totalAvg <= 3 && journeyTypeObj.totalAvg >= 1){
                $("#"+journeyName+"TotalAvgWrapper").addClass("rating-red");
            }
            else if(journeyTypeObj.totalAvg > 3 && journeyTypeObj.totalAvg <= 6){
                $("#"+journeyName+"TotalAvgWrapper").addClass("rating-yellow");
            }
            else if(journeyTypeObj.totalAvg > 6){
                $("#"+journeyName+"TotalAvgWrapper").addClass("rating-green");
            }
            @endhandheld

            //set img for total avg rating
            if(journeyTypeObj.totalAvg == null) $("#"+journeyName+"TotalAvgImg").attr("src",'{{ asset("images/opinions/star1.png") }}');
            else if(journeyTypeObj.totalAvg < 1.5) $("#"+journeyName+"TotalAvgImg").attr("src",'{{ asset("images/opinions/star1.png") }}');
            else if(journeyTypeObj.totalAvg < 2.5) $("#"+journeyName+"TotalAvgImg").attr("src",'{{ asset("images/opinions/star2.png") }}');
            else if(journeyTypeObj.totalAvg < 3.5) $("#"+journeyName+"TotalAvgImg").attr("src",'{{ asset("images/opinions/star3.png") }}');
            else if(journeyTypeObj.totalAvg < 4.5) $("#"+journeyName+"TotalAvgImg").attr("src",'{{ asset("images/opinions/star4.png") }}');
            else if(journeyTypeObj.totalAvg < 5.5) $("#"+journeyName+"TotalAvgImg").attr("src",'{{ asset("images/opinions/star5.png") }}');
            else if(journeyTypeObj.totalAvg < 6.5) $("#"+journeyName+"TotalAvgImg").attr("src",'{{ asset("images/opinions/star6.png") }}');
            else if(journeyTypeObj.totalAvg < 7.5) $("#"+journeyName+"TotalAvgImg").attr("src",'{{ asset("images/opinions/star7.png") }}');
            else if(journeyTypeObj.totalAvg < 8.5) $("#"+journeyName+"TotalAvgImg").attr("src",'{{ asset("images/opinions/star8.png") }}');
            else if(journeyTypeObj.totalAvg < 9.5) $("#"+journeyName+"TotalAvgImg").attr("src",'{{ asset("images/opinions/star9.png") }}');
            else $("#"+journeyName+"TotalAvgImg").attr("src",'{{ asset("images/opinions/star10.png") }}');

            //set rating bars

			opinionsAmount = journeyTypeObj.opinionsAmount;
            $("#"+journeyName+"Perfect .side.right").text(starsType[0].amount);
            $("#"+journeyName+"Very-good .side.right").text(starsType[1].amount);
            $("#"+journeyName+"Average .side.right").text(starsType[2].amount);
            $("#"+journeyName+"Bad .side.right").text(starsType[3].amount);
            $("#"+journeyName+"Awful .side.right").text(starsType[4].amount);

            if (allStars[0].amount == 0) $("#"+journeyName+"Perfect .bar-container>div").css({'width': "0%"});
            else $("#"+journeyName+"Perfect .bar-container>div").css({'width': starsType[0].amount / opinionsAmount * 100 +"%"});

            if (allStars[1].amount == 0) $("#"+journeyName+"Very-good .bar-container>div").css({'width': "0%"});
            else $("#"+journeyName+"Very-good .bar-container>div").css({'width': starsType[1].amount / opinionsAmount * 100 +"%"});

            if (allStars[2].amount == 0) $("#"+journeyName+"Average .bar-container>div").css({'width': "0%"});
            else $("#"+journeyName+"Average .bar-container>div").css({'width': starsType[2].amount / opinionsAmount * 100 +"%"});

            if (allStars[3].amount == 0) $("#"+journeyName+"Bad .bar-container>div").css({'width': "0%"});
            else $("#"+journeyName+"Bad .bar-container>div").css({'width': starsType[3].amount / opinionsAmount * 100 +"%"});

            if (allStars[4].amount == 0) $("#"+journeyName+"Awful .bar-container>div").css({'width': "0%"});
            else $("#"+journeyName+"Awful .bar-container>div").css({'width': starsType[4].amount / opinionsAmount * 100 +"%"});

            //set colors and star img
            if(journeyTypeObj.cleanlinessAvg <= 3 && journeyTypeObj.cleanlinessAvg >= 1){
                $("#"+journeyName+"Cleanliness").addClass("rating-red");
            }
            else if(journeyTypeObj.cleanlinessAvg > 3 && journeyTypeObj.cleanlinessAvg <= 6){
                $("#"+journeyName+"Cleanliness").addClass("rating-yellow");
            }
            else if(journeyTypeObj.cleanlinessAvg > 6){
                $("#"+journeyName+"Cleanliness").addClass("rating-green");
            }
            if(journeyTypeObj.cleanlinessAvg == null) $("#"+journeyName+"CleanlinessImg").attr("src",'{{ asset("images/opinions/0.png") }}');
            else if(journeyTypeObj.cleanlinessAvg < 1.5) $("#"+journeyName+"CleanlinessImg").attr("src",'{{ asset("images/opinions/1.png") }}');
            else if(journeyTypeObj.cleanlinessAvg < 2.5) $("#"+journeyName+"CleanlinessImg").attr("src",'{{ asset("images/opinions/2.png") }}');
            else if(journeyTypeObj.cleanlinessAvg < 3.5) $("#"+journeyName+"CleanlinessImg").attr("src",'{{ asset("images/opinions/3.png") }}');
            else if(journeyTypeObj.cleanlinessAvg < 4.5) $("#"+journeyName+"CleanlinessImg").attr("src",'{{ asset("images/opinions/4.png") }}');
            else if(journeyTypeObj.cleanlinessAvg < 5.5) $("#"+journeyName+"CleanlinessImg").attr("src",'{{ asset("images/opinions/5.png") }}');
            else if(journeyTypeObj.cleanlinessAvg < 6.5) $("#"+journeyName+"CleanlinessImg").attr("src",'{{ asset("images/opinions/6.png") }}');
            else if(journeyTypeObj.cleanlinessAvg < 7.5) $("#"+journeyName+"CleanlinessImg").attr("src",'{{ asset("images/opinions/7.png") }}');
            else if(journeyTypeObj.cleanlinessAvg < 8.5) $("#"+journeyName+"CleanlinessImg").attr("src",'{{ asset("images/opinions/8.png") }}');
            else if(journeyTypeObj.cleanlinessAvg < 9.5) $("#"+journeyName+"CleanlinessImg").attr("src",'{{ asset("images/opinions/9.png") }}');
            else $("#"+journeyName+"CleanlinessImg").attr("src",'{{ asset("images/opinions/10.png") }}');

            if(journeyTypeObj.locationAvg <= 3 && journeyTypeObj.locationAvg >= 1){
                $("#"+journeyName+"Location").addClass("rating-red");
            }
            else if(journeyTypeObj.locationAvg > 3 && journeyTypeObj.locationAvg <= 6){
                $("#"+journeyName+"Location").addClass("rating-yellow");
            }
            else if(journeyTypeObj.locationAvg > 6){
                $("#"+journeyName+"Location").addClass("rating-green");
            }
            if(journeyTypeObj.locationAvg == null) $("#"+journeyName+"LocationImg").attr("src",'{{ asset("images/opinions/0.png") }}');
            else if(journeyTypeObj.locationAvg < 1.5) $("#"+journeyName+"LocationImg").attr("src",'{{ asset("images/opinions/1.png") }}');
            else if(journeyTypeObj.locationAvg < 2.5) $("#"+journeyName+"LocationImg").attr("src",'{{ asset("images/opinions/2.png") }}');
            else if(journeyTypeObj.locationAvg < 3.5) $("#"+journeyName+"LocationImg").attr("src",'{{ asset("images/opinions/3.png") }}');
            else if(journeyTypeObj.locationAvg < 4.5) $("#"+journeyName+"LocationImg").attr("src",'{{ asset("images/opinions/4.png") }}');
            else if(journeyTypeObj.locationAvg < 5.5) $("#"+journeyName+"LocationImg").attr("src",'{{ asset("images/opinions/5.png") }}');
            else if(journeyTypeObj.locationAvg < 6.5) $("#"+journeyName+"LocationImg").attr("src",'{{ asset("images/opinions/6.png") }}');
            else if(journeyTypeObj.locationAvg < 7.5) $("#"+journeyName+"LocationImg").attr("src",'{{ asset("images/opinions/7.png") }}');
            else if(journeyTypeObj.locationAvg < 8.5) $("#"+journeyName+"LocationImg").attr("src",'{{ asset("images/opinions/8.png") }}');
            else if(journeyTypeObj.locationAvg < 9.5) $("#"+journeyName+"LocationImg").attr("src",'{{ asset("images/opinions/9.png") }}');
            else $("#"+journeyName+"LocationImg").attr("src",'{{ asset("images/opinions/10.png") }}');

            if(journeyTypeObj.facilitiesAvg <= 3 && journeyTypeObj.facilitiesAvg >= 1){
                $("#"+journeyName+"Facilities").addClass("rating-red");
            }
            else if(journeyTypeObj.facilitiesAvg > 3 && journeyTypeObj.facilitiesAvg <= 6){
                $("#"+journeyName+"Facilities").addClass("rating-yellow");
            }
            else if(journeyTypeObj.facilitiesAvg > 6){
                $("#"+journeyName+"Facilities").addClass("rating-green");
            }
            if(journeyTypeObj.facilitiesAvg == null) $("#"+journeyName+"FacilitiesImg").attr("src",'{{ asset("images/opinions/0.png") }}');
            else if(journeyTypeObj.facilitiesAvg < 1.5) $("#"+journeyName+"FacilitiesImg").attr("src",'{{ asset("images/opinions/1.png") }}');
            else if(journeyTypeObj.facilitiesAvg < 2.5) $("#"+journeyName+"FacilitiesImg").attr("src",'{{ asset("images/opinions/2.png") }}');
            else if(journeyTypeObj.facilitiesAvg < 3.5) $("#"+journeyName+"FacilitiesImg").attr("src",'{{ asset("images/opinions/3.png") }}');
            else if(journeyTypeObj.facilitiesAvg < 4.5) $("#"+journeyName+"FacilitiesImg").attr("src",'{{ asset("images/opinions/4.png") }}');
            else if(journeyTypeObj.facilitiesAvg < 5.5) $("#"+journeyName+"FacilitiesImg").attr("src",'{{ asset("images/opinions/5.png") }}');
            else if(journeyTypeObj.facilitiesAvg < 6.5) $("#"+journeyName+"FacilitiesImg").attr("src",'{{ asset("images/opinions/6.png") }}');
            else if(journeyTypeObj.facilitiesAvg < 7.5) $("#"+journeyName+"FacilitiesImg").attr("src",'{{ asset("images/opinions/7.png") }}');
            else if(journeyTypeObj.facilitiesAvg < 8.5) $("#"+journeyName+"FacilitiesImg").attr("src",'{{ asset("images/opinions/8.png") }}');
            else if(journeyTypeObj.facilitiesAvg < 9.5) $("#"+journeyName+"FacilitiesImg").attr("src",'{{ asset("images/opinions/9.png") }}');
            else $("#"+journeyName+"FacilitiesImg").attr("src",'{{ asset("images/opinions/10.png") }}');

            if(journeyTypeObj.staffAvg <= 3 && journeyTypeObj.staffAvg >= 1){
                $("#"+journeyName+"Staff").addClass("rating-red");
            }
            else if(journeyTypeObj.staffAvg > 3 && journeyTypeObj.staffAvg <= 6){
                $("#"+journeyName+"Staff").addClass("rating-yellow");
            }
            else if(journeyTypeObj.staffAvg > 6){
                $("#"+journeyName+"Staff").addClass("rating-green");
            }
            if(journeyTypeObj.staffAvg == null) $("#"+journeyName+"StaffImg").attr("src",'{{ asset("images/opinions/0.png") }}');
            else if(journeyTypeObj.staffAvg < 1.5) $("#"+journeyName+"StaffImg").attr("src",'{{ asset("images/opinions/1.png") }}');
            else if(journeyTypeObj.staffAvg < 2.5) $("#"+journeyName+"StaffImg").attr("src",'{{ asset("images/opinions/2.png") }}');
            else if(journeyTypeObj.staffAvg < 3.5) $("#"+journeyName+"StaffImg").attr("src",'{{ asset("images/opinions/3.png") }}');
            else if(journeyTypeObj.staffAvg < 4.5) $("#"+journeyName+"StaffImg").attr("src",'{{ asset("images/opinions/4.png") }}');
            else if(journeyTypeObj.staffAvg < 5.5) $("#"+journeyName+"StaffImg").attr("src",'{{ asset("images/opinions/5.png") }}');
            else if(journeyTypeObj.staffAvg < 6.5) $("#"+journeyName+"StaffImg").attr("src",'{{ asset("images/opinions/6.png") }}');
            else if(journeyTypeObj.staffAvg < 7.5) $("#"+journeyName+"StaffImg").attr("src",'{{ asset("images/opinions/7.png") }}');
            else if(journeyTypeObj.staffAvg < 8.5) $("#"+journeyName+"StaffImg").attr("src",'{{ asset("images/opinions/8.png") }}');
            else if(journeyTypeObj.staffAvg < 9.5) $("#"+journeyName+"StaffImg").attr("src",'{{ asset("images/opinions/9.png") }}');
            else $("#"+journeyName+"StaffImg").attr("src",'{{ asset("images/opinions/10.png") }}');

            if(journeyTypeObj.quality_per_priceAvg <= 3 && journeyTypeObj.quality_per_priceAvg >= 1){
                $("#"+journeyName+"Quality_per_price").addClass("rating-red");
            }
            else if(journeyTypeObj.quality_per_priceAvg > 3 && journeyTypeObj.quality_per_priceAvg <= 6){
                $("#"+journeyName+"Quality_per_price").addClass("rating-yellow");
            }
            else if(journeyTypeObj.quality_per_priceAvg > 6){
                $("#"+journeyName+"Quality_per_price").addClass("rating-green");
            }
            if(journeyTypeObj.quality_per_priceAvg == null) $("#"+journeyName+"Quality_per_priceImg").attr("src",'{{ asset("images/opinions/0.png") }}');
            else if(journeyTypeObj.quality_per_priceAvg < 1.5) $("#"+journeyName+"Quality_per_priceImg").attr("src",'{{ asset("images/opinions/1.png") }}');
            else if(journeyTypeObj.quality_per_priceAvg < 2.5) $("#"+journeyName+"Quality_per_priceImg").attr("src",'{{ asset("images/opinions/2.png") }}');
            else if(journeyTypeObj.quality_per_priceAvg < 3.5) $("#"+journeyName+"Quality_per_priceImg").attr("src",'{{ asset("images/opinions/3.png") }}');
            else if(journeyTypeObj.quality_per_priceAvg < 4.5) $("#"+journeyName+"Quality_per_priceImg").attr("src",'{{ asset("images/opinions/4.png") }}');
            else if(journeyTypeObj.quality_per_priceAvg < 5.5) $("#"+journeyName+"Quality_per_priceImg").attr("src",'{{ asset("images/opinions/5.png") }}');
            else if(journeyTypeObj.quality_per_priceAvg < 6.5) $("#"+journeyName+"Quality_per_priceImg").attr("src",'{{ asset("images/opinions/6.png") }}');
            else if(journeyTypeObj.quality_per_priceAvg < 7.5) $("#"+journeyName+"Quality_per_priceImg").attr("src",'{{ asset("images/opinions/7.png") }}');
            else if(journeyTypeObj.quality_per_priceAvg < 8.5) $("#"+journeyName+"Quality_per_priceImg").attr("src",'{{ asset("images/opinions/8.png") }}');
            else if(journeyTypeObj.quality_per_priceAvg < 9.5) $("#"+journeyName+"Quality_per_priceImg").attr("src",'{{ asset("images/opinions/9.png") }}');
            else $("#"+journeyName+"Quality_per_priceImg").attr("src",'{{ asset("images/opinions/10.png") }}');
		}

		setRating(allOpinions, 0, allStars);
		setRating(familyOpinions, 1, familyStars);
		setRating(couplesOpinions, 2, couplesStars);
		setRating(businessOpinions, 3, businessStars);
		setRating(friendsOpinions, 4, friendsStars);
		setRating(aloneOpinions, 5, aloneStars);
        setRatingAllTypes();
	</script>

	<script>

        nowSortedComments = allComments;
		showingCommentsAmount = 0;
	@handheld
        function setComments(comments, more){
            //clear last comments
            $("div.user-comments").html('');

            if(comments.length > 5 && showingCommentsAmount + 5 < comments.length) $("#showMoreOpinions").show();
            else $("#showMoreOpinions").hide();

            if(comments.length < 5 || showingCommentsAmount + 5 > comments.length) len = comments.length;
            else len = 5;

            if(more == 1 && showingCommentsAmount + 5 < comments.length) len = showingCommentsAmount + 5;

            showingCommentsAmount = len;

            for (var i = 0; i < len; i++) {

                switch(comments[i]['journey_type']){
                    case 0: journeyType = 'Rodzina'; break;
                    case 1: journeyType = 'Para'; break;
                    case 2: journeyType = 'Biznasowa'; break;
                    case 3: journeyType = 'Ze znajomymi'; break;
                    case 4: journeyType = 'W pojedynkę'; break;
                }

                if (comments[i]['pros'] == null && comments[i]['cons'] == null){
                    htmlPros = '<div class="col-12 font-12 mb-3" style="padding-right: 0px; color: #999999;">Nie pozostawiono żadnego komentarza do oceny.</div>';
                    htmlCons = '';
                }
                else{
                    if (comments[i]['pros'] != null) htmlPros = '<div class="col-1 center-h-v"> <div style="background-color: #4eff5e; color: white; width:16px; height: 16px"><b>+</b></div> </div> <div class="col-10 pl-2 pr-0">'+ comments[i]['pros'] +'</div>';
                    else htmlPros = '<div class="col-12 font-12 mb-3" style="padding-right: 0px; color: #999999;">Nie pozostawiono żadnego pozytywnego komentarza do oceny.</div>';
                    if (comments[i]['cons'] != null) htmlCons = '<div class="col-1 center-h-v"><div style="background-color: #ff2620; color: white; width:16px; height: 16px"><b>-</b></div></div><div class="col-10 pl-2 pr-0">'+ comments[i]['cons'] +'</div>';
                    else htmlCons = '<div class="col-12 font-12 mb-3" style="padding-right: 0px; color: #999999;">Nie pozostawiono żadnego negatywnego komentarza do oceny.</div>';
                }

                if (comments[i]['helpful'] == 1) helpful = '<div class="row mb-1 font-11"><b class="mr-1">'+comments[i]['helpful']+'</b> osoba uznała opinię za pomocną</div>';
                else if (comments[i]['helpful'] > 1 && comments[i]['helpful'] < 5) helpful = '<div class="row mb-1 font-11"><b class="mr-1">'+comments[i]['helpful']+'</b> osoby uznały opinię za pomocną</div>';
                else if (comments[i]['helpful'] >= 5) helpful = '<div class="row mb-1 font-11"><b class="mr-1">'+comments[i]['helpful']+'</b> osób uznało opinię za pomocną</div>';
                else helpful = '';

                if(comments[i]['user_name'] != 0) nameAndCity = '<div class="font-13"><b>'+comments[i]['user_name']+'</b></div> <div class="font-13">'+comments[i]['user_country']+', '+comments[i]['user_city']+'</div>';
                else nameAndCity = '<div class="font-13">Anonimowy</div>';

                if(comments[i]['total_rating'] <= 3 && comments[i]['total_rating'] >= 1){
                    ratingColor = "txt-red";
                }
                else if(comments[i]['total_rating'] > 3 && comments[i]['total_rating'] <= 6){
                    ratingColor = "txt-yellow";
                }
                else if(comments[i]['total_rating'] > 6){
                    ratingColor = "txt-green";
                }

                if(comments[i]['total_rating'] < 2) {
                   	ratingDescription = "Okropny";
                }
                else if(comments[i]['total_rating'] >= 2 && comments[i]['total_rating'] < 4){
                    ratingDescription = "Zły";
                }
                else if(comments[i]['total_rating'] >= 4 && comments[i]['total_rating'] < 6){
                    ratingDescription = "Średni";
                }
                else if(comments[i]['total_rating'] >= 6 && comments[i]['total_rating'] < 8){
                    ratingDescription = "Bardzo dobry";
                }
                else if(comments[i]['total_rating'] >= 8){
                    ratingDescription = "Doskonały";
                }

                html = $('<div class="col-12 px-0"><div class="p-3" style="background-position: left bottom; background-image: url(\'{{ asset("images/apartment_detal/comment_mobile_background.png") }}\'"><div class="row"> <div class="col-6"><img src="/images/opinions/star'+Math.ceil(comments[i]['total_rating'])+'.png"></div> <div class="col-6 pl-0 '+ratingColor+'"> <span class="font-12 pull-right mt-1">'+ratingDescription+'</span> <span class="font-18 bold mr-1 pull-right"> <span>'+parseFloat(comments[i]['total_rating']).toFixed(1)+'</span>/10 </span></div></div><div class="row mb-4 mt-3">'+htmlPros+'</div> <div class="row" style="margin-bottom: 78px"> '+htmlCons+' </div> '+helpful+' <div class="row"> <div class="col-7 px-0"> <div class="row ml-0"> <img style="width: 48px; height: 48px" src=\'{{ asset("images/opinions/journey-type-") }}'+comments[i]['journey_type']+'.png\'> <div class="col pl-1 pr-0"> '+nameAndCity+' <div class="font-11" style="margin-top: 3px;">Opinia z: '+moment(comments[i]['created_at'], "YYYY-MM-DD").format("DD.MM.YYYY")+'</div> </div> </div> </div> <div class="col-5 px-0"> <a class="btn btn-opinion-gray font-11 pull-right ml-2" href="#"><img src=\'{{ asset("images/opinions/flag.png") }}\'></a> <button class="btn btn-opinion-gray font-11 pull-right" onclick="increaseHelpful('+comments[i]['id']+')"><img src=\'{{ asset("images/opinions/thumb.png") }}\'></button> </div> </div></div></div>');
				html.appendTo('.user-comments');

            }
        }
	@elsehandheld
		function setComments(comments, more){
		    //clear last comments
            $("div.user-comments").html('');

            if(comments.length > 5 && showingCommentsAmount + 5 < comments.length) $("#showMoreOpinions").show();
            else $("#showMoreOpinions").hide();

            if(comments.length < 5 || showingCommentsAmount + 5 > comments.length) len = comments.length;
            else len = 5;

            if(more == 1 && showingCommentsAmount + 5 < comments.length) len = showingCommentsAmount + 5;

            showingCommentsAmount = len;

            for (var i = 0; i < len; i++) {

                switch(comments[i]['journey_type']){
					case 0: journeyType = 'Rodzina'; break;
					case 1: journeyType = 'Para'; break;
					case 2: journeyType = 'Biznasowa'; break;
					case 3: journeyType = 'Ze znajomymi'; break;
					case 4: journeyType = 'W pojedynkę'; break;
				}

				html21 = $('<div style="float: left"></div>').append($('<div style="width: 50px"></div>').append($('<img src=\'{{ asset("images/opinions/journey-type-")}}'+comments[i]['journey_type']+'.png\'><span class="font-11 under-journey-type">'+journeyType+'</span>')));
				if(comments[i]['user_name'] == 0) html22 = $('<div class="col-12 user-data-detail"></div>').append($('<div class="row font-16">Anonimowy</div><div class="row font-11" style="margin-top: 3px;">Opinia z: '+moment(comments[i]['created_at'], "YYYY-MM-DD").format("DD.MM.YYYY")+'</div>'));
				else html22 = $('<div class="col-12 user-data-detail"></div>').append($('<div class="row font-16"><b>'+comments[i]['user_name']+'</b></div><div class="row font-16">'+comments[i]['user_country']+', '+comments[i]['user_city']+'</div><div class="row font-11" style="margin-top: 3px;">Opinia z: '+moment(comments[i]['created_at'], "YYYY-MM-DD").format("DD.MM.YYYY")+'</div>'));
				html2 = $('<div style="margin-bottom: 16px;"></div>').append(html21).append(html22);
                html3 = $('<div style="clear: both; max-width: 200px; width: 200px;" class="col-12 row"></div>').append('<button class="btn btn-opinion-gray font-11 mr-2 px-1 py-0" onclick="increaseHelpful('+comments[i]['id']+')"><img style="position: relative;top: 6px;" src={{ asset("images/opinions/thumb.png") }}><span class="ml-1">Pomocna</span><br><span class="ml-3">opinia</span></button><a class="btn btn-opinion-gray ml-2 font-11" href="/contact/report/'+comments[i]['id']+'"><img src={{ asset("images/opinions/flag.png") }}></a>');
                htmlLeft = $('<div class="col-3 user-data"></div>').append(html2).append(html3);

                if(comments[i]['total_rating'] > 6) ratingColor = "green";
                else if(comments[i]['total_rating'] > 3) ratingColor = "yellow";
                else ratingColor = "red";
                html0 = $('<div class="col-2" style="padding-left: 0px;"><div style="font-size: 22px" class="overall-rating-box center-h-v rating-'+ratingColor+'"><b>'+parseFloat(comments[i]['total_rating']).toFixed(1)+'</b></div><button class="btn font-11 expand" id="'+comments[i]['id']+'" onclick="expandOpinions('+comments[i]['id']+')">rozwiń ▼</button></div>');

                html11 = $('<div class="col-12 mb-2" style="padding-right: 0px; margin-left: -16px"><img src="/images/opinions/star'+Math.ceil(comments[i]['total_rating'])+'.png"></div>');

                if (comments[i]['pros'] == null && comments[i]['cons'] == null){
                    html12 = $('<div class="col-12 row font-12 mb-3" style="padding-right: 0px; color: #999999;">Nie pozostawiono żadnego komentarza do oceny.</div>');
                    html13 = $('');
				}
				else{
                    if (comments[i]['pros'] != null) html12 = $('<div class="col-12 row font-12 mb-3" style="padding-right: 0px"> <div class="col-1 center-h-v"> <div style="background-color: #4eff5e; color: white; width:16px; height: 16px"><b>+</b></div> </div> <div class="col-11 comment-row" style="margin-left: -20px; padding-right: 0px"> <div class="ml-2">'+ comments[i]['pros'] +'</div> </div> </div>');
                    else html12 = $('<div class="col-12 row font-12 mb-3" style="padding-right: 0px; color: #999999;">Nie pozostawiono żadnego pozytywnego komentarza do oceny.</div>');
                    if (comments[i]['cons'] != null) html13 = $('<div class="col-12 row font-12 mb-3" style="padding-right: 0px"> <div class="col-1 center-h-v"> <div style="background-color: #ff2620; color: white; width:16px; height: 16px"><b>-</b></div> </div> <div class="col-11 comment-row" style="margin-left: -20px; padding-right: 0px"> <div class="ml-2">'+ comments[i]['cons'] +'</div> </div> </div>');
                    else html13 = $('<div class="col-12 row font-12 mb-3" style="padding-right: 0px; color: #999999;">Nie pozostawiono żadnego negatywnego komentarza do oceny.</div>');
				}

                //set stay month name and year
                var dateObj = new Date();
                var month = dateObj.getUTCMonth() + 1; //months from 1-12
                var day = dateObj.getUTCDate();
                var year = dateObj.getUTCFullYear();
                newdate = year + "/" + month + "/" + day;
                locale = "pl",
                month = dateObj.toLocaleString(locale, { month: "long" });
				html14 = $('<div id="expanded-date-'+comments[i]['id']+'" class="col-12 mb-2" style="display: none; font-weight: bold; padding-right: 0px; margin-left: -16px">Pobyt: '+month +" "+ year+'</div>');

                if(comments[i]["cleanliness"] <= 3 && comments[i]["cleanliness"] >= 1){
                    cleanlinessClass = "rating-red";
                }
                else if(comments[i]["cleanliness"] > 3 && comments[i]["cleanliness"] <= 6){
                    cleanlinessClass = "rating-yellow";
                }
                else if(comments[i]["cleanliness"] > 6){
                    cleanlinessClass = "rating-green";
                }

                if(comments[i]["cleanliness"] == null) cleanlinessStars = '{{ asset("images/opinions/0.png") }}';
                else if(comments[i]["cleanliness"] < 1.5) cleanlinessStars = '{{ asset("images/opinions/1.png") }}';
                else if(comments[i]["cleanliness"] < 2.5) cleanlinessStars = '{{ asset("images/opinions/2.png") }}';
                else if(comments[i]["cleanliness"] < 3.5) cleanlinessStars = '{{ asset("images/opinions/3.png") }}';
                else if(comments[i]["cleanliness"] < 4.5) cleanlinessStars = '{{ asset("images/opinions/4.png") }}';
                else if(comments[i]["cleanliness"] < 5.5) cleanlinessStars = '{{ asset("images/opinions/5.png") }}';
                else if(comments[i]["cleanliness"] < 6.5) cleanlinessStars = '{{ asset("images/opinions/6.png") }}';
                else if(comments[i]["cleanliness"] < 7.5) cleanlinessStars = '{{ asset("images/opinions/7.png") }}';
                else if(comments[i]["cleanliness"] < 8.5) cleanlinessStars = '{{ asset("images/opinions/8.png") }}';
                else if(comments[i]["cleanliness"] < 9.5) cleanlinessStars = '{{ asset("images/opinions/9.png") }}';
                else cleanlinessStars = '{{ asset("images/opinions/10.png") }}';

                if(comments[i]["location"] <= 3 && comments[i]["location"] >= 1){
                    locationClass = "rating-red";
                }
                else if(comments[i]["location"] > 3 && comments[i]["location"] <= 6){
                    locationClass = "rating-yellow";
                }
                else if(comments[i]["location"] > 6){
                    locationClass = "rating-green";
                }

                if(comments[i]["location"] == null) locationStars = '{{ asset("images/opinions/0.png") }}';
                else if(comments[i]["location"] < 1.5) locationStars = '{{ asset("images/opinions/1.png") }}';
                else if(comments[i]["location"] < 2.5) locationStars = '{{ asset("images/opinions/2.png") }}';
                else if(comments[i]["location"] < 3.5) locationStars = '{{ asset("images/opinions/3.png") }}';
                else if(comments[i]["location"] < 4.5) locationStars = '{{ asset("images/opinions/4.png") }}';
                else if(comments[i]["location"] < 5.5) locationStars = '{{ asset("images/opinions/5.png") }}';
                else if(comments[i]["location"] < 6.5) locationStars = '{{ asset("images/opinions/6.png") }}';
                else if(comments[i]["location"] < 7.5) locationStars = '{{ asset("images/opinions/7.png") }}';
                else if(comments[i]["location"] < 8.5) locationStars = '{{ asset("images/opinions/8.png") }}';
                else if(comments[i]["location"] < 9.5) locationStars = '{{ asset("images/opinions/9.png") }}';
                else locationStars = '{{ asset("images/opinions/10.png") }}';

                if(comments[i]["facilities"] <= 3 && comments[i]["facilities"] >= 1){
                    facilitiesClass = "rating-red";
                }
                else if(comments[i]["facilities"] > 3 && comments[i]["facilities"] <= 6){
                    facilitiesClass = "rating-yellow";
                }
                else if(comments[i]["facilities"] > 6){
                    facilitiesClass = "rating-green";
                }

                if(comments[i]["facilities"] == null) facilitiesStars = '{{ asset("images/opinions/0.png") }}';
                else if(comments[i]["facilities"] < 1.5) facilitiesStars = '{{ asset("images/opinions/1.png") }}';
                else if(comments[i]["facilities"] < 2.5) facilitiesStars = '{{ asset("images/opinions/2.png") }}';
                else if(comments[i]["facilities"] < 3.5) facilitiesStars = '{{ asset("images/opinions/3.png") }}';
                else if(comments[i]["facilities"] < 4.5) facilitiesStars = '{{ asset("images/opinions/4.png") }}';
                else if(comments[i]["facilities"] < 5.5) facilitiesStars = '{{ asset("images/opinions/5.png") }}';
                else if(comments[i]["facilities"] < 6.5) facilitiesStars = '{{ asset("images/opinions/6.png") }}';
                else if(comments[i]["facilities"] < 7.5) facilitiesStars = '{{ asset("images/opinions/7.png") }}';
                else if(comments[i]["facilities"] < 8.5) facilitiesStars = '{{ asset("images/opinions/8.png") }}';
                else if(comments[i]["facilities"] < 9.5) facilitiesStars = '{{ asset("images/opinions/9.png") }}';
                else facilitiesStars = '{{ asset("images/opinions/10.png") }}';

                if(comments[i]["staff"] <= 3 && comments[i]["staff"] >= 1){
                    staffClass = "rating-red";
                }
                else if(comments[i]["staff"] > 3 && comments[i]["staff"] <= 6){
                    staffClass = "rating-yellow";
                }
                else if(comments[i]["staff"] > 6){
                    staffClass = "rating-green";
                }

                if(comments[i]["staff"] == null) staffStars = '{{ asset("images/opinions/0.png") }}';
                else if(comments[i]["staff"] < 1.5) staffStars = '{{ asset("images/opinions/1.png") }}';
                else if(comments[i]["staff"] < 2.5) staffStars = '{{ asset("images/opinions/2.png") }}';
                else if(comments[i]["staff"] < 3.5) staffStars = '{{ asset("images/opinions/3.png") }}';
                else if(comments[i]["staff"] < 4.5) staffStars = '{{ asset("images/opinions/4.png") }}';
                else if(comments[i]["staff"] < 5.5) staffStars = '{{ asset("images/opinions/5.png") }}';
                else if(comments[i]["staff"] < 6.5) staffStars = '{{ asset("images/opinions/6.png") }}';
                else if(comments[i]["staff"] < 7.5) staffStars = '{{ asset("images/opinions/7.png") }}';
                else if(comments[i]["staff"] < 8.5) staffStars = '{{ asset("images/opinions/8.png") }}';
                else if(comments[i]["staff"] < 9.5) staffStars = '{{ asset("images/opinions/9.png") }}';
                else staffStars = '{{ asset("images/opinions/10.png") }}';

                if(comments[i]["quality_per_price"] <= 3 && comments[i]["quality_per_price"] >= 1){
                    quality_per_priceClass = "rating-red";
                }
                else if(comments[i]["quality_per_price"] > 3 && comments[i]["quality_per_price"] <= 6){
                    quality_per_priceClass = "rating-yellow";
                }
                else if(comments[i]["quality_per_price"] > 6){
                    quality_per_priceClass = "rating-green";
                }

                if(comments[i]["quality_per_price"] == null) quality_per_priceStars = '{{ asset("images/opinions/0.png") }}';
				else if(comments[i]["quality_per_price"] < 1.5) quality_per_priceStars = '{{ asset("images/opinions/1.png") }}';
				else if(comments[i]["quality_per_price"] < 2.5) quality_per_priceStars = '{{ asset("images/opinions/2.png") }}';
				else if(comments[i]["quality_per_price"] < 3.5) quality_per_priceStars = '{{ asset("images/opinions/3.png") }}';
				else if(comments[i]["quality_per_price"] < 4.5) quality_per_priceStars = '{{ asset("images/opinions/4.png") }}';
				else if(comments[i]["quality_per_price"] < 5.5) quality_per_priceStars = '{{ asset("images/opinions/5.png") }}';
				else if(comments[i]["quality_per_price"] < 6.5) quality_per_priceStars = '{{ asset("images/opinions/6.png") }}';
				else if(comments[i]["quality_per_price"] < 7.5) quality_per_priceStars = '{{ asset("images/opinions/7.png") }}';
				else if(comments[i]["quality_per_price"] < 8.5) quality_per_priceStars = '{{ asset("images/opinions/8.png") }}';
				else if(comments[i]["quality_per_price"] < 9.5) quality_per_priceStars = '{{ asset("images/opinions/9.png") }}';
				else quality_per_priceStars = '{{ asset("images/opinions/10.png") }}';

                htmlDetails = $('<div class="expanded col-12 row" id="expanded-'+comments[i]['id']+'" style="display: none"><div class="col-6"><div class="col-12 font-11 mb-1"> Czystość <span class="pull-right rating-opinion-detail"><span class='+cleanlinessClass+'>'+comments[i]["cleanliness"]+'</span></span> <span class="pull-right" style="background-color: #fff"> <img src='+cleanlinessStars+'> </span> </div> <div class="col-12 font-11 mb-1"> Lokalizacja <span class="pull-right rating-opinion-detail"><span class='+locationClass+'>'+comments[i]["location"]+'</span></span> <span class="pull-right" style="background-color: #fff"> <img src='+locationStars+'> </span> </div> <div class="col-12 font-11 mb-1"> Udogodnienia <span class="pull-right rating-opinion-detail"><span class='+facilitiesClass+'>'+comments[i]["facilities"]+'</span></span> <span class="pull-right" style="background-color: #fff"> <img src='+facilitiesStars+'> </span> </div> </div> <div class="col-6"><div class="col-12 font-11 mb-1"> Obsługa <span class="pull-right rating-opinion-detail"><span class='+staffClass+'>'+comments[i]["staff"]+'</span></span> <span class="pull-right" style="background-color: #fff"> <img src='+staffStars+'> </span> </div> <div class="col-12 font-11 mb-1"> Stosunek jakości<br> do ceny <span style="position: absolute;right: 0px;top: 0px;"> <span class="pull-right rating-opinion-detail"> <span class='+quality_per_priceClass+'>'+comments[i]["quality_per_price"]+'</span></span> <span class="pull-right" style="background-color: #fff"> <img src='+quality_per_priceStars+'> </span> </span></span>  </div></div></div>');

                html1 = $('<div class="col-10 comment-row" style="padding-right: 0px; padding-left: 0px;"></div>').append(html11).append(html12).append(html13).append(html14);

                htmlRight = $('<div class="comment-background col-9 row py-3" style="background-image: url(\'{{ asset("images/apartment_detal/comment_background.png") }}\')"></div>').append(html0).append(html1).append(htmlDetails);
                if (comments[i]['helpful'] == 1) htmlRight.append('<div style="position: absolute;bottom: -20px;" class="font-11"><b>1</b>  osoba uznała opinię za pomocną</div>');
                else if (comments[i]['helpful'] > 1 && comments[i]['helpful'] < 5) htmlRight.append('<div style="position: absolute;bottom: -20px;" class="font-11"><b>'+comments[i]['helpful']+'</b>  osoby uznały opinię za pomocną</div>');
                else if (comments[i]['helpful'] > 4) htmlRight.append('<div style="position: absolute;bottom: -20px;" class="font-11"><b>'+comments[i]['helpful']+'</b> osób uznało opinię za pomocną</div>');
                html = $('<span class="mb-5" style="display: flex; width: 100%"></span>').append(htmlLeft).append(htmlRight);
                html.appendTo('.user-comments');
            };
        }
    @endhandheld

		sortComments(nowSortedComments);

        function sortCommentsNewest(comments){
            comments.sort(function(a, b){
                var firstDate = new Date(a.created_at);
                var secondDate = new Date(b.created_at);
                return secondDate - firstDate;
            });

            return comments;
        }

        function sortCommentsOldest(comments){
            comments.sort(function(a, b){
                var firstDate = new Date(a.created_at);
                var secondDate = new Date(b.created_at);
                return firstDate - secondDate;
            });

            return comments;
        }

        function sortCommentsMostHelpful(comments){
            comments.sort(function(a, b){return b.helpful-a.helpful});

            return comments;
        }

        function sortCommentsBest(comments){
            comments.sort(function(a, b){return b.total_rating-a.total_rating});

            return comments;
        }

        function sortCommentsWorst(comments){
            comments.sort(function(a, b){return a.total_rating-b.total_rating});

            return comments;
        }

        function sortComments(comments){

            showingCommentsAmount = 0;

            sortType = $("#sortType").val();

            switch(sortType){
				case "1": setComments(sortCommentsNewest(comments), 0); break;
				case "2": setComments(sortCommentsOldest(comments)), 0; break;
				case "3": setComments(sortCommentsMostHelpful(comments), 0); break;
				case "4": setComments(sortCommentsBest(comments), 0); break;
				case "5": setComments(sortCommentsWorst(comments), 0); break;
			}
		}

        function filterComments(comments, stars){
            if(stars == 1) {
                filtered = comments.filter(function(x) {return x.total_rating < 2;});
                nowSortedComments = filtered;
                $("#allOpinionsAfter").text("- ocena obiektu: okropny");
			}
            else if(stars == 2){
                filtered = comments.filter(function(x){return (x.total_rating >= 2 && x.total_rating < 4);});
                nowSortedComments = filtered;
                $("#allOpinionsAfter").text("- ocena obiektu: zły");
			}
            else if(stars == 3){
                filtered = comments.filter(function(x){return (x.total_rating >= 4 && x.total_rating < 6);});
                nowSortedComments = filtered;
                $("#allOpinionsAfter").text("- ocena obiektu: średni");
			}
            else if(stars == 4){
                filtered = comments.filter(function(x){return (x.total_rating >= 6 && x.total_rating < 8);});
                nowSortedComments = filtered;
                $("#allOpinionsAfter").text("- ocena obiektu: bardzo dobry");
			}
            else if(stars == 5){
                filtered = comments.filter(function(x){return x.total_rating >= 8;});
                nowSortedComments = filtered;
                $("#allOpinionsAfter").text("- ocena obiektu: doskonały");
			}

            showingCommentsAmount = 0;
            setComments(nowSortedComments, 0);
            $("#allOpinionsAmount").text(filtered.length);
		}

        $("#allPerfect").on("click", function(){ filterComments(allComments, 5); });
        $("#allVery-good").on("click", function(){ filterComments(allComments, 4); });
        $("#allAverage").on("click", function(){ filterComments(allComments, 3); });
        $("#allBad").on("click", function(){ filterComments(allComments, 2); });
        $("#allAwful").on("click", function(){ filterComments(allComments, 1); });

        $("#familyPerfect").on("click", function(){ filterComments(familyComments, 5); });
        $("#familyVery-good").on("click", function(){ filterComments(familyComments, 4); });
        $("#familyAverage").on("click", function(){ filterComments(familyComments, 3); });
        $("#familyBad").on("click", function(){ filterComments(familyComments, 2); });
        $("#familyAwful").on("click", function(){ filterComments(familyComments, 1); });

        $("#couplesPerfect").on("click", function(){ filterComments(couplesComments, 5); });
        $("#couplesVery-good").on("click", function(){ filterComments(couplesComments, 4); });
        $("#couplesAverage").on("click", function(){ filterComments(couplesComments, 3); });
        $("#couplesBad").on("click", function(){ filterComments(couplesComments, 2); });
        $("#couplesAwful").on("click", function(){ filterComments(couplesComments, 1); });

        $("#businessPerfect").on("click", function(){ filterComments(businessComments, 5); });
        $("#businessVery-good").on("click", function(){ filterComments(businessComments, 4); });
        $("#businessAverage").on("click", function(){ filterComments(businessComments, 3); });
        $("#businessBad").on("click", function(){ filterComments(businessComments, 2); });
        $("#businessAwful").on("click", function(){ filterComments(businessComments, 1); });

        $("#friendsPerfect").on("click", function(){ filterComments(friendsComments, 5); });
        $("#friendsVery-good").on("click", function(){ filterComments(friendsComments, 4); });
        $("#friendsAverage").on("click", function(){ filterComments(friendsComments, 3); });
        $("#friendsBad").on("click", function(){ filterComments(friendsComments, 2); });
        $("#friendsAwful").on("click", function(){ filterComments(friendsComments, 1); });

        $("#alonePerfect").on("click", function(){ filterComments(aloneComments, 5); });
        $("#aloneVery-good").on("click", function(){ filterComments(aloneComments, 4); });
        $("#aloneAverage").on("click", function(){ filterComments(aloneComments, 3); });
        $("#aloneBad").on("click", function(){ filterComments(aloneComments, 2); });
        $("#aloneAwful").on("click", function(){ filterComments(aloneComments, 1); });

        $("#sortType").on("change", function(){ sortComments(nowSortedComments); });

        $("#showMoreOpinions").on("click", function(){
            setComments(nowSortedComments, 1);
            similarApartmentsTop = $('#similarApartments').offset().top;
        });

        $(".avgBars > div:not(:last-child)").on("click", function(){
            $(".avgBars > div").removeClass("selected");
            $(this).addClass("selected");
            $(".avgBars > div:last-child").show();
		});
	</script>

	<script>
        function openJourneyType(evt, JourneyType, JourneyTypeName) {
            var i, tabcontent, tablinks;
            showingCommentsAmount = 0;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(JourneyType).style.display = "block";
            evt.currentTarget.className += " active";

            $("#opinionHeader").text(JourneyTypeName);
            if (JourneyType == 'allOpinions'){
                nowSortedComments = allComments;
                sortComments(nowSortedComments);
                $("#allOpinionsAmount").text(allOpinions.opinionsAmount);
            }
            else if (JourneyType == 'familyOpinions'){
                nowSortedComments = familyComments;
                sortComments(nowSortedComments);
                $("#allOpinionsAmount").text(familyOpinions.opinionsAmount);
            }
            else if (JourneyType == 'couplesOpinions'){
                nowSortedComments = couplesComments;
                sortComments(nowSortedComments);
                $("#allOpinionsAmount").text(couplesOpinions.opinionsAmount);
            }
            else if (JourneyType == 'businessOpinions'){
                nowSortedComments = businessComments;
                sortComments(nowSortedComments);
                $("#allOpinionsAmount").text(businessOpinions.opinionsAmount);
            }
            else if (JourneyType == 'friendsOpinions'){
                nowSortedComments = friendsComments;
                sortComments(nowSortedComments);
                $("#allOpinionsAmount").text(friendsOpinions.opinionsAmount);
            }
            else if (JourneyType == 'aloneOpinions'){
                nowSortedComments = aloneComments;
                sortComments(nowSortedComments);
                $("#allOpinionsAmount").text(aloneOpinions.opinionsAmount);
            }

            $("#allOpinionsAfter").text("");
            $(".avgBars > div").removeClass("selected");
        }

        var showingJourneyTypes = 1;

		@handheld
        function openJourneyType(evt, JourneyType, JourneyTypeName) {
            var i, tabcontent, tablinks;
            showingCommentsAmount = 0;
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            tabcontent = document.getElementsByClassName("tabcontent-mobile");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            document.getElementById(JourneyType).style.display = "block";
            evt.currentTarget.className += " active";
            openJourneyTypes();

            $("#opinionHeader").text(JourneyTypeName);
            if (JourneyType == 'allOpinions'){
                nowSortedComments = allComments;
                sortComments(nowSortedComments);
                $("#allOpinionsAmount").text(allOpinions.opinionsAmount);
            }
            else if (JourneyType == 'familyOpinions'){
                nowSortedComments = familyComments;
                sortComments(nowSortedComments);
                $("#allOpinionsAmount").text(familyOpinions.opinionsAmount);
            }
            else if (JourneyType == 'couplesOpinions'){
                nowSortedComments = couplesComments;
                sortComments(nowSortedComments);
                $("#allOpinionsAmount").text(couplesOpinions.opinionsAmount);
            }
            else if (JourneyType == 'businessOpinions'){
                nowSortedComments = businessComments;
                sortComments(nowSortedComments);
                $("#allOpinionsAmount").text(businessOpinions.opinionsAmount);
            }
            else if (JourneyType == 'friendsOpinions'){
                nowSortedComments = friendsComments;
                sortComments(nowSortedComments);
                $("#allOpinionsAmount").text(friendsOpinions.opinionsAmount);
            }
            else if (JourneyType == 'aloneOpinions'){
                nowSortedComments = aloneComments;
                sortComments(nowSortedComments);
                $("#allOpinionsAmount").text(aloneOpinions.opinionsAmount);
            }

            $("#allOpinionsAfter").text("");
            $(".avgBars > div").removeClass("selected");
        }
		@endhandheld

        function openJourneyTypes(){
            if(showingJourneyTypes == 1){
                $(".tablinks:not(.active)").hide();
                $("#chooseJourneyType").text("▼");
                showingJourneyTypes = 0;
			}
			else{
                $(".tablinks:not(.display-none-permanent)").show();
                $("#chooseJourneyType").text("▲");
                showingJourneyTypes = 1;
			}
		}

        function openDefault() {
            document.getElementById("defaultOpen").click();
            @handheld document.getElementById("chooseJourneyType").click(); @endhandheld
            $(".avgBars > div:last-child").hide();
        }
        function openFamily() {
            document.getElementById("familyTab").click();
            @handheld document.getElementById("chooseJourneyType").click(); @endhandheld
            $(".avgBars > div:last-child").hide();
        }
        function openCouples() {
            document.getElementById("couplesTab").click();
            @handheld document.getElementById("chooseJourneyType").click(); @endhandheld
            $(".avgBars > div:last-child").hide();
        }
        function openBusiness() {
            document.getElementById("businessTab").click();
            @handheld document.getElementById("chooseJourneyType").click(); @endhandheld
            $(".avgBars > div:last-child").hide();
        }
        function openFriends() {
            document.getElementById("friendsTab").click();
            @handheld document.getElementById("chooseJourneyType").click(); @endhandheld
            $(".avgBars > div:last-child").hide();
        }
        function openAlone() {
            document.getElementById("aloneTab").click();
            @handheld document.getElementById("chooseJourneyType").click(); @endhandheld
            $(".avgBars > div:last-child").hide();
        }

        function increaseHelpful(opinionId){

            $.ajax({
                type: "GET",
                url: '/increaseHelpful',
                dataType : 'json',
                data: {
                    opinionId: opinionId,
                },
                success: function(responseMessage) {
                    alert(responseMessage);
                },
                error: function() {
                    console.log( "Error in connection with controller");
                },
            });
        }


        // Get the element with id="defaultOpen" and click on it
        document.getElementById("defaultOpen").click();

        function expandOpinions(opinionId){

            if($("#expanded-"+opinionId).css('display') == 'none'){
                $("#expanded-"+opinionId).show();
                $("#expanded-date-"+opinionId).show();
                $("#"+opinionId).text('zwiń ▲');
            }
            else {
                $("#"+opinionId).text('rozwiń ▼');
                $("#expanded-"+opinionId).hide();
                $("#expanded-date-"+opinionId).hide();
            }

		}

	</script>
@endif {{--end if there is no comments--}}

@if($favouritesAmount == 0 && Auth::check())
	@include('includes.favourites-first-added-popup')
@endif

	<script>
        $(".send-news-friends").click(function() {
            $("#send-news").show();
            $("#send-to").hide();
            if($("#truncate-favourites").css("display") != "none") $("#truncate-favourites").hide();
        });

        $(".close-send-news-friends").click(function() {
            $("#send-news").hide();
        });

        $(".close-confirm-news").click(function() {
            $("#confirm-send-news-friends").hide();
        });

        function copyToClipboard(element) {
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val($(element).text()).select();
            document.execCommand("copy");
            $temp.remove();
        }

        $("#send-mail-with-news").on('click', function(){
            sendMailWithNews();
        });

        function sendMailWithNews(){

            mailWithNewsSended();

            $.ajax({
                type: "GET",
                url: '/send-news-to-friends',
                dataType : 'json',
                data: {
                    emails2: $("#emails2").val(),
                    link: $("#link").val(),
                },
                success: function() {
                    //
                },
                error: function(data) {
                    console.log(data);
                },
            });
        }

        function mailWithNewsSended(){
            $('#send-news').hide();
            $('#confirm-send-news-friends').show();
        }
	</script>

@endsection