@extends ('includes.reservations')

@section('reservation.content')
<div class="container flex-box">
    <div id="Rpath"><span class="active">{{ __('messages.offer') }} - {{ __('messages.your data') }} - {{ __('messages.payment') }} - {{ __('messages.confirmation') }}</span></div>
</div>
<div class="container">
    @if($reservation[0]->reservation_status == 1)
    <h2 class="mt-4"><b>{{ __('messages.reservation') }} (nr 2323)</b></h2>
    <div class="row reservation-item px-2 py-1 mb-4">
        <i class="fa fa-3x fa-check-circle"></i>
        <span class="mt-2 ml-2">Zarezerwowano obiekt wg wybranych parametrów. Na adres e-mail aaa@aaa.pl wysłaliśmy potwierdzenie.</span>
    </div>
    @elseif($reservation[0]->reservation_status == 0)
    <h2 class="mt-4"><b>{{ __('messages.reservation') }} {{ __('messages.preliminary') }} (nr 2323)</b></h2>
    <div class="row reservation-item px-2 py-1 mb-4">
        <div class="col-1"><i class="fa fa-3x fa-exclamation-triangle"></i></div>
        <div class="col-11">
            <span style="color: red">
                <div class="row">Uprzejmie dziękujemy za dokonanie rezerwacji. <b>Ma ona status wstępnej.</b></div>
                <div class="row">Prosimy o jej niezwłoczne opłacenie na nasze konto.</div>
                <div class="row"><b>W przypadku braku wpłaty w ciągu 30 minut rezerwacja zostanie anulowana automatycznie.</b></div>
                <div class="row">Prosimy o przesłanie dowodu wpłaty na adres email: rezerwacje@visitzakopane.pl.</div>
            </span>
            <div class="row mt-2">
                <b>Nr konta do wpłaty:</b> PL 20 1050 1038 1000 0090 6587 9562
                <span style="margin-left: 60px"></span><b>Kod SWIFT:</b> INGBPLPW
            </div>
            <div class="row"><b>Dane:</b> VISITzakopane.pl, ul. Tetmajera 35 lok. 12, 34-500 Zakopane, Poland</div>
            <div class="row"><b>Tytuł przelewu:</b> Rezerwacja nr 234523452</div>
            <div class="row"><b>Kwota:</b> całość 400,00 PLN lub zaliczka 100,00 PLN</div>
        </div>
    </div>
    @endif
    <div class="row reservation-item py-2">
        <div class="col-lg-2 mobile-none">
            <div class="apartament " style="background-image: url('{{ asset("images/apartaments/$apartament->id/1.jpg") }}'); background-size: cover; margin-bottom: 0px; width: 180px; height: 110px;">
            </div>
        </div>
        <div class="col-lg-10 col-sm-12">
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="txt-blue" style="font-size: 22px"><b>{{ $apartament->descriptions[0]->apartament_name }}</b></div>
                    <div class="mb-2">{{ $apartament->apartament_district }}</div>
                    <div class="mb-2">{{ $apartament->apartament_address }}</div>
                    <hr class="desktop-none">
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="row"><div class="col-4">{{ __('messages.arrival') }}:</div><div class="col-8"><b>{{ $reservation[0]->reservation_arrive_date }}</b></div></div>
                    <div class="row"><div class="col-4">{{ __('messages.departure') }}:</div><div class="col-8"><b>{{ $reservation[0]->reservation_departure_date }}</b></div></div>
                    <div class="row"><div class="col-4" style="font-size: 12px">{{ ucfirst(__('messages.number of nights')) }}:</div><div class="col-8" style="font-size: 12px">{{ $reservation[0]->reservation_nights }}</div></div>
                    <div class="row"><div class="col-4" style="font-size: 12px">{{ __('messages.Number of') }} {{ __('messages.people')}}:</div><div class="col-8" style="font-size: 12px">{{ $reservation[0]->reservation_persons + $reservation[0]->reservation_kids }}</div></div>
                    <hr class="desktop-none">
                </div>
                @if(1==0)
                <div class="col-lg-5 col-sm-6">
                    <div class="row"><div class="col-4"><b>Do zapłaty:</b></div><div class="col-4"><b>300,00 PLN</b></div><div class="col-4"><span style="font-size: 12px; display: block;">Można zapłacić online lub przy odbiorze kluczy.</span></div></div>
                    <div class="row" style="font-size: 12px;"><div class="col-4">{{ __('messages.Advance') }}:</div><div class="col-4">100,00 PLN</div><div class="col-4">zapłacono, 12.03.2014</div></div>
                    <div class="row" style="font-size: 12px;"><div class="col-4">Koszt pobytu:</div><div class="col-4">400,00 PLN</div><div class="col-4">Szczegóły</div></div>
                    <div class="row"><a class="btn btn-info btn-mobile btn-res4th">Zapłać</a><a class="btn btn-info btn-mobile btn-res4th">Dokup usługi</a><a class="btn btn-info btn-mobile btn-res4th">Anuluj rezerwację</a></div>
                </div>
                @elseif(1==0)
                <div class="col-lg-5 col-sm-6">
                    <div class="row mb-2"><div class="col-4"><b>Zapłacono:</b></div><div class="col-4"><b>300,00 PLN</b></div></div>
                    <div class="row mb-2" style="font-size: 12px;"><div class="col-4">Koszt pobytu:</div><div class="col-4">400,00 PLN</div><div class="col-4">Szczegóły</div></div>
                    <div class="row"><a class="btn btn-info btn-mobile btn-res4th">Dokup usługi</a><a class="btn btn-info btn-mobile btn-res4th">Anuluj rezerwację</a></div>
                </div>
                @elseif(1==1)
                <div class="col-lg-5 col-sm-6">
                    <div class="row mb-2"><div class="col-4"><b>Do zapłaty:</b></div><div class="col-4"><b>300,00 PLN</b></div></div>
                    <div class="row mb-2" style="font-size: 12px;"><div class="col-4">Koszt pobytu:</div><div class="col-4">400,00 PLN</div><div class="col-4">Szczegóły</div></div>
                    <div class="row mb-2"><a class="btn btn-info btn-mobile btn-res4th">Dokup usługi</a><a class="btn btn-info btn-mobile btn-res4th">Anuluj rezerwację</a></div>
                    <div class="row"><a class="btn btn-info btn-mobile btn-res4th">Zapłać całość</a><a class="btn btn-info btn-mobile btn-res4th">Zapłać zaliczkę</a></div>
                </div>
                @endif
            </div>
        </div>
        <div class="col-lg-12 col-sm-12 pt-2 mt-2" style="border-top: solid 1px">
            <div class="row">
                <div class="col-lg-2 col-sm-6 mb-2">
                    <span style="font-size: 14px">
                        Kontakt:<br class="mobile-none">
                        Justyna Mroczek
                    </span>
                </div>
                <div class="col-lg-2 col-sm-12 mb-2">
                    <div class="contact-item"><i class="fa fa-lg fa-phone" style="margin-right: 10px"></i>+48 600 000 000</div>
                </div>
                <div class="col-lg-2 col-sm-12 mb-2">
                    <div class="contact-item"><i class="fa fa-lg fa-phone" style="margin-right: 10px"></i>+48 600 000 000</div>
                </div>
                <div class="col-lg-3 col-sm-12 mb-2">
                    <div class="contact-item"><i class="fa fa-lg fa-envelope" style="margin-right: 10px"></i>justyna.mroczek@gmail.com</div>
                </div>
                <div class="col-lg-3 col-sm-12 mb-2">
                    <span style="font-size: 12px; display: block;">
                        * Właściciel może pobrać na miejscu dodatkowe opłaty - np: opłatę klimatyczną, parking itd  (sprawdź opis oferty).
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-lg-4 col-sm-12">
            <h4 class="mb-3"><b>Apartament</b></h4>
                    <div class="row mb-3 fs12"><div class="col-4">{{ __('messages.Check-in') }}:</div><div class="col-8">{{ $apartament->apartament_registration_time }}</div></div>
                    <div class="row mb-3 fs12"><div class="col-4">{{ __('messages.Check-out') }}:</div><div class="col-8">{{ $apartament->apartament_checkout_time }}</div></div>
                    <div class="row mb-3 fs12"><div class="col-4">{{ __('messages.Cancellation / prepayment') }}:</div><div class="col-8">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor.</div></div>
                    <div class="row mb-3 fs12"><div class="col-4">{{ __('messages.Animals') }}:</div><div class="col-8">Zwierzęta są akceptowane na życzenie. Mogą obowiązywać dodatkowe opłaty</div></div>
                    <div class="row mb-3 fs12"><div class="col-4">{{ __('messages.Payment for stay') }}:</div><div class="col-8">Cena zakwaterowania nie obejmuje opłaty za zużycie energii elektrycznej oraz opłaty klimatycznej.</div></div>
                    <div class="row"><a class="btn btn-more-info" href="{{ route('apartamentInfo', ['link' => $apartament->descriptions[0]->apartament_link ]) }}">Więcej informacji o obiekcie</a></div>
        </div>
        <div class="col-lg-8 col-sm-12">
            <form name="wskazowki" action="#" onsubmit="znajdz_wskazowki(); return false;" />
            Wskazówki dojazdu: <input type="text" name="skad" size="40" id="skad" value="Szczecin, ul. Zawadzkiego 10" />
            <input type="submit" value="Pokaż" />
            </form>
            <div id="mapka" style="width: 100%; height: 500px; margin-bottom: 30px;"></div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-lg-4 col-sm-12">
            <h4 class="mb-3"><b>Zarezerwował</b></h4>
            <div class="row mb-3 fs12"><div class="col-4">{{ __('messages.Data') }}:</div><div class="col-8">{{ $reservation[0]->title }} {{ $reservation[0]->name_and_surname }}</div></div>
            <div class="row mb-3 fs12"><div class="col-4">{{ __('messages.Cellphone number') }}:</div><div class="col-8">{{ $reservation[0]->phone }}</div></div>
            <div class="row mb-3 fs12"><div class="col-4">{{ __('messages.Email address') }}:</div><div class="col-8">{{ $reservation[0]->email }}</div></div>
            <div class="row mb-3 fs12">
                <div class="col-4">Faktura na dane:</div>
                <div class="col-8">
                    <div class="col-12">{{ $reservation[0]->company_name }}</div>
                    <div class="col-12">{{ $reservation[0]->address_invoice }}</div>
                    <div class="col-12">{{ $reservation[0]->postcode_invoice }}</div>
                    <div class="col-12">{{ $reservation[0]->place_invoice }}</div>
                    <div class="col-12">NIP: {{ $reservation[0]->nip }}</div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-12">
            <h4 class="mb-3"><b>Koszt pobytu</b></h4>
            <div class="row mb-3 fs12"><div class="col-7">{{ __('messages.Payment for stay') }}:</div><div class="col-5"><span class="pull-right">200,00 PLN</span></div></div>
            <div class="row mb-3 fs12"><div class="col-7">{{ __('messages.Final cleaning') }}:</div><div class="col-5"><span class="pull-right">50,00 PLN</span></div></div>
            <div class="row mb-3 fs12"><div class="col-7">{{ __('messages.Additional services') }}:</div><div class="col-5"><span class="pull-right">50,00 PLN</span></div></div>
            <div class="row mb-3 fs12"><div class="col-7">{{ __('messages.Payment for service') }}:</div><div class="col-5"><span class="pull-right">50,00 PLN</span></div></div>
            <div class="row mb-3 fs12"><div class="col-7"><b>{{ __('messages.fprice') }}</b></div><div class="col-5"><span class="pull-right"><b>50,00 PLN</b></span></div></div>
        </div>
        <div class="col-lg-4 col-sm-12">
            <h4 class="mb-3"><b>Usługi dodatkowe</b></h4>
            <div id="wskazowki"></div>
        </div>
    </div>
