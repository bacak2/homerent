@extends ('pages.results')
@section ('displayResults')
            <div class="row">
                <div class="col-lg-6 col-md-12"><h1 class="pb-2" style="font-size: 28px">@if(!$request->has('complex-only')){{ $countedApartaments }} {{trans_choice('messages.apartaments', $countedApartaments)}} {{__('messages.in')}} {{ $countedObjects }} {{trans_choice('messages.objects', $countedObjects)}} @else {{ $countedObjects }} {{trans_choice('messages.objects3', $countedObjects)}} @endif</h1></div>
                <div class="col-12 col-lg-3 col-md-7 col-sm-12 col-xs-12">{{__('messages.Sort by')}}:
                    {{ Form::select('sort', $sortSelectArray, $request->sort ?? 1, array('class'=>'input-sm', 'id'=>'u1001_input', 'onchange'=>'submitSort()'))}}
                </div>
                <div class="col-12 col-lg-3 col-md-5 col-sm-12 col-xs-12 inline-wrapper text-right"> <a class="btn" href="/search/kafle?{{ http_build_query(Request::except('page')) }}"><img data-toggle="tooltip" data-placement="bottom" title="{{__('messages.Tiles')}}" alt="{{__('messages.Tiles')}}" src='{{ asset("images/results/kafle.png") }}'></a> <a class="btn" href="/search/lista?{{ http_build_query(Request::except('page')) }}"><img class="active" data-toggle="tooltip" data-placement="bottom" title="{{__('messages.List')}}" alt="{{__('messages.List')}}" src='{{ asset("images/results/lista.png") }}'></a> <a class="btn" href="/search/mapa?{{ http_build_query(Request::except('page')) }}"><img data-toggle="tooltip" data-placement="bottom" title="{{__('messages.Map')}}" alt="{{__('messages.Map')}}" src='{{ asset("images/results/mapa.png") }}'></a></div>
            </div>
       </form>
            @foreach ($finds as $apartament)
                @if($apartament->group_id > 0 && $apartament->group_name != NULL)
                    <div class="row list-item" itemscope itemtype="http://schema.org/Hotel">
                        <div class="col-lg-3 col-md-12 col-sm-6 col-xl-3">
                            <div class="apartament" style="background-image: url('{{ asset("images/apartaments_group/$apartament->group_id/main.jpg") }}'); background-size: cover; position: relative; margin-bottom: 0px; max-width: 285px; max-height: 149px;"></div>
                        </div>
                        <div class="col-lg-7 col-md-12">
                            <div class="row list-item-name">
                                <div class="container py-1 font-weight-bold"><h2 style='font-size: 24px; display: inline; font-weight: bold' itemprop="name">{{ $apartament->group_name }}</h2>
                                    <span class="pull-right">
                                        @for ($i = 0; $i < floor($apartament->ratingAvg/2); $i++)
                                            <img class="list-item" src='{{ asset("images/results/star_list.png") }}'>
                                        @endfor
                                        @if(floor($apartament->ratingAvg/2) != ceil($apartament->ratingAvg/2))
                                            <img class="list-item" src='{{ asset("images/results/star_list_half.png") }}'>
                                        @endif
                                        @for ($i = ceil($apartament->ratingAvg/2); $i < 5; $i++)
                                            <img class="list-item" src='{{ asset("images/results/star_list_empty.png") }}'>
                                        @endfor
                                    </span>
                                </div>
                            </div>
                            <div class="row list-item-address">
                                <div class="container py-1">{{ $apartament->apartament_district }}
                                    <span class="pull-right">
                                        @if($apartament->ratingAvg < 1)
                                            <div class="row"></div>
                                        @elseif($apartament->ratingAvg < 2.5)
                                            <span class="txt-red" style="letter-spacing: -1px;"><b>{{ number_format($apartament->ratingAvg, 1, ',', ' ') }}/10</b>&nbsp;&nbsp;<span class="font-14">{{ __("messages.Awful") }}</span></span>
                                        @elseif($apartament->ratingAvg < 4.5)
                                            <span class="txt-red" style="letter-spacing: -1px;"><b>{{ number_format($apartament->ratingAvg, 1, ',', ' ') }}/10</b>&nbsp;&nbsp;<span class="font-14">{{ __("messages.Bad") }}</span></span>
                                        @elseif($apartament->ratingAvg < 6.5)
                                            <span class="txt-yellow" style="letter-spacing: -1px;"><b>{{ number_format($apartament->ratingAvg, 1, ',', ' ') }}/10</b>&nbsp;&nbsp;<span class="font-14">{{ __("messages.Average") }}</span></span>
                                        @elseif($apartament->ratingAvg < 8.5)
                                            <span class="txt-green" style="letter-spacing: -1px;"><b>{{ number_format($apartament->ratingAvg, 1, ',', ' ') }}/10</b>&nbsp;&nbsp;<span class="font-14">{{ __("messages.Very good") }}</span></span>
                                        @else
                                            <span class="txt-green" style="letter-spacing: -1px;"><b>{{ number_format($apartament->ratingAvg, 1, ',', ' ') }}/10</b>&nbsp;&nbsp;<span class="font-14">{{ __("messages.Perfect") }}</span></span>
                                        @endif
                                        <span style="color: blue; font-size: 10px">{{$apartament->opinionAmount ?? 0}} {{trans_choice('messages.nrReviews', $apartament->opinionAmount ?? 0)}}</span>
                                    </span>
                                </div>
                            </div>
                            <div class="row list-item-address">
                                <div class="container py-1" itemprop="streetAddress">{{ $apartament->apartament_address }}</div>
                            </div>
                            <div class="row list-item-description">
                                <div class="container py-1">{{ substr($apartament->apartament_description, 0, 220) }}...</div>
                            </div>
                            <div class="row list-item-icons">
                                <div class="col-6 container py-1">
                                    <div class="description-below-img" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.people') }}" style="background-image: url('{{ asset("images/results/person.png") }}');"> <span>{{ $apartament->apartament_persons }}</span> </div>
                                    <div class="description-below-img" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.double beds') }}" style="background-image: url('{{ asset("images/results/doubleBed.png") }}');"> <span>{{ $apartament->apartament_double_beds }}</span> </div>
                                    <div class="description-below-img" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.single beds') }}" style="background-image: url('{{ asset("images/results/bed.png") }}');"> <span>{{ $apartament->apartament_single_beds }}</span> </div>
                                    @if ( $apartament->apartament_wifi == 1)
                                        <div class="description-below-img" data-toggle="tooltip" data-placement="bottom" title="Wifi" style="background-image: url('{{ asset("images/results/wifi.png") }}');"> </div>
                                    @endif
                                    @if ( $apartament->apartament_parking == 1)
                                        <div class="description-below-img" data-toggle="tooltip" data-placement="bottom" title="Parking" style="background-image: url('{{ asset("images/results/parking.png") }}');"> </div>
                                    @endif
                                </div>
                                @if(!empty($apartament->lastReservationDate))
                                    <div class="col-6 list-item-last-reservation">
                                        {{ __("messages.Last reservation") }} {{countLastReservationDiff($apartament->lastReservationDate)}} {{ __("messages.hours ago") }}
                                    </div>
                                 @else
                                    <div class="col-6">&nbsp;</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-2 pl-0">
                            <div class="row">
                                <div class="container py-1 text-right font-weight-bold"><h3 style="font-size: 26px">{{__('messages.from')}} {{ $apartament->min_price }} zł</h3></div>
                            </div>
                            <div class="row">
                                <div class="container py-1" ><a href="/apartaments-group/{{ $apartament->group_link }}?{{ http_build_query(Request::except('page', 'region', '_token')) }}" class="btn btn-see-more ml-2" style="width: 100%">{{ __('messages.see apartments') }}</a></div>
                            </div>
                            <div class="row">
                                <div class="container py-1 text-right font-weight-bold"><h4 style="font-size: 18px">{{ $apartament->apartaments_amount }} {{trans_choice('messages.nrApartmentsInKomplex', $apartament->apartaments_amount)}}</h4></div>
                            </div>
                        </div>
                    </div>
                @elseif($apartament->group_name == NULL)
                    <div class="row list-item" itemscope itemtype="http://schema.org/Hotel">
                        <div class="col-lg-3 col-md-12 col-sm-6 col-xl-3">
                            <div class="apartament" style="background-image: url('{{ asset("images/apartaments/$apartament->id/main.jpg") }}'); background-size: cover; position: relative; margin-bottom: 0px; max-width: 285px; max-height: 149px;">
                                <div class="list-item-description-bottom">{{ __("messages.Breakfast included") }}</div>
                                <div class="add-to-favourities"><span onClick="addToFavourites({{$apartament->id}}, {{Auth::user()->id ?? 0}})"><img src='{{ asset("images/results/heart.png") }}'></span></div>
                            </div>
                        </div>

                        <div class="col-lg-7 col-md-12">
                            <div class="row list-item-name">
                                <div class="container py-1 font-weight-bold"><h2 style='font-size: 24px; display: inline; font-weight: bold' itemprop="name">{{ $apartament->apartament_name }}</h2>
                                    <span class="pull-right">
                                        @for ($i = 0; $i < floor($apartament->ratingAvg/2); $i++)
                                            <img class="list-item" src='{{ asset("images/results/star_list.png") }}'>
                                        @endfor
                                        @if(floor($apartament->ratingAvg/2) != ceil($apartament->ratingAvg/2))
                                            <img class="list-item" src='{{ asset("images/results/star_list_half.png") }}'>
                                        @endif
                                        @for ($i = ceil($apartament->ratingAvg/2); $i < 5; $i++)
                                            <img class="list-item" src='{{ asset("images/results/star_list_empty.png") }}'>
                                        @endfor
                                    </span>
                                </div>
                            </div>
                            <div class="row list-item-address">
                                <div class="container py-1">{{ $apartament->apartament_district }}
                                    <span class="pull-right">
                                        @if($apartament->ratingAvg < 1)
                                            <div class="row"></div>
                                        @elseif($apartament->ratingAvg < 2.5)
                                            <span class="txt-red" style="letter-spacing: -1px;"><b>{{ number_format($apartament->ratingAvg, 1, ',', ' ') }}/10</b>&nbsp;&nbsp;<span class="font-14">{{ __("messages.Awful") }}</span></span>
                                        @elseif($apartament->ratingAvg < 4.5)
                                            <span class="txt-red" style="letter-spacing: -1px;"><b>{{ number_format($apartament->ratingAvg, 1, ',', ' ') }}/10</b>&nbsp;&nbsp;<span class="font-14">{{ __("messages.Bad") }}</span></span>
                                        @elseif($apartament->ratingAvg < 6.5)
                                            <span class="txt-yellow" style="letter-spacing: -1px;"><b>{{ number_format($apartament->ratingAvg, 1, ',', ' ') }}/10</b>&nbsp;&nbsp;<span class="font-14">{{ __("messages.Average") }}</span></span>
                                        @elseif($apartament->ratingAvg < 8.5)
                                            <span class="txt-green" style="letter-spacing: -1px;"><b>{{ number_format($apartament->ratingAvg, 1, ',', ' ') }}/10</b>&nbsp;&nbsp;<span class="font-14">{{ __("messages.Very good") }}</span></span>
                                        @else
                                            <span class="txt-green" style="letter-spacing: -1px;"><b>{{ number_format($apartament->ratingAvg, 1, ',', ' ') }}/10</b>&nbsp;&nbsp;<span class="font-14">{{ __("messages.Perfect") }}</span></span>
                                        @endif
                                        <span style="color: blue; font-size: 10px">{{$apartament->opinionAmount ?? 0}} {{trans_choice('messages.nrReviews', $apartament->opinionAmount ?? 0)}}</span>
                                    </span>
                                </div>
                            </div>
                            <div class="row list-item-address">
                                <div class="container py-1" itemprop="streetAddress">{{ $apartament->apartament_address }}</div>
                            </div>
                            <div class="row list-item-description">
                                <div class="container py-1">{{ substr($apartament->apartament_description, 0, 220) }}...</div>
                            </div>
                            <div class="row list-item-icons">
                                <div class="col-6 container py-1">
                                    <div class="description-below-img" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.people') }}" style="background-image: url('{{ asset("images/results/person.png") }}');"> <span>{{ $apartament->apartament_persons }}</span> </div>
                                    <div class="description-below-img" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.double beds') }}" style="background-image: url('{{ asset("images/results/doubleBed.png") }}');"> <span>{{ $apartament->apartament_double_beds }}</span> </div>
                                    <div class="description-below-img" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.single beds') }}" style="background-image: url('{{ asset("images/results/bed.png") }}');"> <span>{{ $apartament->apartament_single_beds }}</span> </div>
                                    @if ( $apartament->apartament_wifi == 1)
                                        <div class="description-below-img" data-toggle="tooltip" data-placement="bottom" title="Wifi" style="background-image: url('{{ asset("images/results/wifi.png") }}');"> </div>
                                    @endif
                                    @if ( $apartament->apartament_parking == 1)
                                        <div class="description-below-img" data-toggle="tooltip" data-placement="bottom" title="Parking" style="background-image: url('{{ asset("images/results/parking.png") }}');"> </div>
                                    @endif
                                </div>
                                @if(!empty($apartament->lastReservationDate))
                                    <div class="col-6 list-item-last-reservation">
                                        <?php
                                        $date1 = new DateTime($apartament->lastReservationDate);
                                        $date2 = new DateTime('now');

                                        $diff = $date2->diff($date1);

                                        $hours = $diff->h;
                                        $hours = $hours + ($diff->days*24);
                                        ?>
                                        {{ __("messages.Last reservation") }} {{$hours}} {{ __("messages.hours ago") }}
                                    </div>
                                @else
                                    <div class="col-6">&nbsp;</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-2 pl-0">
                            <div class="row">
                                <div class="container py-1 text-right font-weight-bold"><h3 style="font-size: 26px">{{__('messages.from')}} {{ $apartament->min_price }} zł</h3></div>
                            </div>
                            <div class="row">
                                <div class="container py-1" ><a href="/reservations?link={{ $apartament->apartament_link }}&id={{ $apartament->apartament_id }}&t-start={{$_GET['t-start']}}&t-end={{$_GET['t-end']}}&dorosli={{ $request->dorosli }}&dzieci={{ $request->dzieci }}"  class="btn btn-primary ml-2" style="width: 100%">{{ __('messages.book') }}</a></div>
                            </div>
                            <div class="row">
                                <div class="container py-1" ><a href="/apartaments/{{ $apartament->apartament_link }}?{{ http_build_query(Request::except('page', 'region')) }}" class="btn btn-see-more ml-2" style="width: 100%">{{ __('messages.see details') }}</a></div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
            
