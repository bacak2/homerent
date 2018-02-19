@extends ('pages.results')
@section ('displayResults')
            <div class="row">
                <div class="col-lg-6 col-md-12"><h3 class="pb-2">{{__('messages.found')}} {{ $counted }} {{trans_choice('messages.apartaments',$counted)}}</h3></div>
                <div class="col-12 col-lg-3 col-md-7 col-sm-12 col-xs-12">Sortuj:
                    <select id="u1001_input" name="sort">
                        <option selected="" value="Najlepsze dopasowanie">Najlepsze dopasowanie</option>
                        <option value="Najniższa cena">Najniższa cena</option>
                        <option value="Najlepiej oceniane">Najlepiej oceniane</option>
                        <option value="Najpopularniejsze">Najpopularniejsze</option>
                        <option value="Najbliżej">Najbliżej</option>
                    </select>
                </div>
                <div class="col-12 col-lg-3 col-md-5 col-sm-12 col-xs-12 inline-wrapper text-right"> <a class="btn btn-default" href="/search/kafle?{{ http_build_query(Request::except('page')) }}"><img class="active" src='{{ asset("images/results/kafle.png") }}'></a> <a class="btn btn-default" href="/search/lista?{{ http_build_query(Request::except('page')) }}"><img src='{{ asset("images/results/lista.png") }}'></a> <a class="btn btn-default" href="/search/mapa?{{ http_build_query(Request::except('page')) }}"><img src='{{ asset("images/results/mapa.png") }}'></a></div>
            </div>
		<div class="row">  
                    @foreach ($finds as $apartament)                        
                    <div style="overflow: auto;" class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3">
                        <div class="map-img-wrapper">
                            <div style="background-image: url('{{ asset("images/apartaments/$apartament->id/1.jpg") }}'); background-size: cover; position: relative; margin-bottom: 0px"  class="apartament">
                                <div class="map-see-more">
                                    <div class="container py-1">
                                        <a href="/apartaments/{{ $apartament->apartament_link }}" style="width: 100%" class="btn btn-primary">{{ __("messages.book") }}</a>
                                    </div>
                                    <div class="container py-1">
                                        <a href="/apartaments/{{ $apartament->apartament_link }}" class="btn btn-primary" style="width: 100%">{{ __("messages.see details") }}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="add-to-favourities"><a href="#"><img src='{{ asset("images/results/heart.png") }}'></a></div>
                            <div class="map-description-top">112 PLN</div> 
                            <div class="map-description-bottom">śniadanie w cenie</div>
                            <div class="description-bottom-right">
                                @for ($i = 0; $i < 5; $i++)
                                    <img src='{{ asset("images/results/star.png") }}'>
                                @endfor
                                <br><span style="color: green; margin-right: 10px">Doskonały</span> <span style="color: blue">55 opinii</span>
                            </div>
                        </div>
                        <div class="description-below">
                            <span style="font-size: 17px">{{ $apartament->apartament_name }}</span>
                            <br><span style="font-size: 11px">{{ $apartament->apartament_address }}</span>
                            <div>
                                <div class="description-below-img" style="background-image: url('{{ asset("images/results/person.png") }}');"> <span>{{ $apartament->apartament_persons }}</span> </div>
                                <div class="description-below-img" style="background-image: url('{{ asset("images/results/doubleBed.png") }}');"> <span>{{ $apartament->apartament_double_beds }}</span> </div>
                                <div class="description-below-img" style="background-image: url('{{ asset("images/results/bed.png") }}');"> <span>{{ $apartament->apartament_single_beds }}</span> </div>
                                @if ( $apartament->apartament_wifi == 1)
                                    <div class="description-below-img" style="background-image: url('{{ asset("images/results/wifi.png") }}');"> </div>
                                @endif
                                @if ( $apartament->apartament_parking == 1)
                                    <div class="description-below-img" style="background-image: url('{{ asset("images/results/parking.png") }}');"> </div>
                                @endif                                                            
                            </div>
                        </div>                        
                    </div>
                    @endforeach
                </div>
<div style="text-align: right">{{ $finds->appends(['dorosli' => $request->dorosli, 'dzieci' => $request->dzieci, 'powrot' => $request->powrot, 'przyjazd' => $request->przyjazd, 'region' => $request->region])->links() }}</div>
@endsection