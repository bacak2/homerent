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
            <div class="col-lg-6 col-md-12">Lista</div>
            <div class="col-12 col-lg-3 col-md-7 col-sm-12 col-xs-12 sort-by">{{__('messages.Sort by')}}:
                <select id="u1001_input" name="sort" class="input-sm">
                    <option selected="" value="Najlepsze dopasowanie">{{__('messages.Best fit')}}</option>
                    <option value="Najniższa cena">{{__('messages.Lowest price')}}</option>
                    <option value="Najlepiej oceniane">{{__('messages.Top rated')}}</option>
                    <option value="Najpopularniejsze">{{__('messages.Most popular')}}</option>
                    <option value="Najbliżej">{{__('messages.Closest')}}</option>
                </select>
            </div>
        <div class="col-12 col-lg-3 col-md-5 col-sm-12 col-xs-12 inline-wrapper text-right"> <a class="btn btn-default" href="{{ route('myFavourites') }}"><img src='{{ asset("images/results/kafle.png") }}'></a> <a class="btn btn-default" href="{{ route('myFavouritesList') }}"><img class="active" src='{{ asset("images/results/lista.png") }}'></a> <a class="btn btn-default" href="{{ route('myFavouritesMap') }}"><img src='{{ asset("images/results/mapa.png") }}'></a><a href="{{ route('myFavouritesCompare') }}">Porównaj</a></div>
    </div>

    <div class="row">
        @foreach ($finds as $apartament)
            <div class="row list-item" itemscope itemtype="http://schema.org/Hotel">
                <div class="col-lg-3 col-md-12 col-sm-6 col-xl-3">
                    <div class="apartament" style="background-image: url('{{ asset("images/apartaments/$apartament->id/1.jpg") }}'); background-size: cover; position: relative; margin-bottom: 0px; max-width: 285px; max-height: 149px;">
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
                        <div class="col-6 list-item-last-reservation">
                            {{ __("messages.Last reservation") }} 2 {{ __("messages.hours ago") }}
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-12">
                    <div class="row">
                        <div class="container py-1 text-right font-weight-bold"><h3 style="font-size: 26px">{{__('messages.from')}} {{ $apartament->min_price }} zł</h3></div>
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
    </div>
</div>

@include('account.favourites.clear-favourites')

<script>
    $("#enterTerm").on('click', function(){
        $("div.results-search").show();
        $("#eneterTermRow").hide();
    });
</script>
@endsection