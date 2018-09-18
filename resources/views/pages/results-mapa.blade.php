@extends ('pages.results')
@section ('displayResults')
    <div class="row d-xl-none" style="margin-bottom: 20px">
        <div class="col-9 text-mobile-search">
            <a href="{{ route('index') }}" style="color: #00afea">Start > </a>@if(isset($request->region) && (ucfirst($request->region) == 'Zakopane' || ucfirst($request->region) == 'Kościelisko' || ucfirst($request->region) == 'Witów'))<b>{{ $request->region }},</b>@endif {{__('messages.from')}} {{ $_GET['t-start'] }}, {{__('messages.number of nights')}}: {{ $nightsCounter }}, {{__('messages.Persons')}}: {{ $_GET['dorosli']+$_GET['dzieci'] }} {{--__('messages.Filters')--}}
        </div>
        <div class="col-3">
            <div  style="position: absolute; right:10px;"><a  class="btn btn-info btn-mobile filters-toggle">{{__('messages.change')}} </a></div>
        </div>
        @handheld
        @include('includes.filters-mobile')
        @endhandheld
    </div>
        </form>


            <div class="row">
                <div class="col-8"><h1 class="pb-2" style="display: inline; font-size: 24px">@if(isset($request->region) && (ucfirst($request->region) == 'Zakopane' || ucfirst($request->region) == 'Kościelisko' || ucfirst($request->region) == 'Witów')){{ $request->region }}@endif<span class="d-xl-none">({{ $countedApartaments }})</span></h1><span class="pb-2 d-none d-xl-inline"> ({{ $countedApartaments }} {{trans_choice('messages.apartaments', $countedApartaments)}})</span></div>
                <div class="col-4 inline-wrapper text-right d-xl-none"> <div style="position: absolute; right:10px;"   class="btn-group"><a class="btn btn-mobile" href="/search/kafle?{{ http_build_query(Request::except('page')) }}">{{__('messages.Offers')}}</a><a class="btn btn-info btn-mobile btn-selected" href="/search/mapa?{{ http_build_query(Request::except('page')) }}">{{__('messages.Map')}}</a></div></div>
                <div class="col-4 inline-wrapper text-right d-none d-xl-block"> <a class="btn" href="/search/kafle?{{ http_build_query(Request::except('page')) }}"><img data-toggle="tooltip" data-placement="bottom" title="Kafle" alt="Kafle" src='{{ asset("images/results/kafle.png") }}'></a> <a class="btn" href="/search/lista?{{ http_build_query(Request::except('page')) }}"><img data-toggle="tooltip" data-placement="bottom" title="Lista" alt="Lista" src='{{ asset("images/results/lista.png") }}'></a> <a class="btn" href="/search/mapa?{{ http_build_query(Request::except('page')) }}"><img class="active" data-toggle="tooltip" data-placement="bottom" title="Mapa" alt="Mapa" src='{{ asset("images/results/mapa.png") }}'></a></div>
            </div>
            <div class="row" style="margin-top: 20px" itemscope itemtype="http://schema.org/Hotel">
                <div id="mapka" style="width: 100%; height: 500px; margin-bottom: 30px;" itemprop="hasMap"></div>
            </div>
