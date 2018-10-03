@extends ('account.favourites.layout')

@section('fav-title', __('messages.Comparison'))

@section('icons-active')
    <a class="btn" href="{{ route('myFavourites') }}?{{ http_build_query(Request::except('_token')) }}"><img data-toggle="tooltip" data-placement="bottom" title="{{__('messages.Tiles')}}" alt="{{__('messages.Tiles')}}" src='{{ asset("images/results/kafle.png") }}'></a>
    <a class="btn" href="{{ route('myFavouritesList') }}?{{ http_build_query(Request::except('_token')) }}"><img data-toggle="tooltip" data-placement="bottom" title="{{__('messages.List')}}" alt="{{__('messages.List')}}" src='{{ asset("images/results/lista.png") }}'></a>
    <a class="btn" href="{{ route('myFavouritesMap') }}?{{ http_build_query(Request::except('_token')) }}"><img data-toggle="tooltip" data-placement="bottom" title="{{__('messages.Map')}}" alt="{{__('messages.Map')}}" src='{{ asset("images/results/mapa.png") }}'></a>
    <a class="active bold" href="{{ route('myFavouritesCompare') }}?{{ http_build_query(Request::except('_token')) }}">{{__('messages.Compare')}}</a>
@endsection

@section('icons-active-mobile')
    @tablet
    <div class="btn-group col mb-4"><a class="btn btn-mobile" href="{{ route('myFavourites') }}?{{ http_build_query(Request::except('page')) }}">{{__('messages.Tiles')}}</a><a class="btn btn-mobile" href="{{ route('myFavouritesMap') }}?{{ http_build_query(Request::except('page')) }}">{{__('messages.Map')}}</a><a class="btn btn-selected btn-mobile" href="{{ route('myFavouritesCompare') }}?{{ http_build_query(Request::except('_token')) }}">{{__('messages.Compare')}}</a></div>
    @endtablet
@endsection

