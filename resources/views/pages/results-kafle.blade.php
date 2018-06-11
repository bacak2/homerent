@extends ('pages.results')
@section ('displayResults')

    {{--dd(Session::get('auth_attempt'))--}}
            <div class="row desktop-none" style="margin-bottom: 20px">
                <div class="col-9 text-mobile-search">
                    <a href="{{ route('index') }}" style="color: #00afea">Start > </a><b>{{ $finds[0]->apartament_city}}</b>, {{__('messages.from')}} {{ $_GET['przyjazd'] }}, {{__('messages.number of nights')}}: {{ $nightsCounter }}, {{__('messages.Persons')}}: {{ $_GET['dorosli']+$_GET['dzieci'] }} {{--__('messages.Filters')--}}
                </div>
                <div class="col-3">
                    <div  style="position: absolute; right:10px;"><a  class="btn btn-info btn-mobile filters-toggle">{{__('messages.change')}} </a></div>
                </div>
                @mobile
                    @include('includes.filters-mobile')
                @endmobile
            </div>

        </form>

            <div class="row desktop-none">
                <div class="col-8"><h1 class="pb-2" style="display: inline; font-size: 24px">{{ $finds[0]->apartament_city}} <span class="desktop-none">({{ $countedApartaments }})</span></h1><span class="pb-2 mobile-none"> ({{ $countedApartaments }} {{trans_choice('messages.apartaments', $countedApartaments)}})</span></div>
                <div class="col-4 inline-wrapper text-right desktop-none"> <div style="position: absolute; right:10px;"   class="btn-group"><a class="btn btn-selected btn-mobile" href="/search/kafle?{{ http_build_query(Request::except('page')) }}">{{__('messages.Offers')}}</a><a class="btn btn-info btn-mobile" href="/search/mapa?{{ http_build_query(Request::except('page')) }}">{{__('messages.Map')}}</a></div></div>
            </div>

            <div style="margin-top: 15px; margin-bottom: 15px" class="desktop-none sort-by">{{__('messages.Sort by')}}:
                    <select id="u1001_input" name="sort" class="input-sm">
                        <option selected="" value="Najlepsze dopasowanie">{{__('messages.Best fit')}}</option>
                        <option value="Najniższa cena">{{__('messages.Lowest price')}}</option>
                        <option value="Najlepiej oceniane">{{__('messages.Top rated')}}</option>
                        <option value="Najpopularniejsze">{{__('messages.Most popular')}}</option>
                        <option value="Najbliżej">{{__('messages.Closest')}}</option>
                    </select>
            </div>

            <div class="row mobile-none">
                <div class="col-lg-6 col-md-12"><h1 style="font-size: 28px" class="pb-2">{{ $countedApartaments }} {{trans_choice('messages.apartaments', $countedApartaments)}} w {{ $countedObjects }} {{trans_choice('messages.objects', $countedObjects)}}</h1></div>
                <div class="col-12 col-lg-3 col-md-7 col-sm-12 col-xs-12 sort-by">{{__('messages.Sort by')}}:
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

<div class="infinite-scroll">
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
                                @for ($i = 0; $i < 5; $i++)
                                    <img src='{{ asset("images/results/star.png") }}'>
                                @endfor
                                <br><span style="color: green; margin-right: 10px;">{{ __("messages.Perfect") }}</span> <span style="color: blue;">55 {{ __("messages.reviews_number") }}</span>
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
                                @for ($i = 0; $i < 5; $i++)
                                    <img src="{{ asset("images/results/star.png") }}">
                                @endfor
                                <br>
                                <span style="color: green; margin-right: 10px">{{ __("messages.Perfect") }}</span>
                                <span style="color: blue">55 {{ __("messages.reviews_number") }}</span>
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
                                @for ($i = 0; $i < 5; $i++)
                                    <img src='{{ asset("images/results/star.png") }}'>
                                @endfor
                                <br><span style="color: green; margin-right: 10px;">{{ __("messages.Perfect") }}</span> <span style="color: blue;">55 {{ __("messages.reviews_number") }}</span>
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
                                @for ($i = 0; $i < 5; $i++)
                                    <img src="{{ asset("images/results/star.png") }}">
                                @endfor
                                <br>
                                <span style="color: green; margin-right: 10px">{{ __("messages.Perfect") }}</span>
                                <span style="color: blue">55 {{ __("messages.reviews_number") }}</span>
                            </div>
                        </div>
                    </div>
                    @endif
            @endforeach
         </div>
<div id="pagination" class="mobile-none" style="text-align: right">{{ $finds->appends(['dorosli' => $request->dorosli, 'dzieci' => $request->dzieci, 'powrot' => $request->powrot, 'przyjazd' => $request->przyjazd, 'region' => $request->region])->links() }}</div>
</div>

<span class="mobile-none">
@if($countedCookies > 0)
    <h2 class="pb-2" style="margin-top: 40px; font-size: 26px">{{__('messages.lastSeen')}}</h2>
    @include('includes.last-seen')
@endif
</span>

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