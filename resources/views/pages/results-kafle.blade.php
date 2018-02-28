@extends ('pages.results')
@section ('displayResults')

            <div class="row desktop-none" style="margin-bottom: 20px">
                <div class="col-9 text-mobile-search">
                    <a href="{{ route('index') }}" style="color: #00afea">Start > </a><b>{{ $finds[0]->apartament_city}}</b>, {{__('messages.from')}} {{ $_GET['przyjazd'] }}, {{__('messages.number of nights')}}: {{ $nightsCounter }}, {{__('messages.Persons')}}: {{ $_GET['dorosli']+$_GET['dzieci'] }}, {{__('messages.Filters')}}: 
                </div> 
                <div class="col-3">
                    <div  style="position: absolute; right:10px;"><a  class="btn btn-info btn-mobile filters-toggle">{{__('messages.change')}} </a></div>
                </div>
           
                @include('includes.filters-mobile')
                
            </div>
            <div class="row desktop-none">
                <div class="col-8"><h4 class="pb-2" style="display: inline">{{ $finds[0]->apartament_city}} <span class="desktop-none">({{ $counted }})</span></h4><span class="pb-2 mobile-none"> ({{ $counted }} {{trans_choice('messages.apartaments',$counted)}})</span></div>
                <div class="col-4 inline-wrapper text-right desktop-none"> <div style="position: absolute; right:10px;"   class="btn-group"><a class="btn btn-selected btn-mobile" href="/search/kafle?{{ http_build_query(Request::except('page')) }}">{{__('messages.Offers')}}</a><a class="btn btn-info btn-mobile" href="/search/mapa?{{ http_build_query(Request::except('page')) }}">{{__('messages.Map')}}</a></div></div>
            </div>
            <div style="margin-top: 15px; margin-bottom: 15px" class="desktop-none">{{__('messages.Sort by')}}:
                    <select id="u1001_input" name="sort" class="input-sm">
                        <option selected="" value="Najlepsze dopasowanie">{{__('messages.Best fit')}}</option>
                        <option value="Najniższa cena">{{__('messages.Lowest price')}}</option>
                        <option value="Najlepiej oceniane">{{__('messages.Top rated')}}</option>
                        <option value="Najpopularniejsze">{{__('messages.Most popular')}}</option>
                        <option value="Najbliżej">{{__('messages.Closest')}}</option>
                    </select>
            </div>

            <div class="row mobile-none">
                <div class="col-lg-6 col-md-12"><h3 class="pb-2">{{__('messages.found')}} {{ $counted }} {{trans_choice('messages.apartaments',$counted)}}</h3></div>
                <div class="col-12 col-lg-3 col-md-7 col-sm-12 col-xs-12">{{__('messages.Sort by')}}:
                    <select id="u1001_input" name="sort" class="input-sm">
                        <option selected="" value="Najlepsze dopasowanie">{{__('messages.Best fit')}}</option>
                        <option value="Najniższa cena">{{__('messages.Lowest price')}}</option>
                        <option value="Najlepiej oceniane">{{__('messages.Top rated')}}</option>
                        <option value="Najpopularniejsze">{{__('messages.Most popular')}}</option>
                        <option value="Najbliżej">{{__('messages.Closest')}}</option>
                    </select>
                </div>
                <div class="col-12 col-lg-3 col-md-5 col-sm-12 col-xs-12 inline-wrapper text-right"> <a class="btn btn-default" href="/search/kafle?{{ http_build_query(Request::except('page')) }}"><img class="active" src='{{ asset("images/results/kafle.png") }}'></a> <a class="btn btn-default" href="/search/lista?{{ http_build_query(Request::except('page')) }}"><img src='{{ asset("images/results/lista.png") }}'></a> <a class="btn btn-default" href="/search/mapa?{{ http_build_query(Request::except('page')) }}"><img src='{{ asset("images/results/mapa.png") }}'></a></div>
            </div>

		<div class="row">  
                    @foreach ($finds as $apartament)                        
                    <div style="overflow: auto;" class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3">
                        <div class="map-img-wrapper">

                            <div class="apartament" style="background-image: url('{{ asset("images/apartaments/$apartament->id/1.jpg") }}'); background-size: cover; position: relative; margin-bottom: 0px">
                                <div class="map-see-more mobile-none">
                                    <div class="container py-1">
                                        <a href="/apartaments/{{ $apartament->apartament_link }}" style="width: 100%" class="btn btn-primary">{{ __("messages.book") }}</a>
                                    </div>
                                    <div class="container py-1">
                                        <a href="/apartaments/{{ $apartament->apartament_link }}" class="btn btn-primary" style="width: 100%">{{ __("messages.see details") }}</a>
                                    </div>
                                </div>
                                 <div class="desktop-none" style="width: 100%; height: 100%">
                                     <a style=" display: inline-block; width: 100%; height: 100%" href="/apartaments/{{ $apartament->apartament_link }}"></a>
                                </div>
                            </div>
                            <div class="add-to-favourities"><a href="#"><img src='{{ asset("images/results/heart.png") }}'></a></div>
                            <div class="map-description-top">112 PLN</div> 
                            <div class="map-description-bottom">{{ __("messages.Breakfast included") }}</div>
                            <div class="description-bottom-right mobile-none">
                                @for ($i = 0; $i < 5; $i++)
                                    <img src='{{ asset("images/results/star.png") }}'>
                                @endfor
                                <br><span style="color: green; margin-right: 10px">{{ __("messages.Perfect") }}</span> <span style="color: blue">55 {{ __("messages.reviews_number") }}</span>
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
<div class="mobile-none" style="text-align: right">{{ $finds->appends(['dorosli' => $request->dorosli, 'dzieci' => $request->dzieci, 'powrot' => $request->powrot, 'przyjazd' => $request->przyjazd, 'region' => $request->region])->links() }}</div>
@if($countedCookies > 0)
    <h3 class="pb-2">{{__('messages.lastSeen')}}</h3>
    @include('includes.last-seen')
@endif
@endsection