@extends ('includes.reservations')

@section('reservation.content')
    @if(!(Request::is('*/my-reservations*')))
        <div class="container flex-box mb-2">
            <div class="mobile-none font-12" id="Rpath">
                <div class="reservation-path">
                    <img src='{{ asset("images/reservations/fullBlack.png") }}'>
                    <span class="active number">1</span>
                    <span class="activeBold ml-2">{{ __('messages.offer') }}</span>
                </div>
                <img class="mx-2" src='{{ asset("images/reservations/lineActive.png") }}'>
                <div class="reservation-path">
                    <img src='{{ asset("images/reservations/fullBlack.png") }}'>
                    <span class="active number">2</span>
                    <span class="activeBold ml-2">{{ __('messages.your data') }}</span>
                </div>
                <img class="mx-2" src='{{ asset("images/reservations/lineActive.png") }}'>
                <div class="reservation-path">
                    <img src='{{ asset("images/reservations/fullBlack.png") }}'>
                    <span class="active number">3</span>
                    <span class="activeBold ml-2">{{ __('messages.payment') }}</span>
                </div>
                <img class="mx-2" src='{{ asset("images/reservations/lineActive.png") }}'>
                <div class="reservation-path">
                    <img src='{{ asset("images/reservations/thisStepBlack.png") }}'>
                    <span class="active number">4</span>
                    <span class="activeBold ml-2">{{ __('messages.confirmation') }}</span>
                </div>
            </div>
            <div class="desktop-none" id="Rpath"><span class="activeBold">{{ __('messages.offer') }} - {{ __('messages.your data') }} - {{ __('messages.payment') }} - {{ __('messages.confirmation') }}</span></div>
        </div>
    @endif
<div class="container">
    @if(!(Request::is('*/my-reservations*')))
        @if($reservation[0]->reservation_status == 1)
        <h1 class="mt-4"><b>{{ __('messages.reservation') }} (nr 2323)</b></h1>
        <div class="row reservation-item px-2 py-1 mb-4" id="reservation-confirmed">
            <i class="fa fa-3x fa-check-circle"></i>
            <span class="mt-2 ml-2">Zarezerwowano obiekt wg wybranych parametrów. Na adres e-mail aaa@aaa.pl wysłaliśmy potwierdzenie.</span>
        </div>
        @elseif($reservation[0]->reservation_status == 0)
        <h1 class="mt-4"><b>{{ __('messages.reservation') }} {{ __('messages.preliminary') }} (nr 2323)</b></h1>
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
    @else()
        <h1 class="mt-4"><b>{{ __('messages.reservation') }} (nr 2323)</b></h1>
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
                    <div class="mb-2">{{ $apartament->apartament_city}} ({{ $apartament->apartament_district }})</div>
                    <div class="mb-2">{{ $apartament->apartament_address }}</div>
                    <hr class="desktop-none">
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="row"><div class="col-4">{{ __('messages.arrival') }}:</div><div class="col-8"><b>{{ strtolower(strftime("%a, %d %b %Y", strtotime($reservation[0]->reservation_arrive_date))) }}</b></div></div>
                    <div class="row"><div class="col-4">{{ __('messages.departure') }}:</div><div class="col-8"><b>{{ strtolower(strftime("%a, %d %b %Y", strtotime($reservation[0]->reservation_departure_date))) }}</b></div></div>
                    <div class="row"><div class="col-4" style="font-size: 12px">{{ ucfirst(__('messages.number of nights')) }}:</div><div class="col-8" style="font-size: 12px">{{ $reservation[0]->reservation_nights }}</div></div>
                    <div class="row"><div class="col-4" style="font-size: 12px">{{ __('messages.Number of') }} {{ __('messages.people')}}:</div><div class="col-8" style="font-size: 12px">{{$reservation[0]->reservation_persons}} {{trans_choice('messages.adult persons',$reservation[0]->reservation_persons)}}, {{$reservation[0]->reservation_kids}} dzieci</div></div>
                    <hr class="desktop-none">
                </div>
                @if(1==1)
                <div class="col-lg-5 col-sm-6">
                    <div class="row"><div class="col-4"><b>Do zapłaty:</b></div><div class="col-4"><b>{{$reservation[0]->payment_to_pay}} PLN</b></div><div class="col-4"><span style="font-size: 12px; display: block;">Można zapłacić online lub przy odbiorze kluczy.</span></div></div>
                    <div class="row" style="font-size: 12px;"><div class="col-4">{{ __('messages.Advance') }}:</div><div class="col-4">100,00 PLN</div><div class="col-4">zapłacono, {{$reservation[0]->updated_at}}</div></div>
                    <div class="row" style="font-size: 12px;"><div class="col-4">Koszt pobytu:</div><div class="col-4">400,00 PLN</div><div class="col-4"><a href="#details">Szczegóły</a></div></div>
                    <div class="row"><a class="btn btn-info btn-mobile btn-res4th">Zapłać</a><a class="btn btn-info btn-mobile btn-res4th">Dokup usługi</a><a class="btn btn-info btn-mobile btn-res4th">Anuluj rezerwację</a></div>
                </div>
                @elseif(1==0)
                <div class="col-lg-5 col-sm-6">
                    <div class="row mb-2"><div class="col-4"><b>Zapłacono:</b></div><div class="col-4"><b>300,00 PLN</b></div></div>
                    <div class="row mb-2" style="font-size: 12px;"><div class="col-4">Koszt pobytu:</div><div class="col-4">400,00 PLN</div><div class="col-4"><a href="#details">Szczegóły</a></div></div>
                    <div class="row"><a class="btn btn-info btn-mobile btn-res4th">Dokup usługi</a><a class="btn btn-info btn-mobile btn-res4th">Anuluj rezerwację</a></div>
                </div>
                @elseif(1==0)
                <div class="col-lg-5 col-sm-6">
                    <div class="row mb-2"><div class="col-4"><b>Do zapłaty:</b></div><div class="col-4"><b>{{$reservation[0]->payment_to_pay}} PLN</b> Zapłacono: {{$reservation[0]->updated_at}}</div></div>
                    <div class="row mb-2" style="font-size: 12px;"><div class="col-4">Koszt pobytu:</div><div class="col-4">{{$reservation[0]->payment_full_amount}} PLN</div><div class="col-4"><a href="#details">Szczegóły</a></div></div>
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
@auth
    @if(strtotime($reservation[0]->reservation_departure_date) < strtotime(date("Y-m-d")))
        <h3 class="my-4"><b>Ocena</b></h3>
        <div class="row mb-5">
            <div class="col-2"><a class="btn btn-black" href="{{url()->current()}}/opinion" style="width: 100%">Oceń teraz</a></div>
            <div class="col-10">
                <div class="row mb-2 font-12">Twoja ocena i opinia pomogą wybierać innym w przyszłości.</div>
                <div class="row font-12">A dodatkowo zyskujesz 5% rabatu lub 50 pln zniżki na kolejną rezerwację.</div>
            </div>
        </div>
    @endif
