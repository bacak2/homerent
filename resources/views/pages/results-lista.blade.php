@extends ('pages.results')
@section ('displayResults')
        </form>
            <div class="row">
                <div class="col-lg-6 col-md-12"><h1 class="pb-2" style="font-size: 28px">{{ $countedApartaments }} {{trans_choice('messages.apartaments', $countedApartaments)}} w {{ $countedObjects }} {{trans_choice('messages.objects', $countedObjects)}}</h1></div>
                <div class="col-12 col-lg-3 col-md-7 col-sm-12 col-xs-12 sort-by">{{__('messages.Sort by')}}:
                    <select id="u1001_input" name="sort">
                        <option selected="" value="Najlepsze dopasowanie">{{__('messages.Best fit')}}</option>
                        <option value="Najniższa cena">{{__('messages.Lowest price')}}</option>
                        <option value="Najlepiej oceniane">{{__('messages.Top rated')}}</option>
                        <option value="Najpopularniejsze">{{__('messages.Most popular')}}</option>
                        <option value="Najbliżej">{{__('messages.Closest')}}</option>
                    </select>
                </div>
                <div class="col-12 col-lg-3 col-md-5 col-sm-12 col-xs-12 inline-wrapper text-right"> <a class="btn btn-default" href="/search/kafle?{{ http_build_query(Request::except('page')) }}"><img data-toggle="tooltip" data-placement="bottom" title="Kafle" alt="Kafle" src='{{ asset("images/results/kafle.png") }}'></a> <a class="btn btn-default" href="/search/lista?{{ http_build_query(Request::except('page')) }}"><img class="active" data-toggle="tooltip" data-placement="bottom" title="Lista" alt="Lista" src='{{ asset("images/results/lista.png") }}'></a> <a class="btn btn-default" href="/search/mapa?{{ http_build_query(Request::except('page')) }}"><img data-toggle="tooltip" data-placement="bottom" title="Mapa" alt="Mapa" src='{{ asset("images/results/mapa.png") }}'></a></div>
            </div>
            @foreach ($finds as $apartament)
                @if($apartament->group_id > 0 && $apartament->group_name != NULL)
                    <div class="row list-item" itemscope itemtype="http://schema.org/Hotel">
                        <div class="col-lg-3 col-md-12 col-sm-6 col-xl-3">
                            <div class="apartament" style="background-image: url('{{ asset("images/apartaments/$apartament->id/1.jpg") }}'); background-size: cover; position: relative; margin-bottom: 0px; max-width: 285px; max-height: 149px;"></div>
                        </div>
                        <div class="col-lg-7 col-md-12">
                            <div class="row list-item-name">
                                <div class="container py-1 font-weight-bold"><h2 style='font-size: 24px; display: inline; font-weight: bold' itemprop="name">{{ $apartament->group_name }}</h2>
                                    <span class="pull-right">
                                    @for ($i = 0; $i < 5; $i++)
                                        <img class="list-item" src='{{ asset("images/results/star_list.png") }}'>
                                    @endfor
                                    </span>
                                </div>
                            </div>
                            <div class="row list-item-address">
                                <div class="container py-1">{{ $apartament->apartament_district }}
                                    <span class="pull-right">
                                        <span style="color: green; letter-spacing: -1px;"><b>8,3/10</b> <span style="font-size: 14px">{{ __("messages.Perfect") }}</span></span> <span style="color: blue; font-size: 10px">55 {{ __("messages.reviews_number") }}</span>
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
                                        $date2 = new DateTime('2006-04-14T11:30:00');

                                        $diff = $date2->diff($date1);

                                        $hours = $diff->h;
                                        $hours = $hours + ($diff->days*24);
                                        ?>
                                        {{ __("messages.Last reservation") }} {{$hours}} {{ __("messages.hours ago") }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-12">
                            <div class="row">
                                <div class="container py-1 text-right font-weight-bold"><h3 style="font-size: 26px">{{__('messages.from')}} {{ $apartament->min_price }} zł</h3></div>
                            </div>
                            <div class="row">
                                <div class="container py-1" ><a href="/apartaments-group/{{ $apartament->group_link }}" class="btn btn-primary ml-2" style="width: 100%">{{ __('messages.see apartments') }}</a></div>
                            </div>
                            <div class="row">
                                <div class="container py-1 text-right font-weight-bold"><h4 style="font-size: 18px">{{ $apartament->apartaments_amount }} {{trans_choice('messages.nrApartmentsInKomplex', $apartament->apartaments_amount)}}</h4></div>
                            </div>
                        </div>
                    </div>
                @elseif($apartament->group_name == NULL)
                    <div class="row list-item" itemscope itemtype="http://schema.org/Hotel">
                        <div class="col-lg-3 col-md-12 col-sm-6 col-xl-3">
                            <div class="apartament" style="background-image: url('{{ asset("images/apartaments/$apartament->id/1.jpg") }}'); background-size: cover; position: relative; margin-bottom: 0px; max-width: 285px; max-height: 149px;">
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
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-12">
                            <div class="row">
                                <div class="container py-1 text-right font-weight-bold"><h3 style="font-size: 26px">{{__('messages.from')}} {{ $apartament->min_price }} zł</h3></div>
                            </div>
                            <div class="row">
                                <div class="container py-1" ><a href="/reservations?link={{ $apartament->apartament_link }}&id={{ $apartament->apartament_id }}&przyjazd={{ $request->przyjazd }}&powrot={{ $request->powrot }}&dorosli={{ $request->dorosli }}&dzieci={{ $request->dzieci }}"  class="btn btn-primary ml-2" style="width: 100%">{{ __('messages.book') }}</a></div>
                            </div>
                            <div class="row">
                                <div class="container py-1" ><a href="/apartaments/{{ $apartament->apartament_link }}" class="btn btn-primary ml-2" style="width: 100%">{{ __('messages.see details') }}</a></div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
            
<div style="text-align: right">{{ $finds->appends(['dorosli' => $request->dorosli, 'dzieci' => $request->dzieci, 'powrot' => $request->powrot, 'przyjazd' => $request->przyjazd, 'region' => $request->region])->links() }}</div>
<span class="mobile-none">
@if($countedCookies > 0)
    <h3 class="pb-2" style="margin-top: 40px; font-size: 26px">{{__('messages.lastSeen')}}</h3>
    @include('includes.last-seen')
@endif
</span>

<script>
    function addToFavourites(apartamentId, userId){

        if(userId == 0) alert("Aby dodać apartament do ulubionych musisz się zalogować");

        else{
            $.ajax({
                type: "GET",
                url: '/addToFavourites/'+apartamentId+'/'+userId,
                dataType : 'json',
                data: {
                    apartamentId: apartamentId,
                    userId: userId,
                },
                success: function(responseMessage) {

                    if(responseMessage[0] == 1) {
                        var htmlForeach = '';
                        var htmlForeach2 = '';
                        var foreachLinks = '';

                        for (var i = 0; i < responseMessage[2].length; i++) {
                            htmlForeach += '<div class="row"> <div class="col-3" style="background-image: url(\'{{ url('/') }}/images/apartaments/' + responseMessage[2][i].id + '/1.jpg\'); background-size: cover; position: relative; margin-bottom: 0px; margin-left: 15px; padding-left: 0px; max-height: 52px;"></div> <div class="col-8 row" style="margin-right: -20px"> <div class="col-12 font-13 txt-blue"><a href="/apartaments/' + responseMessage[2][i].apartament_link + '">' + responseMessage[2][i].apartament_name + '</a></div> <div class="col-12 font-11 bold">' + responseMessage[2][i].apartament_address + '</div> <div class="col-12 font-11">' + responseMessage[2][i].apartament_address_2 + '</div> </div> <div class=""><img src="{{ asset("images/favourites/heart.png") }}"></div> </div> <hr>';
                        }

                        html = $('<span id="favourites-nav" onclick="$(\'#favourites-bar\').toggle();" class="nav-link">{{ __('messages.My favourites') }} (' + responseMessage[1] + ')</span> <div id="favourites-bar" style="border-bottom: 1px solid black; background-image: url({{ asset('images/account/favouritesPopup.png') }}); background-repeat: no-repeat; background-position: left top; display: none; position: absolute; left: 8px; width: 320px; z-index: 2000;"> <div class="p-3 pt-4"> <span class="bold" style="font-size: 24px">Ulubione (' + responseMessage[1] + ')</span> <a class="font-11" onclick="clearFavouritesPopup()" href="#">Wyczyść listę</a> ' + htmlForeach + '<a class="btn btn-black px-2" href="{{route('myFavourites')}}">Wszystkie (' + responseMessage[1] + ')</a> <a class="btn btn-black px-2" href="{{route('myFavouritesCompare')}}">Porównaj</a> <button class="send-to-friends btn btn-black px-2" onclick="$(\'#favourites-bar\').hide(); $(\'#send-to\').show();">Wyślij</button> </div> </div>');
                        $('#fav-nav').html('');
                        html.appendTo('#fav-nav');

                        for (var i = 0; i < responseMessage[3].length; i++) {
                            htmlForeach2 += '<li> <span id="link'+responseMessage[3][i].id+'">{{ url('/') }}/pl/apartaments/'+responseMessage[3][i].apartament_link+'</span> <span class="txt-blue copy-to-clipboard" onclick="copyToClipboard(\'#link'+responseMessage[3][i].id+'\')">Skopiuj</span> </li>';
                            foreachLinks += '{{ url('/') }}/pl/apartaments/'+responseMessage[3][i].apartament_link+',';
                        }

                        html2 = $('<span style="font-size: 24px; font-weight: bold">Wyślij znajomemu</span><br><div class="row"><div class="col-2"><span class="font-14">Linki:</span></div><div class="col-10"><ul class="font-13">'+ htmlForeach2 +'</ul></div></div><label for="emails">Adresy e-mail:</label><input id="emails" name="emails" type="text" placeholder="Wpisz adresy e-mail (rozdziel je przecinkami)"><input id="links" name="links" type="hidden" value="'+foreachLinks+'"><hr><button onclick="sendMailToFriends()" class="btn btn-default">Wyślij</button><button onClick="closeSendTo()" class="btn btn-default">Anuluj</button><div onClick="closeSendTo()" id="close-send-to" class="close-send-to">x</div>');
                        $('#send-to').html('');
                        html2.appendTo('#send-to');
                    }

                    @if($favouritesAmount == 0 && Auth::check())
                        if(responseMessage[0] == 1) $("#first-added-favourites").show();
                        else alert("Apartament znajduje się już w ulubionych");
                    @else
                    if(responseMessage[0] == 1) responseAlert = "Apartament dodano do ulubionych";
                    else responseAlert = "Apartament znajduje się już w ulubionych";
                    alert(responseAlert);
                    @endif
                },
                error: function() {
                    console.log( "Error in connection with controller");
                },
            });
        }
    }

    function closeSendTo(){
        $("#send-to").hide();
    }
</script>

@if($favouritesAmount == 0 && Auth::check())
    @include('includes.favourites-first-added-popup')
@endif

@endsection