@section('compare-content')

    <div class="row favourites-compare">
        <div id="left-side-compare" class="col-3 col-xl-2 font-m-12 font-13">
            <div>
                <span class="font-13">{{__('messages.ComparisonExp')}}</span>
                <br><br>
                <span class="font-16">{{__('messages.Features')}}</span>
            </div>
            <div>{{__('messages.Price per stay')}}</div>
            <div>{{__('messages.Name2')}}</div>
            <div>{{__('messages.Address')}}</div>
            <div>{{__('messages.Rating')}}</div>
            <div>{{__('messages.Basic information')}}</div>
            <div>{{__('messages.See details and book')}}</div>
            <div class="font-18"><b>{{__('messages.About apartment')}}</b></div>
            <div>{{__('messages.Max number of people')}}:</div>
            <div>{{__('messages.Number of rooms')}}:</div>
            <div style="display: none">{{__('messages.Number of')}} {{__('messages.intransitive rooms')}}:</div>
            <div>{{__('messages.Number of')}} {{__('messages.double beds')}}:</div>
            <div>{{__('messages.Number of')}} {{__('messages.single beds')}}:</div>
            <div>{{__('messages.Total number of beds')}}:</div>
            <div>{{__('messages.ApSize')}}:</div>
            <div>{{__('messages.Floor')}}:</div>
            <div>{{__('messages.Other equipment')}}:</div>
            <div class="font-18"><b>{{__('messages.Equipment')}}</b></div>
            <div>{{__('messages.Wireless internet')}}<br> Wi-Fi</div>
            <div>{{__('messages.Garage')}}</div>
            <div>{{__('messages.Television set')}}</div>
            <div>{{__('messages.Vacuum cleaner')}}</div>
            <div>{{__('messages.Balcony/Terrace')}}</div>
            <div>{{__('messages.Bed for a child')}}</div>
            <div class="font-18"><b>{{__('messages.Kitchen')}}</b></div>
            <div>{{__('messages.Fridge')}}</div>
            <div>{{__('messages.Cooker')}}</div>
            <div>{{__('messages.Washing machine')}}</div>
            <div>{{__('messages.Electric kettle')}}</div>
            <div>{{__('messages.Microwave')}}</div>
            <div class="font-18"><b>{{__('messages.Bathroom')}}</b></div>
            <div>{{__('messages.Shower cabin')}}</div>
            <div>{{__('messages.Hair dryer')}}</div>
            <div>{{__('messages.Other equipment')}}</div>
            <div class="font-18"><b>{{__('messages.Rules')}}</b></div>
            <div>{{__('messages.Check-in')}}:</div>
            <div>{{__('messages.Check-out')}}:</div>
            <div>{{__('messages.Cancellation / prepayment')}}:</div>
            <div>{{__('messages.Animals')}}:</div>
            <div>{{__('messages.Other')}}:</div>
        </div>
        <div id="right-side-compare" class="row col-9 col-xl-10 font-13">
            <span id="compare-bar" class="ml-4" style="display: inherit;">
            <div id="compare-bar-prev" class="compare-bar-arrays" style="background-image: url({{ asset("images/apartment_detal/calendar-prev.png") }}"></div>
            @foreach ($finds as $apartament)
                <div class="favourites-box" id="{{$loop->iteration-1}}">
                    <div style="width: 100%; background-image: url('{{ asset("images/apartaments/$apartament->id/main.jpg") }}'); background-size: cover;"></div>
                    <div>{{__('messages.from')}} {{ $apartament->min_price }} PLN</div>
                    <div>{{ $apartament->apartament_name }}</div>
                    <div>{{ $apartament->apartament_address }}</div>
                    <div>
                        <div>
                            @for ($i = 0; $i < floor($apartament->ratingAvg/2); $i++)
                                <img class="mr-1" src='{{ asset("images/favourites/star.png") }}'>
                            @endfor
                            @if(floor($apartament->ratingAvg/2) != ceil($apartament->ratingAvg/2))
                                <img class="mr-1" src='{{ asset("images/favourites/star_half.png") }}'>
                            @endif
                            @for ($i = ceil($apartament->ratingAvg/2); $i < 5; $i++)
                                <img class="mr-1" src='{{ asset("images/favourites/star_empty.png") }}'>
                            @endfor
                        </div>
                        <div class="row font-11">
                            @if($apartament->ratingAvg < 1)
                                <div class="col-7 pr-0"></div>
                            @elseif($apartament->ratingAvg < 2.5)
                                <div class="col-7 pr-0 txt-red">{{ __("messages.Awful") }}</div>
                            @elseif($apartament->ratingAvg < 4.5)
                                <div class="col-7 pr-0 txt-red">{{ __("messages.Bad") }}</div>
                            @elseif($apartament->ratingAvg < 6.5)
                                <div class="col-7 pr-0 txt-yellow">{{ __("messages.Average") }}</div>
                            @elseif($apartament->ratingAvg < 8.5)
                                <div class="col-7 pr-0 txt-green">{{ __("messages.Very good") }}</div>
                            @else
                                <div class="col-7 pr-0 txt-green">{{ __("messages.Perfect") }}</div>
                            @endif
                            <div class="col-5 px-0 txt-blue">{{$apartament->opinionAmount ?? 0}} {{trans_choice('messages.nrReviews', $apartament->opinionAmount ?? 0)}}</div>
                        </div>
                    </div>
                    <div>
                        <div class="description-below-img" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.ApSize') }}"> <span class="description-below-living-area">{{ $apartament->apartament_living_area }} m²</span> </div>
                        <div class="description-below-img" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.people') }}" style="background-image: url('{{ asset("images/results/person.png") }}');"> <span>{{ $apartament->apartament_persons }}</span> </div>
                        <div class="description-below-img" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.beds2') }}" style="background-image: url('{{ asset("images/results/bed.png") }}');"> <span>{{ $apartament->apartament_single_beds + $apartament->apartament_double_beds }}</span> </div>
                    </div>
                    <div>
                        <a href="/apartaments/{{ $apartament->apartament_link }}" class="btn btn-primary" style="width: 100%">{{__('messages.Details')}}</a>
                    </div>
                    <div></div>
                    <div>{{ $apartament->apartament_persons }}</div>
                    <div>{{ $apartament->apartament_rooms_number }}</div>
                    <div style="display: none">{{ $apartament->apartament_intransitive_rooms }}</div>
                    <div>{{ $apartament->apartament_double_beds }}</div>
                    <div>{{ $apartament->apartament_single_beds }}</div>
                    <div>{{ $apartament->apartament_double_beds + $apartament->apartament_single_beds }}</div>
                    <div>{{ $apartament->apartament_living_area }} m²</div>
                    <div>{{ $apartament->apartament_floors_number }}</div>
                    <div>{{ $apartament->apartament_other_equipment }}</div>
                    <div></div>
                    <div>@if($apartament->apartament_wifi == 1) <img src='{{ asset("images/favourites/check.png") }}'> @else <img src='{{ asset("images/favourites/uncheck.png") }}'> @endif</div>
                    <div>@if($apartament->apartament_parking == 1) <img src='{{ asset("images/favourites/check.png") }}'> @else <img src='{{ asset("images/favourites/uncheck.png") }}'> @endif</div>
                    <div>@if($apartament->apartament_tv == 1) <img src='{{ asset("images/favourites/check.png") }}'> @else <img src='{{ asset("images/favourites/uncheck.png") }}'> @endif</div>
                    <div>@if($apartament->apartament_vaccum_cleaner == 1) <img src='{{ asset("images/favourites/check.png") }}'> @else <img src='{{ asset("images/favourites/uncheck.png") }}'> @endif</div>
                    <div>@if($apartament->apartament_balcony == 1) <img src='{{ asset("images/favourites/check.png") }}'> @else <img src='{{ asset("images/favourites/uncheck.png") }}'> @endif</div>
                    <div>@if($apartament->apartament_kid_beds == 1) <img src='{{ asset("images/favourites/check.png") }}'> @else <img src='{{ asset("images/favourites/uncheck.png") }}'> @endif</div>
                    <div></div>
                    <div>@if($apartament->apartament_fridge == 1) <img src='{{ asset("images/favourites/check.png") }}'> @else <img src='{{ asset("images/favourites/uncheck.png") }}'> @endif</div>
                    <div>
                        @if($apartament->apartament_cooker != null)
                            <img src='{{ asset("images/favourites/check.png") }}'>
                            <br>
                            {{$apartament->apartament_cooker}}
                        @else <img src='{{ asset("images/favourites/uncheck.png") }}'>
                        @endif
                    </div>
                    <div>@if($apartament->apartament_washing_machine == 1) <img src='{{ asset("images/favourites/check.png") }}'> @else <img src='{{ asset("images/favourites/uncheck.png") }}'> @endif</div>
                    <div>@if($apartament->apartament_electric_kettle == 1) <img src='{{ asset("images/favourites/check.png") }}'> @else <img src='{{ asset("images/favourites/uncheck.png") }}'> @endif</div>
                    <div>@if($apartament->apartament_microvawe_owen == 1) <img src='{{ asset("images/favourites/check.png") }}'> @else <img src='{{ asset("images/favourites/uncheck.png") }}'> @endif</div>
                    <div></div>
                    <div>@if($apartament->apartament_shower_cabin == 1) <img src='{{ asset("images/favourites/check.png") }}'> @else <img src='{{ asset("images/favourites/uncheck.png") }}'> @endif</div>
                    <div>@if($apartament->apartament_hair_dryer == 1) <img src='{{ asset("images/favourites/check.png") }}'> @else <img src='{{ asset("images/favourites/uncheck.png") }}'> @endif</div>
                    <div>{{$apartament->apartament_other_bathroom_equipment}}</div>
                    <div></div>
                    <div>{{ $apartament->apartament_registration_time }}</div>
                    <div>{{ $apartament->apartament_checkout_time }}</div>
                    <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor.</div>
                    <div>{{__('messages.AnimalsExp')}}</div>
                    <div>{{__('messages.AdditionalPriceForEl')}}</div>
                </div>
            @endforeach
            <div id="compare-bar-next" class="compare-bar-arrays" style="background-image: url({{ asset("images/apartment_detal/calendar-next.png") }}"></div>
		    </span>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script type="text/javascript">
        var middle = 0;

        function compareShow(){

            $('.favourites-box').css({display: 'none'});
            $('#'+middle).css({display:'inline-block'});

            for(i=1; i<showObjects; i++){
                $('#'+(middle+i)).css({display:'inline-block'});
            }

            if(middle == 0){
                $("#compare-bar-prev").css({opacity: '0.25'});
                //$("#compare-bar").css({'padding-left': '0px'});
            }
            else{
                $("#compare-bar-prev").css({opacity: '1'});
                //$("#compare-bar").css({'padding-left': '40px'});
            }

            if(middle == favouritesCount || {{$favouritesCount}} < showObjects){
                $("#compare-bar-next").css({opacity: '0.25'});
                //$("#compare-bar").css({'padding-right': '0px'});
            }
            else{
                $("#compare-bar-next").css({opacity: '1'});
                //$("#compare-bar").css({'padding-right': '40px'});
            }
        }

        $(function(){
            showObjects = Math.floor($("#right-side-compare").width()/150);
            favouritesCount = {{$favouritesCount}} - showObjects;
            compareShow();
        });

        $( window ).resize(function() {
            showObjects = Math.floor($("#right-side-compare").width()/150);
            favouritesCount = {{$favouritesCount}} - showObjects;
            compareShow();
        });

        $('#compare-bar-next').click(function() {
            if(middle < favouritesCount) middle++;
            compareShow();
        });

        $("#compare-bar-prev").on('click', function(){
            if(middle > 0) middle--;
            compareShow();
        });
    </script>
@endsection