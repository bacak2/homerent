@extends ('pages.results')
@section ('displayResults')

            <div class="row">
                <div class="col-10"><h3 class="pb-2" style="display: inline">{{ $finds[0]->apartament_city}}</h3><span class="pb-2"> ({{ $counted }} {{trans_choice('messages.apartaments',$counted)}})</span></div>
                <div class="col-2 inline-wrapper"> <a class="btn btn-default" href="/search/kafle?{{ http_build_query(Request::except('page')) }}">Kafle</a> <a class="btn btn-default" href="/search/lista?{{ http_build_query(Request::except('page')) }}">Lista</a> <a class="btn btn-default" href="/search/mapa?{{ http_build_query(Request::except('page')) }}"><b>Mapa</b></a> </div>
            </div>

            <div class="row">
                <div id="mapka" style="width: 100%; height: 500px; margin-bottom: 30px;"></div>    
            </div>

<script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
		<script type="text/javascript">   
		
		var mapa;
		var dymek = new google.maps.InfoWindow(); // zmienna globalna
		
		function dodajMarker(lat,lng,txt, ikona)
		{
			// tworzymy marker
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
			  mapTypeId: google.maps.MapTypeId.ROADMAP
			};
			
			mapa = new google.maps.Map(document.getElementById("mapka"), opcjeMapy);
                        
                        mapLegend = document.createElement('mapLegend');
                        mapLegend.innerHTML = '<div class="mapLegend"><span class="mapToggle"><label><input style="visibility:hidden" type="checkbox"><img src="{{ asset('images/map/u3576.png') }}"><div style="float: right">Spałniające <br>kryteria i daty</div></label><label class="map-legend-button"><img src="{{ asset('images/map/u3586.png') }}"><input type="checkbox" name="notMeetCriteria" onchange="ajaxConenction()"><div style="float: right">Nie spałniające <br> kryteriów</div></label> <label class="map-legend-button"><img src="{{ asset('images/map/u3579.png') }}"><input type="checkbox" name="notAvailable" onchange="ajaxConenction()"><div style="float: right">Niedostępne w <br> tym terminie</div></label></span><span class="map-legend-toggle" onclick=mapToggle()><b> >> </b></span></div></div>';

                        /* Push Legend to Right Top */
                        mapa.controls[google.maps.ControlPosition.RIGHT_TOP].push(mapLegend);                        
                        @foreach ($finds as $apartament)
                            var marker1 = dodajMarker( {{ $apartament->apartament_geo_lat }}, {{ $apartament->apartament_geo_lan }},'<div class="map-img-wrapper"><img style="width: 300px; height: 169px"src="{{ asset("images/apartaments/$apartament->id/1.jpg") }}"><div class="map-see-more"><div class="container py-1"><a href="/apartaments/{{ $apartament->apartament_link }}" style="width: 100%" class="btn btn-primary">{{ __("messages.book") }}</a></div><div class="container py-1"><a href="/apartaments/{{ $apartament->apartament_link }}" class="btn btn-primary" style="width: 100%">{{ __("messages.see details") }}</a></div></div><div class="map-description-top">112 PLN</div> <div class="map-description-bottom">śniadanie w cenie</div></div><br><span style="font-size: 17px">{{ $apartament->apartament_name }}</span><br> <span style="font-size: 11px">{{ $apartament->apartament_address }}</span>', greenIcon);
                        @endforeach
		}

/*
		function mapaRefresh(data)   
		{   
                        console.log(data);
                        var wspolrzedne = new google.maps.LatLng(49.292166,19.952385);
			var opcjeMapy = {
			  zoom: 13,
			  center: wspolrzedne,
			  mapTypeId: google.maps.MapTypeId.ROADMAP
			};
			
			mapa = new google.maps.Map(document.getElementById("mapka"), opcjeMapy);
                        
                        mapLegend = document.createElement('mapLegend');
                        mapLegend.innerHTML = '<div class="mapLegend"><span class="mapToggle" style="display: inline-block"><label><input style="visibility:hidden" type="checkbox"><div style="float: right">Spałniające <br>kryteria i daty</div></label><label class="map-legend-button"><input type="checkbox" name="notMeetCriteria" onchange="ajaxConenction()"><div style="float: right">Nie spałniające <br> kryteriów</div></label> <label class="map-legend-button"><input type="checkbox" name="notAvailable" onchange="ajaxConenction()"><div style="float: right">Niedostępne w <br> tym terminie</div></label></span><span class="map-legend-toggle"><b> >> </b></span></div></div>';

                       
                        mapa.controls[google.maps.ControlPosition.RIGHT_TOP].push(mapLegend); 
                        
                        for (let i = 0; i < data.length; i++) {
                            dodajMarker( data[i].apartament_geo_lat , data[i].apartament_geo_lan ,'<div class="map-img-wrapper"><img style="width: 300px; height: 169px"src="{{ asset("images/apartaments/$apartament->id/1.jpg") }}"><div class="map-see-more"><div class="container py-1"><a href="/apartaments/{{ $apartament->apartament_link }}" style="width: 100%" class="btn btn-primary">{{ __("messages.book") }}</a></div><div class="container py-1"><a href="/apartaments/{{ $apartament->apartament_link }}" class="btn btn-primary" style="width: 100%">{{ __("messages.see details") }}</a></div></div><div class="map-description-top">112 PLN</div> <div class="map-description-bottom">śniadanie w cenie</div></div><br><span style="font-size: 17px">{{ $apartament->apartament_name }}</span><br> <span style="font-size: 11px">'+data[i].apartament_address+'</span>');
                        }
                        //dodajMarker( data[1].apartament_geo_lat , data[1].apartament_geo_lan ,'<div class="map-img-wrapper"><img style="width: 300px; height: 169px"src="{{ asset("images/apartaments/$apartament->id/1.jpg") }}"><div class="map-see-more"><div class="container py-1"><a href="/apartaments/{{ $apartament->apartament_link }}" style="width: 100%" class="btn btn-primary">{{ __("messages.book") }}</a></div><div class="container py-1"><a href="/apartaments/{{ $apartament->apartament_link }}" class="btn btn-primary" style="width: 100%">{{ __("messages.see details") }}</a></div></div><div class="map-description-top">112 PLN</div> <div class="map-description-bottom">śniadanie w cenie</div></div><br><span style="font-size: 17px">{{ $apartament->apartament_name }}</span><br> <span style="font-size: 11px">{{ $apartament->apartament_address }}</span>');
                        
		}
                    
                */
                
                function mapToggle(){
                    $('.mapToggle').toggle();
                    if($('.mapToggle').is(":visible")){
                        $('span.map-legend-toggle').html('<b> >> </b>');
                        $('div.mapLegend').css('padding-bottom', '10px');
                    }
                    else {
                        $('span.map-legend-toggle').html('<b> << </b>');
                        $('div.mapLegend').css('padding-bottom', '20px');
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
                
                window.onload = mapaStart;
		</script>   

@endsection

