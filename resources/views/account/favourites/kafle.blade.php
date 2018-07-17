@extends ('account.favourites.layout')

@section('fav-title', 'Kafle')

@section('icons-active')
    <a class="btn btn-default" href="{{ route('myFavourites') }}"><img class="active" data-toggle="tooltip" data-placement="bottom" title="Kafle" alt="Kafle" src='{{ asset("images/results/kafle.png") }}'></a>
    <a class="btn btn-default" href="{{ route('myFavouritesList') }}"><img data-toggle="tooltip" data-placement="bottom" title="Lista" alt="Lista" src='{{ asset("images/results/lista.png") }}'></a>
    <a class="btn btn-default" href="{{ route('myFavouritesMap') }}"><img data-toggle="tooltip" data-placement="bottom" title="Mapa" alt="Mapa" src='{{ asset("images/results/mapa.png") }}'></a>
    <a href="{{ route('myFavouritesCompare') }}">Porównaj</a>
@endsection

@section('if-has-przyjazd')
    @if(!$request->has('przyjazd'))
        <div class="row">
            @foreach ($finds as $apartament)
                <div style="overflow: auto;" class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3" itemscope itemtype="http://schema.org/Hotel">
                    <div class="map-img-wrapper">

                        <div class="apartament" style="background-image: url('{{ asset("images/apartaments/$apartament->id/1.jpg") }}'); background-size: cover; position: relative; margin-bottom: 0px">
                            <div class="map-see-more mobile-none">
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
                            @for ($i = 0; $i < floor($apartament->ratingAvg/2); $i++)
                                <img src='{{ asset("images/results/star.png") }}'>
                            @endfor
                            @if(floor($apartament->ratingAvg/2) != ceil($apartament->ratingAvg/2))
                                <img src='{{ asset("images/results/star_half.png") }}'>
                            @endif
                            @for ($i = ceil($apartament->ratingAvg/2); $i < 5; $i++)
                                <img src='{{ asset("images/results/star_empty.png") }}'>
                            @endfor
                            <br>
                                @if($apartament->ratingAvg < 1)
                                    <span class="opinion-to-left" style="margin-right: 10px;"></span>
                                @elseif($apartament->ratingAvg < 2.5)
                                    <span class="opinion-to-left txt-red" style="margin-right: 10px;">{{ __("messages.Awful") }}</span>
                                @elseif($apartament->ratingAvg < 4.5)
                                    <span class="opinion-to-left txt-red" style="margin-right: 10px;">{{ __("messages.Bad") }}</span>
                                @elseif($apartament->ratingAvg < 6.5)
                                    <span class="opinion-to-left txt-yellow" style="margin-right: 10px;">{{ __("messages.Average") }}</span>
                                @elseif($apartament->ratingAvg < 8.5)
                                    <span class="opinion-to-left txt-green" style="margin-right: 10px;">{{ __("messages.Very good") }}</span>
                                @else
                                    <span class="opinion-to-left txt-green" style="margin-right: 10px;">{{ __("messages.Perfect") }}</span>
                                @endif

                            <span class="txt-blue nr-reviews-right">{{$apartament->opinionAmount ?? 0}} {{trans_choice('messages.nrReviews', $apartament->opinionAmount ?? 0)}}</span>
                        </div>
                    </div>
                    <div class="description-below" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
                        <span style="font-size: 17px" itemprop="name">{{ $apartament->apartament_name }}</span>
                        <span style="display:block; font-size: 11px">{{ $apartament->apartament_district }}</span>
                        <span style="display:block; font-size: 11px" itemprop="streetAddress">{{ $apartament->apartament_address }}</span>
                        <div class="mt-2">
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
                        <div class="description-map-bottom-right desktop-none">
                            @for ($i = 0; $i < floor($apartament->ratingAvg/2); $i++)
                                <img src='{{ asset("images/results/star.png") }}'>
                            @endfor
                            @if(floor($apartament->ratingAvg/2) != ceil($apartament->ratingAvg/2))
                                <img src='{{ asset("images/results/star_half.png") }}'>
                            @endif
                            @for ($i = ceil($apartament->ratingAvg/2); $i < 5; $i++)
                                <img src='{{ asset("images/results/star_empty.png") }}'>
                            @endfor
                            <br>
                            @if($apartament->ratingAvg < 1)
                                <span class="opinion-to-left" style="margin-right: 10px;"></span>
                            @elseif($apartament->ratingAvg < 2.5)
                                <span class="opinion-to-left txt-red" style="margin-right: 10px;">{{ __("messages.Awful") }}</span>
                            @elseif($apartament->ratingAvg < 4.5)
                                <span class="opinion-to-left txt-red" style="margin-right: 10px;">{{ __("messages.Bad") }}</span>
                            @elseif($apartament->ratingAvg < 6.5)
                                <span class="opinion-to-left txt-yellow" style="margin-right: 10px;">{{ __("messages.Average") }}</span>
                            @elseif($apartament->ratingAvg < 8.5)
                                <span class="opinion-to-left txt-green" style="margin-right: 10px;">{{ __("messages.Very good") }}</span>
                            @else
                                <span class="opinion-to-left txt-green" style="margin-right: 10px;">{{ __("messages.Perfect") }}</span>
                            @endif
                            <span class="txt-blue nr-reviews-right">{{$apartament->opinionAmount ?? 0}} {{trans_choice('messages.nrReviews', $apartament->opinionAmount ?? 0)}}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="row">
            @foreach ($finds as $apartament)
                @if($apartament->group_id > 0 && $apartament->group_name != NULL)
                    <div style="overflow: auto;" class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3" itemscope itemtype="http://schema.org/Hotel">
                        <div class="map-img-wrapper">
                            <div class="apartament" style="background-image: url('{{ asset("images/apartaments/$apartament->id/1.jpg") }}'); background-size: cover; position: relative; margin-bottom: 0px">
                                <div class="map-see-more mobile-none">
                                    <div class="container py-1">
                                        <a href="/apartaments-group/{{ $apartament->group_link }}" class="btn btn-primary" style="width: 100%">{{ __("messages.see details") }}</a>
                                    </div>
                                </div>
                                <div class="desktop-none" style="width: 100%; height: 100%">
                                    <a style=" display: inline-block; width: 100%; height: 100%" href="/apartaments-group/{{ $apartament->group_link }}"></a>
                                </div>
                            </div>
                            <div class="komplex-description-top">{{ $apartament->apartaments_amount }} {{trans_choice('messages.nrApartmentsInKomplex', $apartament->apartaments_amount)}} {{__('messages.from')}} {{ $apartament->min_price }} PLN</div>
                            <div class="description-bottom-right mobile-none">
                                @for ($i = 0; $i < floor($apartament->ratingAvg/2); $i++)
                                    <img src='{{ asset("images/results/star.png") }}'>
                                @endfor
                                @if(floor($apartament->ratingAvg/2) != ceil($apartament->ratingAvg/2))
                                    <img src='{{ asset("images/results/star_half.png") }}'>
                                @endif
                                @for ($i = ceil($apartament->ratingAvg/2); $i < 5; $i++)
                                    <img src='{{ asset("images/results/star_empty.png") }}'>
                                @endfor
                                <br>
                                    @if($apartament->ratingAvg < 1)
                                        <span class="opinion-to-left" style="margin-right: 10px;"></span>
                                    @elseif($apartament->ratingAvg < 2.5)
                                        <span class="opinion-to-left txt-red" style="margin-right: 10px;">{{ __("messages.Awful") }}</span>
                                    @elseif($apartament->ratingAvg < 4.5)
                                        <span class="opinion-to-left txt-red" style="margin-right: 10px;">{{ __("messages.Bad") }}</span>
                                    @elseif($apartament->ratingAvg < 6.5)
                                        <span class="opinion-to-left txt-yellow" style="margin-right: 10px;">{{ __("messages.Average") }}</span>
                                    @elseif($apartament->ratingAvg < 8.5)
                                        <span class="opinion-to-left txt-green" style="margin-right: 10px;">{{ __("messages.Very good") }}</span>
                                    @else
                                        <span class="opinion-to-left txt-green" style="margin-right: 10px;">{{ __("messages.Perfect") }}</span>
                                    @endif

                                    <span class="txt-blue nr-reviews-right">{{$apartament->opinionAmount ?? 0}} {{trans_choice('messages.nrReviews', $apartament->opinionAmount ?? 0)}}</span>
                            </div>
                        </div>
                        <div class="description-below" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
                            <span style="font-size: 17px" itemprop="name">{{ $apartament->group_name }}</span>
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
                                @for ($i = 0; $i < floor($apartament->ratingAvg/2); $i++)
                                    <img src='{{ asset("images/results/star.png") }}'>
                                @endfor
                                @if(floor($apartament->ratingAvg/2) != ceil($apartament->ratingAvg/2))
                                    <img src='{{ asset("images/results/star_half.png") }}'>
                                @endif
                                @for ($i = ceil($apartament->ratingAvg/2); $i < 5; $i++)
                                    <img src='{{ asset("images/results/star_empty.png") }}'>
                                @endfor
                                <br>
                                @if($apartament->ratingAvg < 1)
                                    <span class="opinion-to-left" style="margin-right: 10px;"></span>
                                @elseif($apartament->ratingAvg < 2.5)
                                    <span class="opinion-to-left txt-red" style="margin-right: 10px;">{{ __("messages.Awful") }}</span>
                                @elseif($apartament->ratingAvg < 4.5)
                                    <span class="opinion-to-left txt-red" style="margin-right: 10px;">{{ __("messages.Bad") }}</span>
                                @elseif($apartament->ratingAvg < 6.5)
                                    <span class="opinion-to-left txt-yellow" style="margin-right: 10px;">{{ __("messages.Average") }}</span>
                                @elseif($apartament->ratingAvg < 8.5)
                                    <span class="opinion-to-left txt-green" style="margin-right: 10px;">{{ __("messages.Very good") }}</span>
                                @else
                                    <span class="opinion-to-left txt-green" style="margin-right: 10px;">{{ __("messages.Perfect") }}</span>
                                @endif

                                <span class="txt-blue nr-reviews-right">{{$apartament->opinionAmount ?? 0}} {{trans_choice('messages.nrReviews', $apartament->opinionAmount ?? 0)}}</span>
                            </div>
                        </div>
                    </div>
                @elseif($apartament->group_name == NULL)
                    <div style="overflow: auto;" class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3" itemscope itemtype="http://schema.org/Hotel">
                        <div class="map-img-wrapper">

                            <div class="apartament" style="background-image: url('{{ asset("images/apartaments/$apartament->id/1.jpg") }}'); background-size: cover; position: relative; margin-bottom: 0px">
                                <div class="map-see-more mobile-none">
                                    <div class="container py-1">

                                        <a href="/reservations?link={{ $apartament->apartament_link }}&id={{ $apartament->apartament_id }}&przyjazd={{ $request->przyjazd }}&powrot={{ $request->powrot }}&dorosli={{ $request->dorosli }}&dzieci={{ $request->dzieci }}" style="width: 100%" class="btn btn-primary">{{ __("messages.book") }}</a>
                                    </div>
                                    <div class="container py-1">
                                        <a href="/apartaments/{{ $apartament->apartament_link }}" class="btn btn-primary" style="width: 100%">{{ __("messages.see details") }}</a>
                                    </div>
                                </div>
                                <div class="desktop-none" style="width: 100%; height: 100%">
                                    <a style=" display: inline-block; width: 100%; height: 100%" href="/apartaments/{{ $apartament->apartament_link }}"></a>
                                </div>
                            </div>
                            <div class="add-to-favourities"><span onClick="addToFavourites({{$apartament->id}}, {{Auth::user()->id ?? 0}})"><img data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Add to favorites') }}" src='{{ asset("images/results/heart.png") }}'></span></div>

                            <div class="map-description-top">{{ $apartament->min_price }} PLN</div>
                            <div class="map-description-bottom">{{ __("messages.Breakfast included") }}</div>
                            <div class="description-bottom-right mobile-none">
                                @for ($i = 0; $i < floor($apartament->ratingAvg/2); $i++)
                                    <img src='{{ asset("images/results/star.png") }}'>
                                @endfor
                                @if(floor($apartament->ratingAvg/2) != ceil($apartament->ratingAvg/2))
                                    <img src='{{ asset("images/results/star_half.png") }}'>
                                @endif
                                @for ($i = ceil($apartament->ratingAvg/2); $i < 5; $i++)
                                    <img src='{{ asset("images/results/star_empty.png") }}'>
                                @endfor
                                <br>
                                @if($apartament->ratingAvg < 1)
                                    <span class="opinion-to-left" style="margin-right: 10px;"></span>
                                @elseif($apartament->ratingAvg < 2.5)
                                    <span class="opinion-to-left txt-red" style="margin-right: 10px;">{{ __("messages.Awful") }}</span>
                                @elseif($apartament->ratingAvg < 4.5)
                                    <span class="opinion-to-left txt-red" style="margin-right: 10px;">{{ __("messages.Bad") }}</span>
                                @elseif($apartament->ratingAvg < 6.5)
                                    <span class="opinion-to-left txt-yellow" style="margin-right: 10px;">{{ __("messages.Average") }}</span>
                                @elseif($apartament->ratingAvg < 8.5)
                                    <span class="opinion-to-left txt-green" style="margin-right: 10px;">{{ __("messages.Very good") }}</span>
                                @else
                                    <span class="opinion-to-left txt-green" style="margin-right: 10px;">{{ __("messages.Perfect") }}</span>
                                @endif

                                <span class="txt-blue nr-reviews-right">{{$apartament->opinionAmount ?? 0}} {{trans_choice('messages.nrReviews', $apartament->opinionAmount ?? 0)}}</span>
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
                                @for ($i = 0; $i < floor($apartament->ratingAvg/2); $i++)
                                    <img src='{{ asset("images/results/star.png") }}'>
                                @endfor
                                @if(floor($apartament->ratingAvg/2) != ceil($apartament->ratingAvg/2))
                                    <img src='{{ asset("images/results/star_half.png") }}'>
                                @endif
                                @for ($i = ceil($apartament->ratingAvg/2); $i < 5; $i++)
                                    <img src='{{ asset("images/results/star_empty.png") }}'>
                                @endfor
                                <br>
                                @if($apartament->ratingAvg < 1)
                                    <span class="opinion-to-left" style="margin-right: 10px;"></span>
                                @elseif($apartament->ratingAvg < 2.5)
                                    <span class="opinion-to-left txt-red" style="margin-right: 10px;">{{ __("messages.Awful") }}</span>
                                @elseif($apartament->ratingAvg < 4.5)
                                    <span class="opinion-to-left txt-red" style="margin-right: 10px;">{{ __("messages.Bad") }}</span>
                                @elseif($apartament->ratingAvg < 6.5)
                                    <span class="opinion-to-left txt-yellow" style="margin-right: 10px;">{{ __("messages.Average") }}</span>
                                @elseif($apartament->ratingAvg < 8.5)
                                    <span class="opinion-to-left txt-green" style="margin-right: 10px;">{{ __("messages.Very good") }}</span>
                                @else
                                    <span class="opinion-to-left txt-green" style="margin-right: 10px;">{{ __("messages.Perfect") }}</span>
                                @endif

                                <span class="txt-blue nr-reviews-right">{{$apartament->opinionAmount ?? 0}} {{trans_choice('messages.nrReviews', $apartament->opinionAmount ?? 0)}}</span>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    @endif
@endsection

@section('script')
    <script type="text/javascript">
        if($(window).width() < 767) {
            $('#pagination').hide();
            $(function () {
                $('.infinite-scroll').jscroll({
                    autoTrigger: true,
                    debug: true,
                    loadingHtml: '<div class="text-center"><img class="img-loader" src="{{ asset('images/results/loader.gif') }}" alt="Loading..." /></div>',
                    padding: 0,
                    nextSelector: '.pagination li.active + li a',
                    contentSelector: '.infinite-scroll',
                    callback: function () {
                        $('ul.pagination').remove();
                    }
                });
            });
        }
    </script>
@endsection