@if(\App::environment('production'))
<script src="https://maps.google.com/maps/api/js?key=AIzaSyBBEtTo5au09GsH6EvJhj1R_uc0BpTLVaw" type="text/javascript"></script>
@else
<script src="http://maps.google.com/maps/api/js?key=AIzaSyBBEtTo5au09GsH6EvJhj1R_uc0BpTLVaw" type="text/javascript"></script>
@endif
		<script type="text/javascript">

		var mapa;
		var dymek = new google.maps.InfoWindow(); // zmienna globalna
		var greenMarkers = [];
                var blackMarkers = [];
                var grayMarkers = [];

		function dodajZielonyMarkerKompleks(lat, lng, txt, ikona, liczbaApartamentow)
		{
			var opcjeMarkera =
			{
				position: new google.maps.LatLng(lat,lng),
				map: mapa,
                icon: ikona,
                label: {
                    text: ""+liczbaApartamentow,
                    color: "#ffffff",
                    fontWeight: "bold",
                },
			}
			var marker = new google.maps.Marker(opcjeMarkera);
			marker.txt=txt;

                google.maps.event.addListener(marker,"click",function()
			{
				dymek.setContent(marker.txt);
				dymek.open(mapa,marker);
			});

                        greenMarkers.push(marker);
			return marker;
		}

		function dodajZielonyMarker(lat,lng,txt, ikona)
		{
			var opcjeMarkera =
			{
				position: new google.maps.LatLng(lat,lng),
				map: mapa,
                icon: ikona,
			}
			var marker = new google.maps.Marker(opcjeMarkera);
			marker.txt=txt;

                        google.maps.event.addListener(marker,"click",function()
			{
				dymek.setContent(marker.txt);
				dymek.open(mapa,marker);
			});

                        greenMarkers.push(marker);
			return marker;
		}

        function dodajCzarnyMarkerKompleks(lat, lng, txt, ikona, liczbaApartamentow)
        {
            var opcjeMarkera =
                {
                    position: new google.maps.LatLng(lat,lng),
                    map: mapa,
                    icon: ikona,
                    label: {
                        text: ""+liczbaApartamentow,
                        color: "#ffffff",
                        fontWeight: "bold",
                    },
                }
            var marker = new google.maps.Marker(opcjeMarkera);
            marker.txt=txt;

            google.maps.event.addListener(marker,"click",function()
            {
                dymek.setContent(marker.txt);
                dymek.open(mapa,marker);
            });

            blackMarkers.push(marker);
            return marker;
        }

		function dodajCzarnyMarker(lat,lng,txt, ikona)
		{
			var opcjeMarkera =
			{
				position: new google.maps.LatLng(lat,lng),
				map: mapa,
                                icon: ikona
			}
			var marker = new google.maps.Marker(opcjeMarkera);
			marker.txt=txt;

                        google.maps.event.addListener(marker,"click",function()
			{
				dymek.setContent(marker.txt);
				dymek.open(mapa,marker);
			});

                        blackMarkers.push(marker);
			return marker;
		}

        function dodajSzaryMarkerKompleks(lat, lng, txt, ikona, liczbaApartamentow)
        {
            var opcjeMarkera =
                {
                    position: new google.maps.LatLng(lat,lng),
                    map: mapa,
                    icon: ikona,
                    label: {
                        text: ""+liczbaApartamentow,
                        color: "#ffffff",
                        fontWeight: "bold",
                    },
                }
            var marker = new google.maps.Marker(opcjeMarkera);
            marker.txt=txt;

            google.maps.event.addListener(marker,"click",function()
            {
                dymek.setContent(marker.txt);
                dymek.open(mapa,marker);
            });

            grayMarkers.push(marker);
            return marker;
        }

		function dodajSzaryMarker(lat,lng,txt, ikona)
		{
			var opcjeMarkera =
			{
				position: new google.maps.LatLng(lat,lng),
				map: mapa,
                                icon: ikona
			}
			var marker = new google.maps.Marker(opcjeMarkera);
			marker.txt=txt;

                        google.maps.event.addListener(marker,"click",function()
			{
				dymek.setContent(marker.txt);
				dymek.open(mapa,marker);
			});

                        grayMarkers.push(marker);
			return marker;
		}

		function mapaStart()
		{
			var wspolrzedne = new google.maps.LatLng({{$coordinates}});
                        var greenIcon = new google.maps.MarkerImage('{{ asset("images/map/u3576.png") }}');
                        var blackIcon = new google.maps.MarkerImage('{{ asset("images/map/u3586.png") }}');
                        var grayIcon = new google.maps.MarkerImage('{{ asset("images/map/u3579.png") }}');

			var opcjeMapy = {
			  zoom: 13,
			  center: wspolrzedne,
              fullscreenControl: false,
			  mapTypeId: google.maps.MapTypeId.ROADMAP,
              mapTypeControl: false,
			};

            mapa = new google.maps.Map(document.getElementById("mapka"), opcjeMapy);

                        mapLegend = document.createElement('mapLegend');
                        mapLegend.innerHTML = '<div class="mapLegend"><span class="mapToggle"><label><input style="visibility:hidden" type="checkbox"><img src="{{ asset('images/map/u3576.png') }}"><div style="float: right">{{ __("messages.Satisfying") }} <br>{{ __("messages.criteria and dates") }}</div></label><label class="map-legend-button"><img src="{{ asset('images/map/u3586.png') }}"><input type="checkbox" name="notMeetCriteria" onchange="blackCheckbox()"><div style="float: right">{{ __("messages.Do not meet") }} <br>{{ __("messages.criteria") }}</div></label> <label class="map-legend-button"><img src="{{ asset('images/map/u3579.png') }}"><input type="checkbox" name="notAvailable" onchange="grayCheckbox()"><div style="float: right; margin-right: 5px">{{ __("messages.Not available") }} <br>{{ __("messages.on this date") }}</div></label></span><span id="btn-map-toggle" class="map-legend-toggle" onclick=mapToggle()><i style="font-size:16px; font-weight: bold" class="fa">&#xf101;</i></span></div></div>';

                        /* Push Legend to Right Top */
                        mapa.controls[google.maps.ControlPosition.RIGHT_TOP].push(mapLegend);
                    @foreach ($finds as $apartament)
                        @if($apartament->group_id > 0 && $apartament->group_name != NULL)
                            var marker1 = dodajZielonyMarkerKompleks( {{ $apartament->apartament_geo_lat }}, {{ $apartament->apartament_geo_lan }},'<div class="map-img-wrapper greenIcon"><a class="desktop-none" href="/apartaments-group/{{ $apartament->group_link }}?{{ http_build_query(Request::except("page", "region", "_token")) }}"><img style="width: 210px; height: 112px"src="{{ asset("images/apartaments_group/$apartament->group_id/main.jpg") }}"></a><img class="mobile-none" style="width: 255px; height: 176px"src="{{ asset("images/apartaments_group/$apartament->group_id/main.jpg") }}"><div class="map-see-more"><div class="container py-1"></div><div class="container py-1"><a href="/apartaments-group/{{ $apartament->group_link }}?{{ http_build_query(Request::except("page", "region", "_token")) }}" class="btn btn-see-more mobile-none" style="width: 100%">{{ __("messages.see details") }}</a></div></div><div class="map-description-top">{{ $apartament->min_price }} PLN</div> <div class="map-count">{{ $apartament->apartaments_amount }} {{trans_choice("messages.nrApartmentsInKomplex", $apartament->apartaments_amount)}}</div> <div class="map-description-bottom">{{ __("messages.Breakfast included") }}</div></div><span class="map-description"><span style="font-size: 17px; display: inline-block">{{ $apartament->group_name }}</span>@if($apartament->apartament_district != null)<br> <span style="font-size: 11px; display: inline-block">{{ $apartament->apartament_district }}</span>@endif<br> <span style="font-size: 11px; display: inline-block" itemprop="streetAddress">{{ $apartament->apartament_address }}</span><div><div class="description-below-img" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.people') }}" style="background-image: url({{ asset('images/results/person.png') }})"> <span>{{ $apartament->apartament_persons }}</span></div><div class="description-below-img mobile-none" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.double beds') }}" style="background-image: url({{ asset("images/results/doubleBed.png") }});"><span>{{ $apartament->apartament_double_beds }}</span></div><div class="description-below-img" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.single beds') }}" style="background-image: url({{ asset("images/results/bed.png") }});"><span>{{ $apartament->apartament_single_beds+$apartament->apartament_double_beds }}</span></div>@if($apartament->ratingAvg < 4.5)<div class="description-below-img d-xl-none note" style="background-color: red"><span>{{number_format($apartament->ratingAvg, 1, ",", "")}}</span></div>@elseif($apartament->ratingAvg < 6.5)<div class="description-below-img d-xl-none note" style="background-color: yellow;"><span style="color: black">{{number_format($apartament->ratingAvg, 1, ",", "")}}</span></div>@else<div class="description-below-img d-xl-none note" style="background-color: green"><span>{{number_format($apartament->ratingAvg, 1, ",", "")}}}</span></div>@endif<div class="desktop-none description-below-notes">({{$apartament->opinionAmount ?? 0}} {{ __("messages.reviews") }})</div>@if ( $apartament->apartament_wifi == 1)<div class="description-below-img mobile-none" data-toggle="tooltip" data-placement="bottom" title="Wifi" style="background-image: url({{ asset("images/results/wifi.png") }});"></div>@endif @if ( $apartament->apartament_parking == 1) <div class="description-below-img mobile-none" data-toggle="tooltip" data-placement="bottom" title="Parking" style="background-image: url({{ asset("images/results/parking.png") }});"> </div> @endif</div><div class="description-map-bottom-right d-none d-xl-block">@for ($i = 0; $i < floor($apartament->ratingAvg/2); $i++)<img src="{{ asset("images/results/star.png") }}">@endfor @if(floor($apartament->ratingAvg/2) != ceil($apartament->ratingAvg/2))<img src="{{ asset("images/results/star_half.png") }}">@endif @for ($i = ceil($apartament->ratingAvg/2); $i < 5; $i++)<img src="{{ asset("images/results/star_empty.png") }}">@endfor<br>@if($apartament->ratingAvg < 1)<span class="opinion-to-left" style="margin-right: 10px;"></span>@elseif($apartament->ratingAvg < 2.5)<span class="opinion-to-left txt-red" style="margin-right: 10px;">{{ __("messages.Awful") }}</span>@elseif($apartament->ratingAvg < 4.5)<span class="opinion-to-left txt-red" style="margin-right: 10px;">{{ __("messages.Bad") }}</span>@elseif($apartament->ratingAvg < 6.5)<span class="opinion-to-left txt-yellow" style="margin-right: 10px;">{{ __("messages.Average") }}</span>@elseif($apartament->ratingAvg < 8.5)<span class="opinion-to-left txt-green" style="margin-right: 10px;">{{ __("messages.Very good") }}</span>@else<span class="opinion-to-left txt-green" style="margin-right: 10px;">{{ __("messages.Perfect") }}</span>@endif<span class="txt-blue nr-reviews-right">{{$apartament->opinionAmount ?? 0}} {{trans_choice("messages.nrReviews", $apartament->opinionAmount ?? 0)}}</span></div></span>', greenIcon, {{ $apartament->apartaments_amount }});
                            @mobile
                            google.maps.event.addListener(marker1, 'click', function() {
                                mapa.panTo(new google.maps.LatLng({{ $apartament->apartament_geo_lat+0.03 }}, {{ $apartament->apartament_geo_lan }}));
                            });
                            @endmobile
                        @endif
                    @endforeach
            {{--@foreach($findsWithoutGroup as $apartament)
            var marker1 = dodajZielonyMarker( {{ $apartament->apartament_geo_lat }}, {{ $apartament->apartament_geo_lan }},'<div class="map-img-wrapper greenIcon"><a class="desktop-none" href="/apartaments/{{ $apartament->apartament_link }}" ><img style="width: 210px; height: 112px"src="{{ asset("images/apartaments/$apartament->id/main.jpg") }}"></a><img class="mobile-none" style="width: 255px; height: 176px"src="{{ asset("images/apartaments/$apartament->id/main.jpg") }}"><div class="map-see-more"><div class="container py-1"><a href="/apartaments-group/{{ $apartament->group_link }}"  style="width: 100%" class="btn btn-primary mobile-none">{{ __("messages.book") }}</a></div><div class="container py-1"><a href="/apartaments/{{ $apartament->apartament_link }}" class="btn btn-see-more mobile-none" style="width: 100%">{{ __("messages.see details") }}</a></div></div><div class="map-description-top">{{ $apartament->min_price }} PLN</div></div><span class="map-description"><span style="font-size: 17px; display: inline-block">{{ $apartament->apartament_name }}</span>@if($apartament->apartament_district != null)<br> <span style="font-size: 11px; display: inline-block">{{ $apartament->apartament_district }}</span>@endif<br> <span style="font-size: 11px; display: inline-block" itemprop="streetAddress">{{ $apartament->apartament_address }}</span><div><div class="description-below-img" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.people') }}" style="background-image: url({{ asset('images/results/person.png') }})"> <span>{{ $apartament->apartament_persons }}</span></div><div class="description-below-img mobile-none" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.double beds') }}" style="background-image: url({{ asset("images/results/doubleBed.png") }});"><span>{{ $apartament->apartament_double_beds }}</span></div><div class="description-below-img" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.single beds') }}" style="background-image: url({{ asset("images/results/bed.png") }});"><span>{{ $apartament->apartament_single_beds+$apartament->apartament_double_beds }}</span></div>@if($apartament->ratingAvg < 1) <div class="description-below-img desktop-none note"></div> @elseif($apartament->ratingAvg < 2.5) <div style="background-color: #ff2620" class="description-below-img desktop-none note"><span>{{ number_format($apartament->ratingAvg, 1, ',', ' ') }}</span></div> @elseif($apartament->ratingAvg < 4.5) <div style="background-color: #ff2620" class="description-below-img desktop-none note"><span>{{ number_format($apartament->ratingAvg, 1, ',', ' ') }}</span></div> @elseif($apartament->ratingAvg < 6.5) <div style="background-color: #ddc100;" class="description-below-img desktop-none note"><span style="color: black">{{ number_format($apartament->ratingAvg, 1, ',', ' ') }}</span></div> @elseif($apartament->ratingAvg < 8.5) <div style="background-color: #1c7430" class="description-below-img desktop-none note"><span>{{ number_format($apartament->ratingAvg, 1, ',', ' ') }}</span></div> @else <div style="background-color: #1c7430" class="description-below-img desktop-none note"><span>{{ number_format($apartament->ratingAvg, 1, ',', ' ') }}</span></div> @endif<div class="desktop-none description-below-notes">({{$apartament->opinionAmount ?? 0}} {{ __("messages.reviews") }})</div>@if ( $apartament->apartament_wifi == 1)<div class="description-below-img mobile-none" data-toggle="tooltip" data-placement="bottom" title="Wifi" style="background-image: url({{ asset("images/results/wifi.png") }});"></div>@endif @if ( $apartament->apartament_parking == 1) <div class="description-below-img mobile-none" data-toggle="tooltip" data-placement="bottom" title="Parking" style="background-image: url({{ asset("images/results/parking.png") }});"> </div> @endif</div><div class="description-map-bottom-right mobile-none">@for ($i = 0; $i < floor($apartament->ratingAvg/2); $i++) <img src="{{ asset("images/results/star.png") }}"> @endfor @if(floor($apartament->ratingAvg/2) != ceil($apartament->ratingAvg/2)) <img src="{{ asset("images/results/star_half.png") }}"> @endif @for ($i = ceil($apartament->ratingAvg/2); $i < 5; $i++) <img src="{{ asset("images/results/star_empty.png") }}"> @endfor <br> @if($apartament->ratingAvg < 1) <span class="opinion-to-left" style="margin-right: 10px;"></span> @elseif($apartament->ratingAvg < 2.5) <span class="opinion-to-left txt-red" style="margin-right: 10px;">{{ __("messages.Awful") }}</span> @elseif($apartament->ratingAvg < 4.5) <span class="opinion-to-left txt-red" style="margin-right: 10px;">{{ __("messages.Bad") }}</span> @elseif($apartament->ratingAvg < 6.5) <span class="opinion-to-left txt-yellow" style="margin-right: 10px;">{{ __("messages.Average") }}</span> @elseif($apartament->ratingAvg < 8.5) <span class="opinion-to-left txt-green" style="margin-right: 10px;">{{ __("messages.Very good") }}</span> @else <span class="opinion-to-left txt-green" style="margin-right: 10px;">{{ __("messages.Perfect") }}</span> @endif <span class="txt-blue nr-reviews-right">{{$apartament->opinionAmount ?? 0}} {{trans_choice('messages.nrReviews', $apartament->opinionAmount ?? 0)}}</span></div></span>', greenIcon);
                        @mobile
            google.maps.event.addListener(marker1, 'click', function() {
                mapa.panTo(new google.maps.LatLng({{ $apartament->apartament_geo_lat+0.03 }}, {{ $apartament->apartament_geo_lan }}));
            });
                        @endmobile
                    @endforeach
            --}}
                    @foreach ($blackGroups as $apartament)
                        var marker2 = dodajCzarnyMarkerKompleks( {{ $apartament->apartament_geo_lat }}, {{ $apartament->apartament_geo_lan }},'<div class="map-img-wrapper greenIcon"><a class="desktop-none" href="/apartaments-group/{{ $apartament->group_link }}?{{ http_build_query(Request::except("page", "region", "_token")) }}"><img style="width: 210px; height: 112px"src="{{ asset("images/apartaments_group/$apartament->group_id/main.jpg") }}"></a><img class="mobile-none" style="width: 255px; height: 176px"src="{{ asset("images/apartaments_group/$apartament->group_id/main.jpg") }}"><div class="map-see-more"><div class="container py-1"></div><div class="container py-1"><a href="/apartaments-group/{{ $apartament->group_link }}?{{ http_build_query(Request::except("page", "region", "_token")) }}" class="btn btn-see-more mobile-none" style="width: 100%">{{ __("messages.see details") }}</a></div></div><div class="map-description-top">{{ $apartament->min_price }} PLN</div> <div class="map-count">{{ $apartament->apartaments_amount }} {{trans_choice("messages.nrApartmentsInKomplex", $apartament->apartaments_amount)}}</div> <div class="map-description-bottom">{{ __("messages.Breakfast included") }}</div></div><span class="map-description"><span style="font-size: 17px; display: inline-block">{{ $apartament->group_name }}</span>@if($apartament->apartament_district != null)<br> <span style="font-size: 11px; display: inline-block">{{ $apartament->apartament_district }}</span>@endif<br> <span style="font-size: 11px; display: inline-block" itemprop="streetAddress">{{ $apartament->apartament_address }}</span><div><div class="description-below-img" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.people') }}" style="background-image: url({{ asset('images/results/person.png') }})"> <span>{{ $apartament->apartament_persons }}</span></div><div class="description-below-img mobile-none" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.double beds') }}" style="background-image: url({{ asset("images/results/doubleBed.png") }});"><span>{{ $apartament->apartament_double_beds }}</span></div><div class="description-below-img" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.single beds') }}" style="background-image: url({{ asset("images/results/bed.png") }});"><span>{{ $apartament->apartament_single_beds+$apartament->apartament_double_beds }}</span></div>@if($apartament->ratingAvg < 4.5)<div class="description-below-img d-xl-none note" style="background-color: red"><span>{{number_format($apartament->ratingAvg, 1, ",", "")}}</span></div>@elseif($apartament->ratingAvg < 6.5)<div class="description-below-img d-xl-none note" style="background-color: yellow;"><span style="color: black">{{number_format($apartament->ratingAvg, 1, ",", "")}}</span></div>@else<div class="description-below-img d-xl-none note" style="background-color: green"><span>{{number_format($apartament->ratingAvg, 1, ",", "")}}}</span></div>@endif<div class="desktop-none description-below-notes">({{$apartament->opinionAmount ?? 0}} {{ __("messages.reviews") }})</div>@if ( $apartament->apartament_wifi == 1)<div class="description-below-img mobile-none" data-toggle="tooltip" data-placement="bottom" title="Wifi" style="background-image: url({{ asset("images/results/wifi.png") }});"></div>@endif @if ( $apartament->apartament_parking == 1) <div class="description-below-img mobile-none" data-toggle="tooltip" data-placement="bottom" title="Parking" style="background-image: url({{ asset("images/results/parking.png") }});"> </div> @endif</div><div class="description-map-bottom-right d-none d-xl-block">@for ($i = 0; $i < floor($apartament->ratingAvg/2); $i++)<img src="{{ asset("images/results/star.png") }}">@endfor @if(floor($apartament->ratingAvg/2) != ceil($apartament->ratingAvg/2))<img src="{{ asset("images/results/star_half.png") }}">@endif @for ($i = ceil($apartament->ratingAvg/2); $i < 5; $i++)<img src="{{ asset("images/results/star_empty.png") }}">@endfor<br>@if($apartament->ratingAvg < 1)<span class="opinion-to-left" style="margin-right: 10px;"></span>@elseif($apartament->ratingAvg < 2.5)<span class="opinion-to-left txt-red" style="margin-right: 10px;">{{ __("messages.Awful") }}</span>@elseif($apartament->ratingAvg < 4.5)<span class="opinion-to-left txt-red" style="margin-right: 10px;">{{ __("messages.Bad") }}</span>@elseif($apartament->ratingAvg < 6.5)<span class="opinion-to-left txt-yellow" style="margin-right: 10px;">{{ __("messages.Average") }}</span>@elseif($apartament->ratingAvg < 8.5)<span class="opinion-to-left txt-green" style="margin-right: 10px;">{{ __("messages.Very good") }}</span>@else<span class="opinion-to-left txt-green" style="margin-right: 10px;">{{ __("messages.Perfect") }}</span>@endif<span class="txt-blue nr-reviews-right">{{$apartament->opinionAmount ?? 0}} {{trans_choice("messages.nrReviews", $apartament->opinionAmount ?? 0)}}</span></div></span>', blackIcon, {{ $apartament->apartaments_amount }});
                        @mobile
                        google.maps.event.addListener(marker2, 'click', function() {
                            mapa.panTo(new google.maps.LatLng({{ $apartament->apartament_geo_lat+0.03 }}, {{ $apartament->apartament_geo_lan }}));
                        });
                        @endmobile
                        @endforeach
                    @foreach ($black as $apartament)
                        var marker2 = dodajCzarnyMarker( {{ $apartament->apartament_geo_lat }}, {{ $apartament->apartament_geo_lan }},'<div class="map-img-wrapper greenIcon"><a class="desktop-none" href="/apartaments/{{ $apartament->apartament_link }}"><img style="width: 210px; height: 112px"src="{{ asset("images/apartaments/$apartament->id/main.jpg") }}"></a><img class="mobile-none" style="width: 255px; height: 176px"src="{{ asset("images/apartaments/$apartament->id/main.jpg") }}"><div class="map-see-more"><div class="container py-1"><a href="/apartaments/{{ $apartament->apartament_link }}" class="btn btn-see-more mobile-none" style="width: 100%">{{ __("messages.see details") }}</a></div></div><div class="map-description-top">199 PLN</div> <div class="map-description-bottom">{{ __("messages.Breakfast included") }}</div><div class="add-to-favourities"><span data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Add to favorites') }}" onClick="addToFavourites({{$apartament->id}}, {{Auth::user()->id ?? 0}})"><img src="{{ asset('images/results/heart.png') }}"></span></div></div><span class="map-description"><span style="font-size: 17px; display: inline-block">{{ $apartament->apartament_name }}</span>@if($apartament->apartament_district != null)<br> <span style="font-size: 11px; display: inline-block">{{ $apartament->apartament_district }}</span>@endif<br> <span style="font-size: 11px; display: inline-block">{{ $apartament->apartament_address }}</span><div><div class="description-below-img" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.people') }}" style="background-image: url({{ asset('images/results/person.png') }})"> <span>{{ $apartament->apartament_persons }}</span></div><div class="description-below-img mobile-none" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.double beds') }}" style="background-image: url({{ asset("images/results/doubleBed.png") }});"><span>{{ $apartament->apartament_double_beds }}</span></div><div class="description-below-img" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.single beds') }}" style="background-image: url({{ asset("images/results/bed.png") }});"><span>{{ $apartament->apartament_single_beds+$apartament->apartament_double_beds }}</span></div><div class="description-below-img desktop-none note" style="background-color: green"><span>4,5</span></div><div class="desktop-none description-below-notes">(23 {{ __("messages.reviews") }})</div>@if ( $apartament->apartament_wifi == 1)<div class="description-below-img mobile-none" data-toggle="tooltip" data-placement="bottom" title="Wifi" style="background-image: url({{ asset("images/results/wifi.png") }});"></div>@endif @if ( $apartament->apartament_parking == 1) <div class="description-below-img mobile-none" data-toggle="tooltip" data-placement="bottom" title="Parking" style="background-image: url({{ asset("images/results/parking.png") }});"> </div> @endif</div><div class="description-map-bottom-right d-none d-xl-block">@for ($i = 0; $i < floor($apartament->ratingAvg/2); $i++)<img src="{{ asset("images/results/star.png") }}">@endfor @if(floor($apartament->ratingAvg/2) != ceil($apartament->ratingAvg/2))<img src="{{ asset("images/results/star_half.png") }}">@endif @for ($i = ceil($apartament->ratingAvg/2); $i < 5; $i++)<img src="{{ asset("images/results/star_empty.png") }}">@endfor<br>@if($apartament->ratingAvg < 1)<span class="opinion-to-left" style="margin-right: 10px;"></span>@elseif($apartament->ratingAvg < 2.5)<span class="opinion-to-left txt-red" style="margin-right: 10px;">{{ __("messages.Awful") }}</span>@elseif($apartament->ratingAvg < 4.5)<span class="opinion-to-left txt-red" style="margin-right: 10px;">{{ __("messages.Bad") }}</span>@elseif($apartament->ratingAvg < 6.5)<span class="opinion-to-left txt-yellow" style="margin-right: 10px;">{{ __("messages.Average") }}</span>@elseif($apartament->ratingAvg < 8.5)<span class="opinion-to-left txt-green" style="margin-right: 10px;">{{ __("messages.Very good") }}</span>@else<span class="opinion-to-left txt-green" style="margin-right: 10px;">{{ __("messages.Perfect") }}</span>@endif<span class="txt-blue nr-reviews-right">{{$apartament->opinionAmount ?? 0}} {{trans_choice("messages.nrReviews", $apartament->opinionAmount ?? 0)}}</span></div></span>', blackIcon);
                        @mobile
                        google.maps.event.addListener(marker2, 'click', function() {
                            mapa.panTo(new google.maps.LatLng({{ $apartament->apartament_geo_lat+0.03 }}, {{ $apartament->apartament_geo_lan }}));
                        });
                        @endmobile
                    @endforeach
                    @foreach ($grayGroups as $apartament)
                        var marker3 = dodajSzaryMarkerKompleks( {{ $apartament->apartament_geo_lat }}, {{ $apartament->apartament_geo_lan }},'<div class="map-img-wrapper greenIcon"><a class="desktop-none" href="/apartaments-group/{{ $apartament->group_link }}?{{ http_build_query(Request::except("page", "region", "_token")) }}"><img style="width: 210px; height: 112px"src="{{ asset("images/apartaments_group/$apartament->group_id/main.jpg") }}"></a><img class="mobile-none" style="width: 255px; height: 176px"src="{{ asset("images/apartaments_group/$apartament->group_id/main.jpg") }}"><div class="map-see-more"><div class="container py-1"></div><div class="container py-1"><a href="/apartaments-group/{{ $apartament->group_link }}?{{ http_build_query(Request::except("page", "region", "_token")) }}" class="btn btn-see-more mobile-none" style="width: 100%">{{ __("messages.see details") }}</a></div></div><div class="map-description-top">{{ $apartament->min_price }} PLN</div> <div class="map-count">{{ $apartament->apartaments_amount }} {{trans_choice("messages.nrApartmentsInKomplex", $apartament->apartaments_amount)}}</div> <div class="map-description-bottom">{{ __("messages.Breakfast included") }}</div></div><span class="map-description"><span style="font-size: 17px; display: inline-block">{{ $apartament->group_name }}</span>@if($apartament->apartament_district != null)<br> <span style="font-size: 11px; display: inline-block">{{ $apartament->apartament_district }}</span>@endif<br> <span style="font-size: 11px; display: inline-block" itemprop="streetAddress">{{ $apartament->apartament_address }}</span><div><div class="description-below-img" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.people') }}" style="background-image: url({{ asset('images/results/person.png') }})"> <span>{{ $apartament->apartament_persons }}</span></div><div class="description-below-img mobile-none" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.double beds') }}" style="background-image: url({{ asset("images/results/doubleBed.png") }});"><span>{{ $apartament->apartament_double_beds }}</span></div><div class="description-below-img" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.single beds') }}" style="background-image: url({{ asset("images/results/bed.png") }});"><span>{{ $apartament->apartament_single_beds+$apartament->apartament_double_beds }}</span></div>@if($apartament->ratingAvg < 4.5)<div class="description-below-img d-xl-none note" style="background-color: red"><span>{{number_format($apartament->ratingAvg, 1, ",", "")}}</span></div>@elseif($apartament->ratingAvg < 6.5)<div class="description-below-img d-xl-none note" style="background-color: yellow;"><span style="color: black">{{number_format($apartament->ratingAvg, 1, ",", "")}}</span></div>@else<div class="description-below-img d-xl-none note" style="background-color: green"><span>{{number_format($apartament->ratingAvg, 1, ",", "")}}}</span></div>@endif<div class="desktop-none description-below-notes">({{$apartament->opinionAmount ?? 0}} {{ __("messages.reviews") }})</div>@if ( $apartament->apartament_wifi == 1)<div class="description-below-img mobile-none" data-toggle="tooltip" data-placement="bottom" title="Wifi" style="background-image: url({{ asset("images/results/wifi.png") }});"></div>@endif @if ( $apartament->apartament_parking == 1) <div class="description-below-img mobile-none" data-toggle="tooltip" data-placement="bottom" title="Parking" style="background-image: url({{ asset("images/results/parking.png") }});"> </div> @endif</div><div class="description-map-bottom-right d-none d-xl-block">@for ($i = 0; $i < floor($apartament->ratingAvg/2); $i++)<img src="{{ asset("images/results/star.png") }}">@endfor @if(floor($apartament->ratingAvg/2) != ceil($apartament->ratingAvg/2))<img src="{{ asset("images/results/star_half.png") }}">@endif @for ($i = ceil($apartament->ratingAvg/2); $i < 5; $i++)<img src="{{ asset("images/results/star_empty.png") }}">@endfor<br>@if($apartament->ratingAvg < 1)<span class="opinion-to-left" style="margin-right: 10px;"></span>@elseif($apartament->ratingAvg < 2.5)<span class="opinion-to-left txt-red" style="margin-right: 10px;">{{ __("messages.Awful") }}</span>@elseif($apartament->ratingAvg < 4.5)<span class="opinion-to-left txt-red" style="margin-right: 10px;">{{ __("messages.Bad") }}</span>@elseif($apartament->ratingAvg < 6.5)<span class="opinion-to-left txt-yellow" style="margin-right: 10px;">{{ __("messages.Average") }}</span>@elseif($apartament->ratingAvg < 8.5)<span class="opinion-to-left txt-green" style="margin-right: 10px;">{{ __("messages.Very good") }}</span>@else<span class="opinion-to-left txt-green" style="margin-right: 10px;">{{ __("messages.Perfect") }}</span>@endif<span class="txt-blue nr-reviews-right">{{$apartament->opinionAmount ?? 0}} {{trans_choice("messages.nrReviews", $apartament->opinionAmount ?? 0)}}</span></div></span>', grayIcon, {{ $apartament->apartaments_amount }});
                        @mobile
                        google.maps.event.addListener(marker3, 'click', function() {
                            mapa.panTo(new google.maps.LatLng({{ $apartament->apartament_geo_lat+0.03 }}, {{ $apartament->apartament_geo_lan }}));
                        });
                        @endmobile
                    @endforeach
                    @foreach ($gray as $apartament)
                        var marker3 = dodajSzaryMarker( {{ $apartament->apartament_geo_lat }}, {{ $apartament->apartament_geo_lan }},'<div class="map-img-wrapper greenIcon"><a class="desktop-none" href="/apartaments/{{ $apartament->apartament_link }}"><img style="width: 210px; height: 112px"src="{{ asset("images/apartaments/$apartament->id/main.jpg") }}"></a><img class="mobile-none" style="width: 255px; height: 176px"src="{{ asset("images/apartaments/$apartament->id/main.jpg") }}"><div class="map-see-more"><div class="container py-1"><a href="/apartaments/{{ $apartament->apartament_link }}" style="width: 100%" class="btn btn-primary mobile-none">{{ __("messages.book") }}</a></div><div class="container py-1"><a href="/apartaments/{{ $apartament->apartament_link }}" class="btn btn-primary mobile-none" style="width: 100%">{{ __("messages.see details") }}</a></div></div><div class="map-description-top">199 PLN</div> <div class="map-description-bottom">{{ __("messages.Breakfast included") }}</div><div class="add-to-favourities"><span data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Add to favorites') }}" onClick="addToFavourites({{$apartament->id}}, {{Auth::user()->id ?? 0}})"><img src="{{ asset('images/results/heart.png') }}"></span></div></div><span class="map-description"><span style="font-size: 17px; display: inline-block">{{ $apartament->apartament_name }}</span>@if($apartament->apartament_district != null)<br> <span style="font-size: 11px; display: inline-block">{{ $apartament->apartament_district }}</span>@endif<br> <span style="font-size: 11px; display: inline-block">{{ $apartament->apartament_address }}</span><div><div class="description-below-img" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.people') }}" style="background-image: url({{ asset('images/results/person.png') }})"> <span>{{ $apartament->apartament_persons }}</span></div><div class="description-below-img mobile-none" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.double beds') }}" style="background-image: url({{ asset("images/results/doubleBed.png") }});"><span>{{ $apartament->apartament_double_beds }}</span></div><div class="description-below-img" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.single beds') }}" style="background-image: url({{ asset("images/results/bed.png") }});"><span>{{ $apartament->apartament_single_beds+$apartament->apartament_double_beds }}</span></div><div class="description-below-img desktop-none note" style="background-color: green"><span>4,5</span></div><div class="desktop-none description-below-notes">(23 {{ __("messages.reviews") }})</div>@if ( $apartament->apartament_wifi == 1)<div class="description-below-img mobile-none" data-toggle="tooltip" data-placement="bottom" title="Wifi" style="background-image: url({{ asset("images/results/wifi.png") }});"></div>@endif @if ( $apartament->apartament_parking == 1) <div class="description-below-img mobile-none" data-toggle="tooltip" data-placement="bottom" title="Parking" style="background-image: url({{ asset("images/results/parking.png") }});"> </div> @endif</div><div class="description-map-bottom-right d-none d-xl-block">@for ($i = 0; $i < floor($apartament->ratingAvg/2); $i++)<img src="{{ asset("images/results/star.png") }}">@endfor @if(floor($apartament->ratingAvg/2) != ceil($apartament->ratingAvg/2))<img src="{{ asset("images/results/star_half.png") }}">@endif @for ($i = ceil($apartament->ratingAvg/2); $i < 5; $i++)<img src="{{ asset("images/results/star_empty.png") }}">@endfor<br>@if($apartament->ratingAvg < 1)<span class="opinion-to-left" style="margin-right: 10px;"></span>@elseif($apartament->ratingAvg < 2.5)<span class="opinion-to-left txt-red" style="margin-right: 10px;">{{ __("messages.Awful") }}</span>@elseif($apartament->ratingAvg < 4.5)<span class="opinion-to-left txt-red" style="margin-right: 10px;">{{ __("messages.Bad") }}</span>@elseif($apartament->ratingAvg < 6.5)<span class="opinion-to-left txt-yellow" style="margin-right: 10px;">{{ __("messages.Average") }}</span>@elseif($apartament->ratingAvg < 8.5)<span class="opinion-to-left txt-green" style="margin-right: 10px;">{{ __("messages.Very good") }}</span>@else<span class="opinion-to-left txt-green" style="margin-right: 10px;">{{ __("messages.Perfect") }}</span>@endif<span class="txt-blue nr-reviews-right">{{$apartament->opinionAmount ?? 0}} {{trans_choice("messages.nrReviews", $apartament->opinionAmount ?? 0)}}</span></div></span>', grayIcon);
                        @mobile
                        google.maps.event.addListener(marker3, 'click', function() {
                            mapa.panTo(new google.maps.LatLng({{ $apartament->apartament_geo_lat+0.03 }}, {{ $apartament->apartament_geo_lan }}));
                        });
                        @endmobile
                    @endforeach

                        blackCheckbox();
                        grayCheckbox();

		}

                function blackCheckbox() {

                    if($('input[name="notMeetCriteria"]').is(':checked')) var notMeetCriteria = 1;
                    else    var notMeetCriteria = 0;

                    if (notMeetCriteria == 1){
                        for (var i = 0; i < blackMarkers.length; i++) {
                            blackMarkers[i].setMap(mapa);
                        }
                    }

                    else if (notMeetCriteria == 0){
                        for (var i = 0; i < blackMarkers.length; i++) {
                            blackMarkers[i].setMap(null);
                        }
                    }
                }


                function grayCheckbox() {

                    if($('input[name="notAvailable"]').is(':checked')) var notAvailable = 1;
                    else    var notAvailable = 0;

                    if (notAvailable == 1){
                        for (var i = 0; i < grayMarkers.length; i++) {
                            grayMarkers[i].setMap(mapa);
                        }
                    }

                    else if (notAvailable == 0){
                        for (var i = 0; i < grayMarkers.length; i++) {
                            grayMarkers[i].setMap(null);
                        }
                    }
                }

                function mapToggle(){
                    $('.mapToggle').toggle();
                    if($('.mapToggle').is(":visible")){
                        $('span.map-legend-toggle').html('<i style="font-size:16px; font-weight: bold" class="fa">&#xf101;</i>');
                        $('div.mapLegend').css('padding-bottom', '10px');
                    }
                    else {
                        $('span.map-legend-toggle').html('<i style="font-size:16px; font-weight: bold" class="fa">&#xf100;</i>');
                        $('div.mapLegend').css('padding-bottom', '27px');
                    }
                }

                function ajaxConenction(){

                    if($('input[name="notMeetCriteria"]').is(':checked')) var notMeetCriteria = 1;
                    else    var notMeetCriteria = 0;

                    if($('input[name="notAvailable"]').is(':checked')) var notAvailable = 1;
                    else    var notAvailable = 0;

			$.ajax({
			type: "GET",
			url: '/map',
			dataType : 'json',
			data: {
                            nieKryteria: notMeetCriteria,
                            niedostepne: notAvailable,
                            region: "{{ $finds[0]->apartament_city}}",
                            przyjazd: $('#przyjazd').val(),
                            powrot: $('#powrot').val(),
                            dorosli: $('[name="dorosli"]').val(),
                            dzieci: $('[name="dzieci"]').val(),
			},
                            success: function(data) {

                                mapaRefresh(data);
                                //$('#ilenocy').text(data.days_number);

                            },
                            error: function() {
                                    console.log( "Error in connection with controller");
                            },
			});
		}

        $(document).ready(function(){
            mapaStart();

        });
		</script>


            <script>
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
            </script>

@if($favouritesAmount == 0 && Auth::check())
    @include('includes.favourites-first-added-popup')
@endif

@endsection

