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
		
		function dodajMarker(lat,lng,txt)
		{
			// tworzymy marker
			var opcjeMarkera =   
			{  
				position: new google.maps.LatLng(lat,lng),  
				map: mapa
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
			var opcjeMapy = {
			  zoom: 13,
			  center: wspolrzedne,
			  mapTypeId: google.maps.MapTypeId.ROADMAP
			};
			
			mapa = new google.maps.Map(document.getElementById("mapka"), opcjeMapy);
                        
                        mapLegend = document.createElement('mapLegend');
                        mapLegend.innerHTML = '<div class="mapLegend"><label><input style="visibility:hidden" type="checkbox"><div style="float: right">Spałniające <br>kryteria i daty</div></label><label class="map-legend-button"><input type="checkbox"><div style="float: right">Nie spałniające <br> kryteriów</div></label> <label class="map-legend-button"><input type="checkbox"><div style="float: right">Niedostępne w <br> tym terminie</div></label><span class="map-legend-toggle"><b> >> </b></div></div>';

                        /* Push Legend to Right Top */
                        mapa.controls[google.maps.ControlPosition.RIGHT_TOP].push(mapLegend);                        
                        @foreach ($finds as $apartament)
                            var marker1 = dodajMarker( {{ $apartament->apartament_geo_lat }}, {{ $apartament->apartament_geo_lan }},'<div class="map-img-wrapper"><img style="width: 300px; height: 169px"src="{{ asset("images/apartaments/$apartament->id/1.jpg") }}"><div class="map-see-more"><div class="container py-1"><a href="/apartaments/{{ $apartament->apartament_link }}" style="width: 100%" class="btn btn-primary">{{ __("messages.book") }}</a></div><div class="container py-1"><a href="/apartaments/{{ $apartament->apartament_link }}" class="btn btn-primary" style="width: 100%">{{ __("messages.see details") }}</a></div></div><div class="map-description-top">112 PLN</div> <div class="map-description-bottom">śniadanie w cenie</div></div><br><span style="font-size: 17px">{{ $apartament->apartament_name }}</span><br> <span style="font-size: 11px">{{ $apartament->apartament_address }}</span>');
                        @endforeach
		}
                
                $(document).ready(function(){
                    $(".map-legend-toggle").click(function(){
                        $(".mapLegend").toggle();
                    });
                });
                
                window.onload = mapaStart;
		</script>   

@endsection

