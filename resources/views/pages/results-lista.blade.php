@extends ('pages.results')
@section ('displayResults')
            <div class="row">
                <div class="col-lg-6 col-md-12"><h3 class="pb-2">{{__('messages.found')}} {{ $counted }} {{trans_choice('messages.apartaments',$counted)}}</h3></div>
                <div class="col-12 col-lg-3 col-md-7 col-sm-12 col-xs-12">{{__('messages.Sort by')}}:
                    <select id="u1001_input" name="sort">
                        <option selected="" value="Najlepsze dopasowanie">{{__('messages.Best fit')}}</option>
                        <option value="Najniższa cena">{{__('messages.Lowest price')}}</option>
                        <option value="Najlepiej oceniane">{{__('messages.Top rated')}}</option>
                        <option value="Najpopularniejsze">{{__('messages.Most popular')}}</option>
                        <option value="Najbliżej">{{__('messages.Closest')}}</option>
                    </select>
                </div>
                <div class="col-12 col-lg-3 col-md-5 col-sm-12 col-xs-12 inline-wrapper text-right"> <a class="btn btn-default" href="/search/kafle?{{ http_build_query(Request::except('page')) }}"><img src='{{ asset("images/results/kafle.png") }}'></a> <a class="btn btn-default" href="/search/lista?{{ http_build_query(Request::except('page')) }}"><img class="active" src='{{ asset("images/results/lista.png") }}'></a> <a class="btn btn-default" href="/search/mapa?{{ http_build_query(Request::except('page')) }}"><img src='{{ asset("images/results/mapa.png") }}'></a></div>
            </div>
            @foreach ($finds as $apartament)
		<div class="row list-item">
                    <div class="col-lg-3 col-md-12 col-sm-6 col-xl-3">
                        <div class="apartament" style="background-image: url('{{ asset("images/apartaments/$apartament->id/1.jpg") }}'); background-size: cover; position: relative; margin-bottom: 0px; max-width: 285px; max-height: 149px;">
                            <div class="list-item-description-bottom">{{ __("messages.Breakfast included") }}</div>
                            <div class="add-to-favourities"><a href="#"><img src='{{ asset("images/results/heart.png") }}'></a></div>
                        </div>
                    </div>
                    
                    <div class="col-lg-7 col-md-12">
                        <div class="row list-item-name">
                            <div class="container py-1 font-weight-bold"><span style='font-size: 24px'>{{ $apartament->apartament_name }}</span>
                                <span class="pull-right">
                                @for ($i = 0; $i < 5; $i++)
                                    <img class="list-item" src='{{ asset("images/results/star_list.png") }}'>
                                @endfor
                                </span>
                            </div>
                        </div>
                        <div class="row list-item-address">
                            <div class="container py-1">{{ $apartament->apartament_address }}
                                <span class="pull-right">
                                    <span style="color: green; letter-spacing: -1px;"><b>8,3/10</b> <span style="font-size: 14px">{{ __("messages.Perfect") }}</span></span> <span style="color: blue; font-size: 10px">55 {{ __("messages.reviews_number") }}</span>
                                </span>
                            </div>
                            
                        </div>
                        <div class="row list-item-description">
                            <div class="container py-1">{{ substr($apartament->apartament_description, 0, 220) }}...</div>
                        </div>
                        <div class="row list-item-icons">
                            <div class="col-6 container py-1">
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
                            <div class="col-6 list-item-last-reservation">
                                {{ __("messages.Last reservation") }} 2 {{ __("messages.hours ago") }}
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-12">
                        <div class="row">
                            <div class="container py-1 text-right font-weight-bold"><h3>{{__('messages.from')}} 122 zł</h3></div>
                        </div>
                        <div class="row">
                            <div class="container py-1" ><a href="/apartaments/{{ $apartament->apartament_link }}" class="btn btn-primary ml-2" style="width: 100%">{{ __('messages.book') }}</a></div>
                        </div>
                        <div class="row">
                            <div class="container py-1" ><a href="/apartaments/{{ $apartament->apartament_link }}" class="btn btn-primary ml-2" style="width: 100%">{{ __('messages.see details') }}</a></div>
                        </div>
                    </div>
		</div>
            @endforeach
            
<div style="text-align: right">{{ $finds->appends(['dorosli' => $request->dorosli, 'dzieci' => $request->dzieci, 'powrot' => $request->powrot, 'przyjazd' => $request->przyjazd, 'region' => $request->region])->links() }}</div>
<span class="mobile-none">
@if($countedCookies > 0)
    <h3 class="pb-2" style="margin-top: 40px">{{__('messages.lastSeen')}}</h3>
    @include('includes.last-seen')
@endif
</span>
@endsection