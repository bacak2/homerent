@extends ('pages.results')
@section('title', 'Ulubione')
@section ('displayResults')

    <div class="row desktop-none" style="margin-bottom: 20px">
        <div class="col-9 text-mobile-search">
        </div>
        <div class="col-3">
            <div  style="position: absolute; right:10px;"><a  class="btn btn-info btn-mobile filters-toggle">{{__('messages.change')}} </a></div>
        </div>
        @mobile
        @include('includes.filters-mobile')
        @endmobile
    </div>

    </form>

    <div style="margin-top: 15px; margin-bottom: 15px" class="desktop-none sort-by">{{__('messages.Sort by')}}:
        <select id="u1001_input" name="sort" class="input-sm">
            <option selected="" value="Najlepsze dopasowanie">{{__('messages.Best fit')}}</option>
            <option value="Najniższa cena">{{__('messages.Lowest price')}}</option>
            <option value="Najlepiej oceniane">{{__('messages.Top rated')}}</option>
            <option value="Najpopularniejsze">{{__('messages.Most popular')}}</option>
            <option value="Najbliżej">{{__('messages.Closest')}}</option>
        </select>
    </div>

    <span class="mobile-none">
</span>

    <div class="container display-favourites" id="apartamentsforyou">

        <div class="row">
            <div class="col-8"><h1 style="font-size: 28px" class="pb-2">Ulubione ({{ $favouritesCount }})</h1></div>
            <div class="col-4">
                <span id="clear-favourites" class="pull-right">Wyczyść ulubione</span>
                <span class="pull-right mx-2">|</span>
                <span class="send-to-friends pull-right">Wyślij znajomemu</span>
            </div>
        </div>

        <div id="eneterTermRow" class="row" @if($request->has('przyjazd')) style="display: none" @endif>
            <div class="col-12" style="padding: 10px; background-color: #d0cdca">
                <i class="fa fa-3x fa-info-circle"></i>
                <span class="font-13">Jeśli chcesz porównać wg ceny za pobyt - wprowadź dane dot. terminów rezerwacji.</span>
                <button id="enterTerm" class="pull-right">Wprowadź terminy</button>
            </div>
        </div>

        <div class="row pt-4">
            <div class="col-lg-6 col-md-12">Porównanie</div>
            <div class="col-12 col-lg-3 col-md-7 col-sm-12 col-xs-12 sort-by">{{__('messages.Sort by')}}:
                <select id="u1001_input" name="sort" class="input-sm">
                    <option selected="" value="Najlepsze dopasowanie">{{__('messages.Best fit')}}</option>
                    <option value="Najniższa cena">{{__('messages.Lowest price')}}</option>
                    <option value="Najlepiej oceniane">{{__('messages.Top rated')}}</option>
                    <option value="Najpopularniejsze">{{__('messages.Most popular')}}</option>
                    <option value="Najbliżej">{{__('messages.Closest')}}</option>
                </select>
            </div>
        <div class="col-12 col-lg-3 col-md-5 col-sm-12 col-xs-12 inline-wrapper text-right"> <a class="btn btn-default" href="{{ route('myFavourites') }}"><img src='{{ asset("images/results/kafle.png") }}'></a> <a class="btn btn-default" href="{{ route('myFavouritesList') }}"><img src='{{ asset("images/results/lista.png") }}'></a> <a class="btn btn-default" href="{{ route('myFavouritesMap') }}"><img src='{{ asset("images/results/mapa.png") }}'></a><a href="{{ route('myFavouritesCompare') }}">Porównaj</a></div>
    </div>

    <div class="row favourites-compare">
        <div id="left-side-compare" class="col-2 font-13">
            <div>
                <span class="font-13">Porównaj ulubione apartamenty i wybierz najlepszy dla siebie</span>
                <br><br>
                <span class="font-16">Cechy</span>
            </div>
            <div>Cena za noc</div>
            <div>Nazwa</div>
            <div>Adres</div>
            <div>Ocena</div>
            <div>Podstawowe informacje</div>
            <div>Zobacz szczegóły i zarezerwuj</div>
            <div class="font-18"><b>O apartamencie</b></div>
            <div>Max liczba osób:</div>
            <div>Ilość pokoi:</div>
            <div>Ilość pokoi nieprzechodnich:</div>
            <div>Ilość łóżek podwójnych:</div>
            <div>Ilość łóżek pojedynczych:</div>
            <div>Suma łóżek:</div>
            <div>Metraż:</div>
            <div>Piętro:</div>
            <div>Pozostałe wyposażenie:</div>
            <div class="font-18"><b>Wyposażenie</b></div>
            <div>Internet bezprzewodowy Wi-Fi</div>
            <div>Garaż</div>
            <div>Telewizor (kanały lokalne)</div>
            <div>Odkurzacz</div>
            <div>Balkon/taras</div>
            <div>Łóżeczko dziecięce</div>
            <div class="font-18"><b>Kuchnia</b></div>
            <div>lodówka</div>
            <div>kuchenka</div>
            <div>zmywarka</div>
            <div>czajnik elektryczny</div>
            <div>mikrofalówka</div>
            <div class="font-18"><b>Łazienka</b></div>
            <div>kabina prysznicowa</div>
            <div>suszarka do włosów</div>
            <div>Pozostałe wyposażenie</div>
            <div class="font-18"><b>Zasady</b></div>
            <div>Zameldowanie:</div>
            <div>Wymeldowanie:</div>
            <div>Odwołanie rezerwacji/ przedpłata:</div>
            <div>Zwierzęta:</div>
            <div>Inne:</div>
        </div>
        <div id="right-side-compare" class="row col-10 font-13">
            <span id="compare-bar" class="ml-4" style="display: inherit;">
            <div id="compare-bar-prev" class="compare-bar-arrays" style="background-image: url({{ asset("images/apartment_detal/calendar-prev.png") }}"></div>
            @foreach ($finds as $apartament)
                @if($apartament->group_name == null)
                <div class="favourites-box" id="{{$loop->iteration-1}}">
                    <div style="width: 100%; background-image: url('{{ asset("images/apartaments/$apartament->id/1.jpg") }}'); background-size: cover;"></div>
                    <div>od {{ $apartament->min_price }} PLN</div>
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
                                <div class="col-6"></div>
                            @elseif($apartament->ratingAvg < 2.5)
                                <div class="col-6 txt-red">{{ __("messages.Awful") }}</div>
                            @elseif($apartament->ratingAvg < 4.5)
                                <div class="col-6 txt-red">{{ __("messages.Bad") }}</div>
                            @elseif($apartament->ratingAvg < 6.5)
                                <div class="col-6 txt-yellow">{{ __("messages.Average") }}</div>
                            @elseif($apartament->ratingAvg < 8.5)
                                <div class="col-6 txt-green">{{ __("messages.Very good") }}</div>
                            @else
                                <div class="col-6 txt-green">{{ __("messages.Perfect") }}/div>
                            @endif
                            <div class="col-6 txt-blue">{{$apartament->opinionAmount ?? 0}} {{trans_choice('messages.nrReviews', $apartament->opinionAmount ?? 0)}}</div>
                        </div>
                    </div>
                    <div>
                        <div class="description-below-img" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('Metraż') }}"> <span class="description-below-living-area">{{ $apartament->apartament_living_area }} m²</span> </div>
                        <div class="description-below-img" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.people') }}" style="background-image: url('{{ asset("images/results/person.png") }}');"> <span>{{ $apartament->apartament_persons }}</span> </div>
                        <div class="description-below-img" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.kids') }}" style="background-image: url('{{ asset("images/results/child.png") }}');"> <span>{{ $apartament->apartament_kids }}</span> </div>
                        <div class="description-below-img" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.beds') }}" style="background-image: url('{{ asset("images/results/bed.png") }}');"> <span>{{ $apartament->apartament_single_beds + $apartament->apartament_double_beds }}</span> </div>
                    </div>
                    <div>
                        <a href="/apartaments/{{ $apartament->apartament_link }}" class="btn btn-primary" style="width: 100%">Szczegóły</a>
                    </div>
                    <div></div>
                    <div>{{ $apartament->apartament_persons }}</div>
                    <div>{{ $apartament->apartament_rooms_number }}</div>
                    <div>{{ $apartament->apartament_intransitive_rooms }}</div>
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
                    <div>Zwierzęta są akceptowane na życzenie. Mogą obowiązywać dodatkowe opłaty</div>
                    <div>Cena zakwaterowania nie obejmuje opłaty za zużycie energii elektrycznej.</div>
                </div>
                @endif
            @endforeach
            <div id="compare-bar-next" class="compare-bar-arrays" style="background-image: url({{ asset("images/apartment_detal/calendar-next.png") }}"></div>
		    </span>
        </div>
    </div>
