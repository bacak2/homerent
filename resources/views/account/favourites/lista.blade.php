@extends ('account.favourites.layout')

@section('fav-title', __('messages.List'))

@section('icons-active')
    <a class="btn" href="{{ route('myFavourites') }}?{{ http_build_query(Request::except('_token')) }}"><img data-toggle="tooltip" data-placement="bottom" title="{{__('messages.Tiles')}}" alt="{{__('messages.Tiles')}}" src='{{ asset("images/results/kafle.png") }}'></a>
    <a class="btn" href="{{ route('myFavouritesList') }}?{{ http_build_query(Request::except('_token')) }}"><img class="active" data-toggle="tooltip" data-placement="bottom" title="{{__('messages.List')}}" alt="{{__('messages.List')}}" src='{{ asset("images/results/lista.png") }}'></a>
    <a class="btn" href="{{ route('myFavouritesMap') }}?{{ http_build_query(Request::except('_token')) }}"><img data-toggle="tooltip" data-placement="bottom" title="{{__('messages.Map')}}" alt="{{__('messages.Map')}}" src='{{ asset("images/results/mapa.png") }}'></a>
    <a href="{{ route('myFavouritesCompare') }}?{{ http_build_query(Request::except('_token')) }}">{{__('messages.Compare')}}</a>
@endsection

@section('if-has-przyjazd')
    @if(!$request->has('t-start'))
        <div class="row mx-0">
            @foreach ($finds as $apartament)
                <div class="row list-item" itemscope itemtype="http://schema.org/Hotel">
                    <div class="col-lg-3 col-md-12 col-sm-6 col-xl-3">
                        <div class="apartament" style="background-image: url('{{ asset("images/apartaments/$apartament->id/main.jpg") }}'); background-size: cover; position: relative; margin-bottom: 0px; max-width: 285px; max-height: 149px;">
                            <div class="list-item-description-bottom">{{ __("messages.Breakfast included") }}</div>
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
                                <div class="description-below-img" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.single beds') }}" style="background-image: url('{{ asset("images/results/doubleBed.png") }}');"> <span>{{ $apartament->apartament_double_beds }}</span> </div>
                                <div class="description-below-img" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.double beds') }}" style="background-image: url('{{ asset("images/results/bed.png") }}');"> <span>{{ $apartament->apartament_single_beds }}</span> </div>
                                @if ( $apartament->apartament_wifi == 1)
                                    <div class="description-below-img" data-toggle="tooltip" data-placement="bottom" title="Wifi" style="background-image: url('{{ asset("images/results/wifi.png") }}');"> </div>
                                @endif
                                @if ( $apartament->apartament_parking == 1)
                                    <div class="description-below-img" data-toggle="tooltip" data-placement="bottom" title="Parking" style="background-image: url('{{ asset("images/results/parking.png") }}');"> </div>
                                @endif
                            </div>
                            <div class="col-6 list-item-last-reservation" style="visibility: hidden">
                                {{ __("messages.Last reservation") }} 2 {{ __("messages.hours ago") }}
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-12">
                        <div class="row">
                            <div class="container py-1 text-right font-weight-bold"><h3 style="font-size: 26px">{{__('messages.from')}} {{ $apartament->min_price }} zł</h3></div>
                        </div>
                        <div class="row">
                            <div class="container py-1" ><a href="/apartaments/{{ $apartament->apartament_link }}" class="btn btn-see-more ml-2" style="width: 100%">{{ __('messages.see details') }}</a></div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="row mx-0">
            @foreach ($finds as $apartament)
                <div class="row list-item" itemscope itemtype="http://schema.org/Hotel">
                    <div class="col-lg-3 col-md-12 col-sm-6 col-xl-3">
                        <div class="apartament" style="background-image: url('{{ asset("images/apartaments/$apartament->id/main.jpg") }}'); background-size: cover; position: relative; margin-bottom: 0px; max-width: 285px; max-height: 149px;">
                            <div class="list-item-description-bottom">{{ __("messages.Breakfast included") }}</div>
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
                                <div class="description-below-img" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.single beds') }}" style="background-image: url('{{ asset("images/results/doubleBed.png") }}');"> <span>{{ $apartament->apartament_double_beds }}</span> </div>
                                <div class="description-below-img" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.double beds') }}" style="background-image: url('{{ asset("images/results/bed.png") }}');"> <span>{{ $apartament->apartament_single_beds }}</span> </div>
                                @if ( $apartament->apartament_wifi == 1)
                                    <div class="description-below-img" data-toggle="tooltip" data-placement="bottom" title="Wifi" style="background-image: url('{{ asset("images/results/wifi.png") }}');"> </div>
                                @endif
                                @if ( $apartament->apartament_parking == 1)
                                    <div class="description-below-img" data-toggle="tooltip" data-placement="bottom" title="Parking" style="background-image: url('{{ asset("images/results/parking.png") }}');"> </div>
                                @endif
                            </div>
                            <div class="col-6 list-item-last-reservation" style="visibility: hidden">
                                {{ __("messages.Last reservation") }} 2 {{ __("messages.hours ago") }}
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-12">
                        <div class="row">
                            <div class="container py-1 text-right font-weight-bold"><h3 style="font-size: 26px">{{__('messages.from')}} {{ $apartament->min_price }} zł</h3></div>
                        </div>
                        <div class="row">
                            <div class="container py-1" ><a href="/reservations?link={{ $apartament->apartament_link }}&id={{ $apartament->apartament_id }}&t-start={{ $_GET['t-start'] }}&t-end={{ $_GET['t-end'] }}&dorosli={{ $request->dorosli }}&dzieci={{ $request->dzieci }}" class="btn btn-primary ml-2" style="width: 100%">{{ __('messages.book') }}</a></div>
                        </div>
                        <div class="row">
                            <div class="container py-1" ><a href="/apartaments/{{ $apartament->apartament_link }}?t-start={{ $_GET['t-start'] }}&t-end={{ $_GET['t-end'] }}&dorosli={{ $request->dorosli }}&dzieci={{ $request->dzieci }}" class="btn btn-see-more ml-2" style="width: 100%">{{ __('messages.see details') }}</a></div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection

@section('script')
<script>
    $("#enterTerm").on('click', function(){
        $("div.results-search").show();
        $("#eneterTermRow").hide();
    });
</script>
@endsection