<div style="text-align: right">{{ $finds->appends(['dorosli' => $request->dorosli, 'dzieci' => $request->dzieci, 't-end' => $_GET['t-end'], 't-start' => $_GET['t-start'], 'region' => $request->region, 'sort' => $request->sort ?? ''])->links('vendor.pagination.simple-default', ['elements' => $elements, 'view' => $view]) }}</div>
<span class="mobile-none">
@if($countedCookies > 0)
    <h3 class="pb-2" style="margin-top: 40px; font-size: 26px">{{__('messages.lastSeen')}}</h3>
    @include('includes.last-seen')
@endif
</span>

<script>


    function submitSort(){
        if($("#u1001_input").val() == 5){
            if(navigator.geolocation){
                navigator.geolocation.getCurrentPosition(
                    function (position) {
                        $('<input>').attr('type', 'hidden')
                            .attr('name', "latitude")
                            .attr('value', position.coords.latitude)
                            .appendTo('#wyszukiwarka');

                        $('<input>').attr('type', 'hidden')
                            .attr('name', "longitude")
                            .attr('value', position.coords.longitude)
                            .appendTo('#wyszukiwarka');
                        $("#wyszukiwarka").submit();
                    }
                );
            }else{
                alert("{{__('messages.GeoNotSupported')}}");
                return false;
            }
        }
        else $("#wyszukiwarka").submit();
    }
</script>

@if($favouritesAmount == 0 && Auth::check())
    @include('includes.favourites-first-added-popup')
@endif

@endsection