@endauth
    <div class="row mt-4">
        <div class="col-lg-4 col-sm-12">
            <h3 class="mb-3"><b>Apartament</b></h3>
                    <div class="row mb-3 fs12"><div class="col-4">{{ __('messages.Check-in') }}:</div><div class="col-8">{{ $apartament->apartament_registration_time }}</div></div>
                    <div class="row mb-3 fs12"><div class="col-4">{{ __('messages.Check-out') }}:</div><div class="col-8">{{ $apartament->apartament_checkout_time }}</div></div>
                    <div class="row mb-3 fs12"><div class="col-4">{{ __('messages.Cancellation / prepayment') }}:</div><div class="col-8">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor.</div></div>
                    <div class="row mb-3 fs12"><div class="col-4">{{ __('messages.Animals') }}:</div><div class="col-8">Zwierzęta są akceptowane na życzenie. Mogą obowiązywać dodatkowe opłaty</div></div>
                    <div class="row mb-3 fs12"><div class="col-4">{{ __('messages.Payment for stay') }}:</div><div class="col-8">Cena zakwaterowania nie obejmuje opłaty za zużycie energii elektrycznej oraz opłaty klimatycznej.</div></div>
                    <div class="row"><a class="btn btn-more-info" href="{{ route('apartamentInfo', ['link' => $apartament->descriptions[0]->apartament_link ]) }}">Więcej informacji o obiekcie</a></div>
        </div>
        <div class="col-lg-8 col-sm-12">
            <form class="ml-3 mb-3" name="wskazowki" action="#" onsubmit="znajdz_wskazowki(); return false;" class="ml-2">
                <div class="row">
                    Wskazówki dojazdu: <input class="font-12" type="text" name="skad"  id="skad" style="width:180px" placeholder="Lokalizacja początkowa">
                    <input class="btn btn-info btn-mobile btn-res4th" type="submit" value="Pokaż">
                    <div class="col-2 font-12 ml-3" style="display: inline-block;">
                        <div id="distance" class="row" style="font-weight: bold"></div>
                        <div id="duration" class="row"></div>
                    </div>
                    <div class="col-3">
                        <a class="btn btn-info btn-mobile btn-res4th pull-right">Drukuj wskazówki dojazdu</a>
                    </div>
                </div>
            </form>
            <div id="mapka" style="width: 100%; height: 500px; margin-bottom: 30px;"></div>
        </div>
    </div>

    <div class="row mt-4 mb-5">
        <div class="col-lg-4 col-sm-12">
            <h3 class="mb-3"><b>Zarezerwował</b></h3>
            <div class="row fs12"><div class="col-4">{{ __('messages.Data') }}:</div><div class="col-8">{{ $reservation[0]->name }} {{ $reservation[0]->surname }}</div></div>
            <div class="row fs12"><div class="col-8 offset-4">{{ $reservation[0]->address }}</div></div>
            <div class="row fs12"><div class="col-8 offset-4">{{ $reservation[0]->postcode }} {{ $reservation[0]->place }}</div></div>
            <div class="row mb-3 fs12"><div class="col-8 offset-4">{{ $reservation[0]->country }}</div></div>
            <div class="row mb-3 fs12"><div class="col-4">{{ __('messages.Cellphone number') }}:</div><div class="col-8">{{ $reservation[0]->phone }}</div></div>
            <div class="row mb-3 fs12"><div class="col-4">{{ __('messages.Email address') }}:</div><div class="col-8">{{ $reservation[0]->email }}</div></div>
            @if($reservation[0]->invoice != NULL)
            <div class="row fs12"><div class="col-4">Faktura na dane:</div><div class="col-8">{{ $reservation[0]->company_name }}</div></div>
            <div class="row fs12"><div class="col-8 offset-4">{{ $reservation[0]->address_invoice }}</div></div>
            <div class="row fs12"><div class="col-8 offset-4">{{ $reservation[0]->postcode_invoice }}</div></div>
            <div class="row fs12"><div class="col-8 offset-4">{{ $reservation[0]->place_invoice }}</div></div>
                @if($reservation[0]->nip != NULL)<div class="row fs12"><div class="col-8 offset-4">NIP: {{ $reservation[0]->nip }}</div></div>@endif
            @endif
        </div>
        <div class="col-lg-4 col-sm-12" style="font-weight: bold;">
            <h3 class="mb-3" id="details"><b>Koszt pobytu</b></h3>
            <div class="row mb-3 fs12"><div class="col-7">{{ __('messages.Payment for stay') }}:</div><div class="col-5"><span class="pull-right">{{$reservation[0]->payment_all_nights}} PLN</span></div></div>
            <div class="row mb-3 fs12"><div class="col-7">{{ __('messages.Final cleaning') }}:</div><div class="col-5"><span class="pull-right">{{$reservation[0]->payment_final_cleaning}} PLN</span></div></div>
            <div class="row mb-3 fs12"><div class="col-7">{{ __('messages.Additional services') }}:</div><div class="col-5"><span class="pull-right">{{$reservation[0]->payment_additional_services}} PLN</span></div></div>
            <div class="row mb-3 fs12"><div class="col-7">{{ __('messages.Payment for service') }}:</div><div class="col-5"><span class="pull-right">{{$reservation[0]->payment_basic_service}} PLN</span></div></div>
            <div class="row mb-3 fs12" style="font-size: 18px"><div class="col-7"><b>{{ __('messages.fprice') }}</b></div><div class="col-5"><span class="pull-right"><b>{{$reservation[0]->payment_to_pay}} PLN</b></span></div></div>
        </div>
        <div class="col-lg-4 col-sm-12">
            <h3 class="mb-3"><b>Usługi dodatkowe</b></h3>
            <!--h3 class="mb-3"><b>Wskazówki dojazdu</b></h3>
            <div id="wskazowki"></div-->
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
        var marker1 = dodajZielonyMarker( {{ $apartament->apartament_geo_lat }}, {{ $apartament->apartament_geo_lan }},'', greenIcon);
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
        greenMarkers[0].setMap(null);
    }

    function obsluga_wskazowek(wynik, status)
    {
        if(status != google.maps.DirectionsStatus.OK || !wynik.routes[0])
        {
            alert('Nie znaleziono lokalizacji początkowej');
            return;
        }

        trasa_render.setDirections(wynik);
        $("#distance").text(wynik.routes[0].legs[0].distance.text);
        $("#duration").text(wynik.routes[0].legs[0].duration.text);
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