</div>

    <script type="text/javascript">
        var middle = 0;
        var favouritesCount = {{$favouritesCount}} - 6;

        function compareMonthShow(){
            $('.favourites-box').css({display: 'none'});
            $('#'+middle).css({display:'inline-block'});
            $('#'+(middle+1)).css({display:'inline-block'});
            $('#'+(middle+2)).css({display:'inline-block'});
            $('#'+(middle+3)).css({display:'inline-block'});
            $('#'+(middle+4)).css({display:'inline-block'});
            $('#'+(middle+5)).css({display:'inline-block'});

            if(middle == 0){
                $("#compare-bar-prev").css({opacity: '0.25'});
                //$("#compare-bar").css({'padding-left': '0px'});
            }
            else{
                $("#compare-bar-prev").css({opacity: '1'});
                //$("#compare-bar").css({'padding-left': '40px'});
            }

            if(middle == favouritesCount || {{$favouritesCount}} < 6){
                $("#compare-bar-next").css({opacity: '0.25'});
                //$("#compare-bar").css({'padding-right': '0px'});
            }
            else{
                $("#compare-bar-next").css({opacity: '1'});
                //$("#compare-bar").css({'padding-right': '40px'});
            }
        };

        $(function(){
            compareMonthShow();
        });

        $('#compare-bar-next').click(function() {
            if(middle < favouritesCount) middle++;
            compareMonthShow();
        });

        $("#compare-bar-prev").on('click', function(){
            if(middle > 0) middle--;
            compareMonthShow();
        });
    </script>

@include('account.favourites.clear-favourites')

    <script>
        $("#enterTerm").on('click', function(){
            $("div.results-search").show();
            $("#eneterTermRow").hide();
        });
    </script>

@endsection