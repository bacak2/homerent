@extends ('pages.results')
@section ('displayResults')
            <div class="row desktop-none" style="margin-bottom: 20px">
                <div class="col-9 text-mobile-search">
                    <a href="/" style="color: #00afea">Start > </a><b>{{ $finds[0]->apartament_city}}</b>, {{__('messages.from')}} {{ $_GET['przyjazd'] }}, {{__('messages.number of nights')}}: {{ $nightsCounter }}, {{__('messages.Persons')}}: {{ $_GET['dorosli']+$_GET['dzieci'] }}, {{__('messages.Filters')}}: 
                </div> 
                <div class="col-3">
                    <div  style="position: absolute; right:10px;"><a  class="btn btn-info btn-mobile filters-toggle">{{__('messages.change')}} </a></div>
                </div>
                
                @include('includes.filters-mobile')
                    
            </div>    
            
            <div class="row">
                <div class="col-8"><h1 class="pb-2" style="display: inline; font-size: 28px;">{{ $finds[0]->apartament_city}} <span class="desktop-none">({{ $counted }})</span></h1><span class="pb-2 mobile-none"> ({{ $counted }} {{trans_choice('messages.apartaments',$counted)}})</span></div>
                <div class="col-4 inline-wrapper text-right mobile-none"> <a class="btn btn-default" href="/search/kafle?{{ http_build_query(Request::except('page')) }}"><img src='{{ asset("images/results/kafle.png") }}'></a> <a class="btn btn-default" href="/search/lista?{{ http_build_query(Request::except('page')) }}"><img src='{{ asset("images/results/lista.png") }}'></a> <a class="btn btn-default" href="/search/mapa?{{ http_build_query(Request::except('page')) }}"><img  class="active" src='{{ asset("images/results/mapa.png") }}'></a></div>
                <div class="col-4 inline-wrapper text-right desktop-none"> <div style="position: absolute; right:10px;"   class="btn-group"><a class="btn btn-info btn-mobile" href="/search/kafle?{{ http_build_query(Request::except('page')) }}">{{__('messages.Offers')}}</a><a class="btn btn-selected btn-mobile" href="/search/mapa?{{ http_build_query(Request::except('page')) }}">{{__('messages.Map')}}</a></div></div>
            </div>

            <div class="row" style="margin-top: 20px">
                <div id="mapka" style="width: 100%; height: 500px; margin-bottom: 30px;"></div>    
            </div>

