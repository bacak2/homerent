@extends ('account.favourites.layout')

@section('fav-title', 'Mapa')

@section('icons-active')
    <a class="btn" href="{{ route('myFavourites') }}"><img data-toggle="tooltip" data-placement="bottom" title="Kafle" alt="Kafle" src='{{ asset("images/results/kafle.png") }}'></a>
    <a class="btn" href="{{ route('myFavouritesList') }}"><img data-toggle="tooltip" data-placement="bottom" title="Lista" alt="Lista" src='{{ asset("images/results/lista.png") }}'></a>
    <a class="btn" href="{{ route('myFavouritesMap') }}"><img class="active" data-toggle="tooltip" data-placement="bottom" title="Mapa" alt="Mapa" src='{{ asset("images/results/mapa.png") }}'></a>
    <a href="{{ route('myFavouritesCompare') }}">Porównaj</a>
@endsection

@section('if-has-przyjazd')

    <div class="row" style="margin-top: 20px" itemscope itemtype="http://schema.org/Hotel">
        <div id="mapka" style="width: 100%; height: 500px; margin-bottom: 30px;" itemprop="hasMap"></div>
    </div>

    <script src="http://maps.google.com/maps/api/js?key=AIzaSyBBEtTo5au09GsH6EvJhj1R_uc0BpTLVaw" type="text/javascript"></script>

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
                var wspolrzedne = new google.maps.LatLng(49.292166,19.952385);
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
                        var marker1 = dodajZielonyMarkerKompleks( {{ $apartament->apartament_geo_lat }}, {{ $apartament->apartament_geo_lan }},'<div class="map-img-wrapper greenIcon"><a class="desktop-none" href="/apartaments-group/{{ $apartament->group_link }}"><img style="width: 210px; height: 112px"src="{{ asset("images/apartaments/$apartament->id/1.jpg") }}"></a><img class="mobile-none" style="width: 300px; height: 169px"src="{{ asset("images/apartaments/$apartament->id/1.jpg") }}"><div class="map-see-more"><div class="container py-1"></div><div class="container py-1"><a href="/apartaments-group/{{ $apartament->group_link }}" class="btn btn-primary mobile-none" style="width: 100%">{{ __("messages.see details") }}</a></div></div><div class="map-description-top">{{ $apartament->min_price }} PLN</div> <div class="map-count">{{ $apartament->apartaments_amount }} {{trans_choice("messages.nrApartmentsInKomplex", $apartament->apartaments_amount)}}</div> <div class="map-description-bottom">{{ __("messages.Breakfast included") }}</div></div><span class="map-description"><span style="font-size: 17px; display: inline-block">{{ $apartament->apartament_name }}</span><br> <span style="font-size: 11px; display: inline-block">{{ $apartament->apartament_district }}</span><br> <span style="font-size: 11px; display: inline-block" itemprop="streetAddress">{{ $apartament->apartament_address }}</span><div><div class="description-below-img" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.people') }}" style="background-image: url({{ asset('images/results/person.png') }})"> <span>{{ $apartament->apartament_persons }}</span></div><div class="description-below-img desktop-none" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.kids') }}" style="background-image: url({{ asset('images/results/child.png') }})"> <span>{{ $apartament->apartament_persons }}</span></div><div class="description-below-img mobile-none" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.double beds') }}" style="background-image: url({{ asset("images/results/doubleBed.png") }});"><span>{{ $apartament->apartament_double_beds }}</span></div><div class="description-below-img" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.single beds') }}" style="background-image: url({{ asset("images/results/bed.png") }});"><span>{{ $apartament->apartament_single_beds }}</span></div>@if($apartament->ratingAvg < 1) <div class="description-below-img desktop-none note"><span>{{$apartament->ratingAvg}}</span></div> @elseif($apartament->ratingAvg < 2.5) <div class="description-below-img desktop-none note txt-red"><span>{{$apartament->ratingAvg}}</span></div> @elseif($apartament->ratingAvg < 4.5) <div class="description-below-img desktop-none note txt-red"><span>{{$apartament->ratingAvg}}</span></div> @elseif($apartament->ratingAvg < 6.5) <div class="description-below-img desktop-none note txt-yellow"><span>{{$apartament->ratingAvg}}</span></div> @elseif($apartament->ratingAvg < 8.5) <div class="description-below-img desktop-none note txt-green"><span>{{$apartament->ratingAvg}}</span></div> @else <div class="description-below-img desktop-none note txt-green"><span>{{$apartament->ratingAvg}}</span></div> @endif<div class="desktop-none description-below-notes">({{$apartament->opinionAmount ?? 0}} {{ __("messages.reviews") }})</div>@if ( $apartament->apartament_wifi == 1)<div class="description-below-img mobile-none" data-toggle="tooltip" data-placement="bottom" title="Wifi" style="background-image: url({{ asset("images/results/wifi.png") }});"></div>@endif @if ( $apartament->apartament_parking == 1) <div class="description-below-img mobile-none" data-toggle="tooltip" data-placement="bottom" title="Parking" style="background-image: url({{ asset("images/results/parking.png") }});"> </div> @endif</div><div class="description-map-bottom-right mobile-none">@for ($i = 0; $i < 5; $i++) <img src="{{ asset("images/results/star.png") }}">@endfor<br></div></span>', greenIcon, {{ $apartament->apartaments_amount }});
                        @mobile
                            google.maps.event.addListener(marker1, 'click', function() {
                                mapa.panTo(new google.maps.LatLng({{ $apartament->apartament_geo_lat+0.03 }}, {{ $apartament->apartament_geo_lan }}));
                            });
                        @endmobile
                    @elseif($apartament->group_id == 0)
                        var marker1 = dodajZielonyMarker( {{ $apartament->apartament_geo_lat }}, {{ $apartament->apartament_geo_lan }},'<div class="map-img-wrapper greenIcon"><a class="desktop-none" href="/apartaments/{{ $apartament->apartament_link }}" ><img style="width: 210px; height: 112px"src="{{ asset("images/apartaments/$apartament->id/1.jpg") }}"></a><img class="mobile-none" style="width: 300px; height: 169px"src="{{ asset("images/apartaments/$apartament->id/1.jpg") }}"><div class="map-see-more"><div class="container py-1"><a href="/apartaments-group/{{ $apartament->group_link }}"  style="width: 100%" class="btn btn-primary mobile-none">{{ __("messages.book") }}</a></div><div class="container py-1"><a href="/apartaments/{{ $apartament->apartament_link }}" class="btn btn-primary mobile-none" style="width: 100%">{{ __("messages.see details") }}</a></div></div><div class="map-description-top">{{ $apartament->min_price }} PLN</div></div><span class="map-description"><span style="font-size: 17px; display: inline-block">{{ $apartament->apartament_name }}</span><br> <span style="font-size: 11px; display: inline-block">{{ $apartament->apartament_district }}</span><br> <span style="font-size: 11px; display: inline-block" itemprop="streetAddress">{{ $apartament->apartament_address }}</span><div><div class="description-below-img" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.people') }}" style="background-image: url({{ asset('images/results/person.png') }})"> <span>{{ $apartament->apartament_persons }}</span></div><div class="description-below-img desktop-none" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.kids') }}" style="background-image: url({{ asset('images/results/child.png') }})"> <span>{{ $apartament->apartament_persons }}</span></div><div class="description-below-img mobile-none" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.double beds') }}" style="background-image: url({{ asset("images/results/doubleBed.png") }});"><span>{{ $apartament->apartament_double_beds }}</span></div><div class="description-below-img" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.single beds') }}" style="background-image: url({{ asset("images/results/bed.png") }});"><span>{{ $apartament->apartament_single_beds }}</span></div>@if($apartament->ratingAvg < 1) <div class="description-below-img desktop-none note"></div> @elseif($apartament->ratingAvg < 2.5) <div style="background-color: #ff2620" class="description-below-img desktop-none note"><span>{{ number_format($apartament->ratingAvg, 1, ',', ' ') }}</span></div> @elseif($apartament->ratingAvg < 4.5) <div style="background-color: #ff2620" class="description-below-img desktop-none note"><span>{{ number_format($apartament->ratingAvg, 1, ',', ' ') }}</span></div> @elseif($apartament->ratingAvg < 6.5) <div style="background-color: #ddc100;" class="description-below-img desktop-none note"><span style="color: black">{{ number_format($apartament->ratingAvg, 1, ',', ' ') }}</span></div> @elseif($apartament->ratingAvg < 8.5) <div style="background-color: #1c7430" class="description-below-img desktop-none note"><span>{{ number_format($apartament->ratingAvg, 1, ',', ' ') }}</span></div> @else <div style="background-color: #1c7430" class="description-below-img desktop-none note"><span>{{ number_format($apartament->ratingAvg, 1, ',', ' ') }}</span></div> @endif<div class="desktop-none description-below-notes">({{$apartament->opinionAmount ?? 0}} {{ __("messages.reviews") }})</div>@if ( $apartament->apartament_wifi == 1)<div class="description-below-img mobile-none" data-toggle="tooltip" data-placement="bottom" title="Wifi" style="background-image: url({{ asset("images/results/wifi.png") }});"></div>@endif @if ( $apartament->apartament_parking == 1) <div class="description-below-img mobile-none" data-toggle="tooltip" data-placement="bottom" title="Parking" style="background-image: url({{ asset("images/results/parking.png") }});"> </div> @endif</div><div class="description-map-bottom-right mobile-none">@for ($i = 0; $i < floor($apartament->ratingAvg/2); $i++) <img src="{{ asset("images/results/star.png") }}"> @endfor @if(floor($apartament->ratingAvg/2) != ceil($apartament->ratingAvg/2)) <img src="{{ asset("images/results/star_half.png") }}"> @endif @for ($i = ceil($apartament->ratingAvg/2); $i < 5; $i++) <img src="{{ asset("images/results/star_empty.png") }}"> @endfor <br> @if($apartament->ratingAvg < 1) <span class="opinion-to-left" style="margin-right: 10px;"></span> @elseif($apartament->ratingAvg < 2.5) <span class="opinion-to-left txt-red" style="margin-right: 10px;">{{ __("messages.Awful") }}</span> @elseif($apartament->ratingAvg < 4.5) <span class="opinion-to-left txt-red" style="margin-right: 10px;">{{ __("messages.Bad") }}</span> @elseif($apartament->ratingAvg < 6.5) <span class="opinion-to-left txt-yellow" style="margin-right: 10px;">{{ __("messages.Average") }}</span> @elseif($apartament->ratingAvg < 8.5) <span class="opinion-to-left txt-green" style="margin-right: 10px;">{{ __("messages.Very good") }}</span> @else <span class="opinion-to-left txt-green" style="margin-right: 10px;">{{ __("messages.Perfect") }}</span> @endif <span class="txt-blue nr-reviews-right">{{$apartament->opinionAmount ?? 0}} {{trans_choice('messages.nrReviews', $apartament->opinionAmount ?? 0)}}</span></div></span>', greenIcon);
                        @mobile
                            google.maps.event.addListener(marker1, 'click', function() {
                                mapa.panTo(new google.maps.LatLng({{ $apartament->apartament_geo_lat+0.03 }}, {{ $apartament->apartament_geo_lan }}));
                            });
                        @endmobile
                    @endif
                @endforeach
                {{--
                @foreach ($black as $apartament)
                var marker2 = dodajCzarnyMarker( {{ $apartament->apartament_geo_lat }}, {{ $apartament->apartament_geo_lan }},'<div class="map-img-wrapper greenIcon"><a class="desktop-none" href="/apartaments/{{ $apartament->apartament_link }}"><img style="width: 210px; height: 112px"src="{{ asset("images/apartaments/$apartament->id/1.jpg") }}"></a><img class="mobile-none" style="width: 300px; height: 169px"src="{{ asset("images/apartaments/$apartament->id/1.jpg") }}"><div class="map-see-more"><div class="container py-1"><a href="/apartaments/{{ $apartament->apartament_link }}" class="btn btn-primary mobile-none" style="width: 100%">{{ __("messages.see details") }}</a></div></div><div class="map-description-top">199 PLN</div> <div class="map-description-bottom">{{ __("messages.Breakfast included") }}</div><div class="add-to-favourities"><span data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Add to favorites') }}" onClick="addToFavourites({{$apartament->id}}, {{Auth::user()->id ?? 0}})"><img src="{{ asset('images/results/heart.png') }}"></span></div></div><span class="map-description"><span style="font-size: 17px; display: inline-block">{{ $apartament->apartament_name }}</span><br> <span style="font-size: 11px; display: inline-block">{{ $apartament->apartament_district }}</span><br> <span style="font-size: 11px; display: inline-block">{{ $apartament->apartament_address }}</span><div><div class="description-below-img" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.people') }}" style="background-image: url({{ asset('images/results/person.png') }})"> <span>{{ $apartament->apartament_persons }}</span></div><div class="description-below-img desktop-none" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.kids') }}" style="background-image: url({{ asset('images/results/child.png') }})"> <span>{{ $apartament->apartament_persons }}</span></div><div class="description-below-img mobile-none" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.double beds') }}" style="background-image: url({{ asset("images/results/doubleBed.png") }});"><span>{{ $apartament->apartament_double_beds }}</span></div><div class="description-below-img" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.single beds') }}" style="background-image: url({{ asset("images/results/bed.png") }});"><span>{{ $apartament->apartament_single_beds }}</span></div><div class="description-below-img desktop-none note" style="background-color: green"><span>4,5</span></div><div class="desktop-none description-below-notes">(23 {{ __("messages.reviews") }})</div>@if ( $apartament->apartament_wifi == 1)<div class="description-below-img mobile-none" data-toggle="tooltip" data-placement="bottom" title="Wifi" style="background-image: url({{ asset("images/results/wifi.png") }});"></div>@endif @if ( $apartament->apartament_parking == 1) <div class="description-below-img mobile-none" data-toggle="tooltip" data-placement="bottom" title="Parking" style="background-image: url({{ asset("images/results/parking.png") }});"> </div> @endif</div><div class="description-map-bottom-right mobile-none">@for ($i = 0; $i < 5; $i++) <img src="{{ asset("images/results/star.png") }}">@endfor<br><span style="color: green; margin-right: 10px">{{ __("messages.Perfect") }}</span> <span style="color: blue">55 {{ __("messages.reviews_number") }}</span></div></span>', blackIcon);
                @endforeach

                @foreach ($gray as $apartament)
                var marker3 = dodajSzaryMarker( {{ $apartament->apartament_geo_lat }}, {{ $apartament->apartament_geo_lan }},'<div class="map-img-wrapper greenIcon"><a class="desktop-none" href="/apartaments/{{ $apartament->apartament_link }}"><img style="width: 210px; height: 112px"src="{{ asset("images/apartaments/$apartament->id/1.jpg") }}"></a><img class="mobile-none" style="width: 300px; height: 169px"src="{{ asset("images/apartaments/$apartament->id/1.jpg") }}"><div class="map-see-more"><div class="container py-1"><a href="/apartaments/{{ $apartament->apartament_link }}" style="width: 100%" class="btn btn-primary mobile-none">{{ __("messages.book") }}</a></div><div class="container py-1"><a href="/apartaments/{{ $apartament->apartament_link }}" class="btn btn-primary mobile-none" style="width: 100%">{{ __("messages.see details") }}</a></div></div><div class="map-description-top">199 PLN</div> <div class="map-description-bottom">{{ __("messages.Breakfast included") }}</div><div class="add-to-favourities"><span data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Add to favorites') }}" onClick="addToFavourites({{$apartament->id}}, {{Auth::user()->id ?? 0}})"><img src="{{ asset('images/results/heart.png') }}"></span></div></div><span class="map-description"><span style="font-size: 17px; display: inline-block">{{ $apartament->apartament_name }}</span><br> <span style="font-size: 11px; display: inline-block">{{ $apartament->apartament_district }}</span><br> <span style="font-size: 11px; display: inline-block">{{ $apartament->apartament_address }}</span><div><div class="description-below-img" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.people') }}" style="background-image: url({{ asset('images/results/person.png') }})"> <span>{{ $apartament->apartament_persons }}</span></div><div class="description-below-img desktop-none" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.kids') }}" style="background-image: url({{ asset('images/results/child.png') }})"> <span>{{ $apartament->apartament_persons }}</span></div><div class="description-below-img mobile-none" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.double beds') }}" style="background-image: url({{ asset("images/results/doubleBed.png") }});"><span>{{ $apartament->apartament_double_beds }}</span></div><div class="description-below-img" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.single beds') }}" style="background-image: url({{ asset("images/results/bed.png") }});"><span>{{ $apartament->apartament_single_beds }}</span></div><div class="description-below-img desktop-none note" style="background-color: green"><span>4,5</span></div><div class="desktop-none description-below-notes">(23 {{ __("messages.reviews") }})</div>@if ( $apartament->apartament_wifi == 1)<div class="description-below-img mobile-none" data-toggle="tooltip" data-placement="bottom" title="Wifi" style="background-image: url({{ asset("images/results/wifi.png") }});"></div>@endif @if ( $apartament->apartament_parking == 1) <div class="description-below-img mobile-none" data-toggle="tooltip" data-placement="bottom" title="Parking" style="background-image: url({{ asset("images/results/parking.png") }});"> </div> @endif</div><div class="description-map-bottom-right mobile-none">@for ($i = 0; $i < 5; $i++) <img src="{{ asset("images/results/star.png") }}">@endfor<br><span style="color: green; margin-right: 10px">{{ __("messages.Perfect") }}</span> <span style="color: blue">55 {{ __("messages.reviews_number") }}</span></div></span>', grayIcon);
                @endforeach


                blackCheckbox();
                grayCheckbox();
                --}}

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

        {{--
    <div class="row">
        @foreach ($finds as $apartament)
            <div style="overflow: auto;" class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3" itemscope itemtype="http://schema.org/Hotel">
                <div class="map-img-wrapper">

                    <div class="apartament" style="background-image: url('{{ asset("images/apartaments/$apartament->id/1.jpg") }}'); background-size: cover; position: relative; margin-bottom: 0px">
                        <div class="map-see-more mobile-none">
                            <div class="container py-1">
                                <a href="/apartaments/{{ $apartament->apartament_link }}" class="btn btn-primary" style="width: 100%">{{ __("messages.see details") }}</a>
                            </div>
                            <div class="container py-1">
                                <a href="/apartaments/{{ $apartament->apartament_link }}" class="btn btn-primary" style="width: 100%">{{ __("messages.see details") }}</a>
                            </div>
                        </div>
                        <div class="desktop-none" style="width: 100%; height: 100%">
                            <a style=" display: inline-block; width: 100%; height: 100%" href="/apartaments/{{ $apartament->apartament_link }}"></a>
                        </div>
                    </div>

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
    --}}
</div>


@endsection