</div>
<script src="http://maps.google.com/maps/api/js?key=AIzaSyBBEtTo5au09GsH6EvJhj1R_uc0BpTLVaw&language={{$language}}" type="text/javascript"></script>
<script type="text/javascript">

    var mapa;
    var dymek = new google.maps.InfoWindow();
    var greenMarkers = [];
    var trasa  		 = new google.maps.DirectionsService();
    var trasa_render = new google.maps.DirectionsRenderer();

    function mapaStart()
    {
        var wspolrzedne = new google.maps.LatLng({{ $apartament->apartament_geo_lat }}, {{ $apartament->apartament_geo_lan }});
        var greenIcon = new google.maps.MarkerImage('{{ asset("images/map/u3576.png") }}');
        var opcjeMapy = {
            zoom: 13,
            center: wspolrzedne,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        mapa = new google.maps.Map(document.getElementById("mapka"), opcjeMapy);
        trasa_render.setMap(mapa);
        trasa_render.setPanel(document.getElementById('wskazowki'));
        var marker1 = dodajZielonyMarker( {{ $apartament->apartament_geo_lat }}, {{ $apartament->apartament_geo_lan }},'<div class="map-img-wrapper greenIcon"><a class="desktop-none" href="/apartaments/{{ $apartament->apartament_link }}"><img style="width: 210px; height: 112px"src="{{ asset("images/apartaments/$apartament->id/1.jpg") }}"></a><img class="mobile-none" style="width: 300px; height: 169px"src="{{ asset("images/apartaments/$apartament->id/1.jpg") }}"><div class="map-see-more"><div class="container py-1"><a href="/apartaments/{{ $apartament->apartament_link }}" style="width: 100%" class="btn btn-primary mobile-none">{{ __("messages.book") }}</a></div><div class="container py-1"><a href="/apartaments/{{ $apartament->apartament_link }}" class="btn btn-primary mobile-none" style="width: 100%">{{ __("messages.see details") }}</a></div></div><div class="map-description-top">112 PLN</div> <div class="map-description-bottom">{{ __("messages.Breakfast included") }}</div><div class="add-to-favourities" ><a data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Add to favorites') }}" href="#"><img src="{{ asset('images/results/heart.png') }}"></a></div></div><span class="map-description"><span style="font-size: 17px; display: inline-block">{{ $apartament->apartament_name }}</span><br> <span style="font-size: 11px; display: inline-block">{{ $apartament->apartament_district }}</span><br> <span style="font-size: 11px; display: inline-block">{{ $apartament->apartament_address }}</span><div><div class="description-below-img" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.people') }}" style="background-image: url({{ asset('images/results/person.png') }})"> <span>{{ $apartament->apartament_persons }}</span></div><div class="description-below-img desktop-none" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.kids') }}" style="background-image: url({{ asset('images/results/child.png') }})"> <span>{{ $apartament->apartament_persons }}</span></div><div class="description-below-img mobile-none" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.double beds') }}" style="background-image: url({{ asset("images/results/doubleBed.png") }});"><span>{{ $apartament->apartament_double_beds }}</span></div><div class="description-below-img" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.single beds') }}" style="background-image: url({{ asset("images/results/bed.png") }});"><span>{{ $apartament->apartament_single_beds }}</span></div><div class="description-below-img desktop-none note" style="background-color: green"><span>4,5</span></div><div class="desktop-none description-below-notes">(23 {{ __("messages.reviews") }})</div>@if ( $apartament->apartament_wifi == 1)<div class="description-below-img mobile-none" data-toggle="tooltip" data-placement="bottom" title="Wifi" style="background-image: url({{ asset("images/results/wifi.png") }});"></div>@endif @if ( $apartament->apartament_parking == 1) <div class="description-below-img mobile-none" data-toggle="tooltip" data-placement="bottom" title="Parking" style="background-image: url({{ asset("images/results/parking.png") }});"> </div> @endif</div><div class="description-map-bottom-right mobile-none">@for ($i = 0; $i < 5; $i++) <img src="{{ asset("images/results/star.png") }}">@endfor<br><span style="color: green; margin-right: 10px">{{ __("messages.Perfect") }}</span> <span style="color: blue">55 {{ __("messages.reviews_number") }}</span></div></span>', greenIcon);
    }

    function znajdz_wskazowki()
    {
        var dane_trasy =
        {
            origin: document.getElementById('skad').value,
            destination: "{{ $apartament->apartament_city }}, {{ $apartament->apartament_address }}",
            travelMode: google.maps.DirectionsTravelMode.DRIVING
        };

        trasa.route(dane_trasy, obsluga_wskazowek);
    }

    function obsluga_wskazowek(wynik, status)
    {
        if(status != google.maps.DirectionsStatus.OK || !wynik.routes[0])
        {
            alert('Nie znaleziono lokalizacji początkowej');
            return;
        }

        trasa_render.setDirections(wynik);
        //console.log($('span[jstcache="24"]').html());
    }

    function dodajZielonyMarker(lat,lng,txt, ikona)
    {
        var opcjeMarkera =
        {
            position: new google.maps.LatLng(lat,lng),
            map: mapa,
            icon: ikona
        }
        var marker = new google.maps.Marker(opcjeMarkera);
        marker.txt=txt;

        greenMarkers.push(marker);
        return marker;
    }

    $(document).ready(function(){
        mapaStart();
    });
</script>

@endsection()