<script src="http://maps.google.com/maps/api/js?key=AIzaSyBBEtTo5au09GsH6EvJhj1R_uc0BpTLVaw" type="text/javascript"></script>
		<script type="text/javascript">   
		
		var mapa;
		var dymek = new google.maps.InfoWindow(); // zmienna globalna
		var greenMarkers = [];
                var blackMarkers = [];
                var grayMarkers = [];
                
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
			  mapTypeId: google.maps.MapTypeId.ROADMAP,
                          mapTypeControl: false,
			};
			
			mapa = new google.maps.Map(document.getElementById("mapka"), opcjeMapy);
                        
                        mapLegend = document.createElement('mapLegend');
                        mapLegend.innerHTML = '<div class="mapLegend"><span class="mapToggle"><label><input style="visibility:hidden" type="checkbox"><img src="{{ asset('images/map/u3576.png') }}"><div style="float: right">{{ __("messages.Satisfying") }} <br>{{ __("messages.criteria and dates") }}</div></label><label class="map-legend-button"><img src="{{ asset('images/map/u3586.png') }}"><input type="checkbox" name="notMeetCriteria" onchange="blackCheckbox()"><div style="float: right">{{ __("messages.Do not meet") }} <br>{{ __("messages.criteria") }}</div></label> <label class="map-legend-button"><img src="{{ asset('images/map/u3579.png') }}"><input type="checkbox" name="notAvailable" onchange="grayCheckbox()"><div style="float: right; margin-right: 5px">{{ __("messages.Not available") }} <br>{{ __("messages.on this date") }}</div></label></span><span id="btn-map-toggle" class="map-legend-toggle" onclick=mapToggle()><i style="font-size:16px; font-weight: bold" class="fa">&#xf101;</i></span></div></div>';

                        /* Push Legend to Right Top */
                        mapa.controls[google.maps.ControlPosition.RIGHT_TOP].push(mapLegend);                        
                        @foreach ($finds as $apartament)
                            var marker1 = dodajZielonyMarker( {{ $apartament->apartament_geo_lat }}, {{ $apartament->apartament_geo_lan }},'<div class="map-img-wrapper greenIcon"><a class="desktop-none" href="/reservations?link={{ $apartament->apartament_link }}&id={{ $apartament->apartament_id }}&przyjazd={{ $request->przyjazd }}&powrot={{ $request->powrot }}&dorosli={{ $request->dorosli }}&dzieci={{ $request->dzieci }}" ><img style="width: 210px; height: 112px"src="{{ asset("images/apartaments/$apartament->id/1.jpg") }}"></a><img class="mobile-none" style="width: 300px; height: 169px"src="{{ asset("images/apartaments/$apartament->id/1.jpg") }}"><div class="map-see-more"><div class="container py-1"><a href="/reservations?link={{ $apartament->apartament_link }}&id={{ $apartament->apartament_id }}&przyjazd={{ $request->przyjazd }}&powrot={{ $request->powrot }}&dorosli={{ $request->dorosli }}&dzieci={{ $request->dzieci }}"  style="width: 100%" class="btn btn-primary mobile-none">{{ __("messages.book") }}</a></div><div class="container py-1"><a href="/apartaments/{{ $apartament->apartament_link }}" class="btn btn-primary mobile-none" style="width: 100%">{{ __("messages.see details") }}</a></div></div><div class="map-description-top">112 PLN</div> <div class="map-description-bottom">{{ __("messages.Breakfast included") }}</div><div class="add-to-favourities" ><a data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Add to favorites') }}" href="#"><img src="{{ asset('images/results/heart.png') }}"></a></div></div><span class="map-description"><span style="font-size: 17px; display: inline-block">{{ $apartament->apartament_name }}</span><br> <span style="font-size: 11px; display: inline-block">{{ $apartament->apartament_district }}</span><br> <span style="font-size: 11px; display: inline-block">{{ $apartament->apartament_address }}</span><div><div class="description-below-img" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.people') }}" style="background-image: url({{ asset('images/results/person.png') }})"> <span>{{ $apartament->apartament_persons }}</span></div><div class="description-below-img desktop-none" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.kids') }}" style="background-image: url({{ asset('images/results/child.png') }})"> <span>{{ $apartament->apartament_persons }}</span></div><div class="description-below-img mobile-none" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.double beds') }}" style="background-image: url({{ asset("images/results/doubleBed.png") }});"><span>{{ $apartament->apartament_double_beds }}</span></div><div class="description-below-img" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.single beds') }}" style="background-image: url({{ asset("images/results/bed.png") }});"><span>{{ $apartament->apartament_single_beds }}</span></div><div class="description-below-img desktop-none note" style="background-color: green"><span>4,5</span></div><div class="desktop-none description-below-notes">(23 {{ __("messages.reviews") }})</div>@if ( $apartament->apartament_wifi == 1)<div class="description-below-img mobile-none" data-toggle="tooltip" data-placement="bottom" title="Wifi" style="background-image: url({{ asset("images/results/wifi.png") }});"></div>@endif @if ( $apartament->apartament_parking == 1) <div class="description-below-img mobile-none" data-toggle="tooltip" data-placement="bottom" title="Parking" style="background-image: url({{ asset("images/results/parking.png") }});"> </div> @endif</div><div class="description-map-bottom-right mobile-none">@for ($i = 0; $i < 5; $i++) <img src="{{ asset("images/results/star.png") }}">@endfor<br><span style="color: green; margin-right: 10px">{{ __("messages.Perfect") }}</span> <span style="color: blue">55 {{ __("messages.reviews_number") }}</span></div></span>', greenIcon);
                        @endforeach
                        
                        @foreach ($black as $apartament)
                            var marker2 = dodajCzarnyMarker( {{ $apartament->apartament_geo_lat }}, {{ $apartament->apartament_geo_lan }},'<div class="map-img-wrapper greenIcon"><a class="desktop-none" href="/apartaments/{{ $apartament->apartament_link }}"><img style="width: 210px; height: 112px"src="{{ asset("images/apartaments/$apartament->id/1.jpg") }}"></a><img class="mobile-none" style="width: 300px; height: 169px"src="{{ asset("images/apartaments/$apartament->id/1.jpg") }}"><div class="map-see-more"><div class="container py-1"><a href="/apartaments/{{ $apartament->apartament_link }}" style="width: 100%" class="btn btn-primary mobile-none">{{ __("messages.book") }}</a></div><div class="container py-1"><a href="/apartaments/{{ $apartament->apartament_link }}" class="btn btn-primary mobile-none" style="width: 100%">{{ __("messages.see details") }}</a></div></div><div class="map-description-top">112 PLN</div> <div class="map-description-bottom">{{ __("messages.Breakfast included") }}</div><div class="add-to-favourities"><a data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Add to favorites') }}" href="#"><img src="{{ asset('images/results/heart.png') }}"></a></div></div><span class="map-description"><span style="font-size: 17px; display: inline-block">{{ $apartament->apartament_name }}</span><br> <span style="font-size: 11px; display: inline-block">{{ $apartament->apartament_district }}</span><br> <span style="font-size: 11px; display: inline-block">{{ $apartament->apartament_address }}</span><div><div class="description-below-img" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.people') }}" style="background-image: url({{ asset('images/results/person.png') }})"> <span>{{ $apartament->apartament_persons }}</span></div><div class="description-below-img desktop-none" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.kids') }}" style="background-image: url({{ asset('images/results/child.png') }})"> <span>{{ $apartament->apartament_persons }}</span></div><div class="description-below-img mobile-none" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.double beds') }}" style="background-image: url({{ asset("images/results/doubleBed.png") }});"><span>{{ $apartament->apartament_double_beds }}</span></div><div class="description-below-img" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.single beds') }}" style="background-image: url({{ asset("images/results/bed.png") }});"><span>{{ $apartament->apartament_single_beds }}</span></div><div class="description-below-img desktop-none note" style="background-color: green"><span>4,5</span></div><div class="desktop-none description-below-notes">(23 {{ __("messages.reviews") }})</div>@if ( $apartament->apartament_wifi == 1)<div class="description-below-img mobile-none" data-toggle="tooltip" data-placement="bottom" title="Wifi" style="background-image: url({{ asset("images/results/wifi.png") }});"></div>@endif @if ( $apartament->apartament_parking == 1) <div class="description-below-img mobile-none" data-toggle="tooltip" data-placement="bottom" title="Parking" style="background-image: url({{ asset("images/results/parking.png") }});"> </div> @endif</div><div class="description-map-bottom-right mobile-none">@for ($i = 0; $i < 5; $i++) <img src="{{ asset("images/results/star.png") }}">@endfor<br><span style="color: green; margin-right: 10px">{{ __("messages.Perfect") }}</span> <span style="color: blue">55 {{ __("messages.reviews_number") }}</span></div></span>', blackIcon);
                            var marker3 = dodajSzaryMarker( {{ $apartament->apartament_geo_lat }}, {{ $apartament->apartament_geo_lan }},'<div class="map-img-wrapper greenIcon"><a class="desktop-none" href="/apartaments/{{ $apartament->apartament_link }}"><img style="width: 210px; height: 112px"src="{{ asset("images/apartaments/$apartament->id/1.jpg") }}"></a><img class="mobile-none" style="width: 300px; height: 169px"src="{{ asset("images/apartaments/$apartament->id/1.jpg") }}"><div class="map-see-more"><div class="container py-1"><a href="/apartaments/{{ $apartament->apartament_link }}" style="width: 100%" class="btn btn-primary mobile-none">{{ __("messages.book") }}</a></div><div class="container py-1"><a href="/apartaments/{{ $apartament->apartament_link }}" class="btn btn-primary mobile-none" style="width: 100%">{{ __("messages.see details") }}</a></div></div><div class="map-description-top">112 PLN</div> <div class="map-description-bottom">{{ __("messages.Breakfast included") }}</div><div class="add-to-favourities"><a data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Add to favorites') }}" href="#"><img src="{{ asset('images/results/heart.png') }}"></a></div></div><span class="map-description"><span style="font-size: 17px; display: inline-block">{{ $apartament->apartament_name }}</span><br> <span style="font-size: 11px; display: inline-block">{{ $apartament->apartament_district }}</span><br> <span style="font-size: 11px; display: inline-block">{{ $apartament->apartament_address }}</span><div><div class="description-below-img" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.people') }}" style="background-image: url({{ asset('images/results/person.png') }})"> <span>{{ $apartament->apartament_persons }}</span></div><div class="description-below-img desktop-none" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.kids') }}" style="background-image: url({{ asset('images/results/child.png') }})"> <span>{{ $apartament->apartament_persons }}</span></div><div class="description-below-img mobile-none" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.double beds') }}" style="background-image: url({{ asset("images/results/doubleBed.png") }});"><span>{{ $apartament->apartament_double_beds }}</span></div><div class="description-below-img" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.single beds') }}" style="background-image: url({{ asset("images/results/bed.png") }});"><span>{{ $apartament->apartament_single_beds }}</span></div><div class="description-below-img desktop-none note" style="background-color: green"><span>4,5</span></div><div class="desktop-none description-below-notes">(23 {{ __("messages.reviews") }})</div>@if ( $apartament->apartament_wifi == 1)<div class="description-below-img mobile-none" data-toggle="tooltip" data-placement="bottom" title="Wifi" style="background-image: url({{ asset("images/results/wifi.png") }});"></div>@endif @if ( $apartament->apartament_parking == 1) <div class="description-below-img mobile-none" data-toggle="tooltip" data-placement="bottom" title="Parking" style="background-image: url({{ asset("images/results/parking.png") }});"> </div> @endif</div><div class="description-map-bottom-right mobile-none">@for ($i = 0; $i < 5; $i++) <img src="{{ asset("images/results/star.png") }}">@endfor<br><span style="color: green; margin-right: 10px">{{ __("messages.Perfect") }}</span> <span style="color: blue">55 {{ __("messages.reviews_number") }}</span></div></span>', grayIcon);
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

@endsection

