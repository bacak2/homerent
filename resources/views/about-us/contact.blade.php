@extends ('layout.layout')
@section('title', 'Kontakt')

@section('content')
<div class="container">
    <img style="width: 100%; height: auto;" src='{{ asset("images/about_us/mainImg.png") }}'>

    <h1 id="faq" class="faq-header mt-4">Najczęściej zadawane pytania</h1>

    <div class="mb-3">
        <div class="question">
            Mam problem z logowaniem - co robić?
        </div>
        <div class="answer">
            Problem z logowaniem lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.
        </div>
    </div>
    <div class="mb-3">
        <div class="question">
            Problemy z płatnością
        </div>
        <div class="answer">
            Problemy z płatnością lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.
        </div>
    </div>
    <div class="mb-3">
        <div class="question">
            Czy korzystanie z serwisu jest bezpieczne?
        </div>
        <div class="answer">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.
        </div>
    </div>
    <div class="mb-3">
        <div class="question">
            Czy korzystanie z serwisu jest bezpieczne?
        </div>
        <div class="answer">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.
        </div>
    </div>
    <div class="mb-3">
        <div class="question">
            Czy korzystanie z serwisu jest bezpieczne?
        </div>
        <div class="answer">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.
        </div>
    </div>

    <div>
        <span class="faq-header">Kontakt</span>
        <a class="@desktop pull-right @else d-block @enddesktop font-14" href="#account">Numer konta do wpłat za rezerwacje ↓</a>
    </div>

    <div class="row" style="margin-bottom: 90px">
        <div class="col-12 col-md-8">
            <div class="contact-box font-14">
                <div class="row mb-5">
                    <div class="col-6">
                        <div class="mb-3 pb-3" style="border-bottom: dashed 1px black">
                            Zapraszamy do zapoznania się z
                            <a href="#faq">najczęściej zadawanymi pytaniami przez podróżnych</a>
                        </div>
                        <button class="btn btn-black" style="width: 100%">Napisz do nas</button>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <img src="{{asset('images/contact/phoneMinIcon.png')}}">
                            <span class="ml-1">+48 18 20 64 002</span>
                        </div>
                        <div class="mb-3">
                            <img src="{{asset('images/contact/phoneMinIcon.png')}}">
                            <span class="ml-1">+48 600 49 49 49</span>
                        </div>
                        <div class="">
                            <img src="{{asset('images/contact/phoneMinIcon.png')}}">
                            <span class="ml-1">fax: +48 18 521 39 38</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        Porozmawiaj z nami na Skype:
                        <div>
                            <a href="skype:visitzakopane.pl?call">
                                <img src="{{asset('images/contact/callMe.png')}}" alt="call me via Skype">
                            </a>
                        </div>
                    </div>
                    <div class="col-6">
                        Porozmawiaj z nami na GG:
                        <div>
                            <img style="width: 25px; height: auto" src="{{asset('images/contact/gg.png')}}">Nr: 48401665
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4 mt-4 mt-md-0">
            <div class="contact-box font-14">
                <div class="bold" style="font-size: 18px">Dla mediów</div>
                <div class="row my-2">
                    <div class="col-3">
                        <img src="{{asset('images/contact/forMediaPhoto.png')}}">
                    </div>
                    <div class="col-9">
                        <div class="bold">Anna Mroczko</div>
                        <div class="font-11 mt-2">Specjalista ds.kontaktów z mediami</div>
                    </div>
                </div>
                <button class="btn btn-black" style="width: 100%">Napisz do nas</button>
                <div class="mt-3">
                    <img src="{{asset('images/contact/phoneMinIcon.png')}}">
                    <span class="ml-1">+48 18 20 64 002</span>
                </div>
                <div class="mt-3">
                    <img src="{{asset('images/contact/phoneMinIcon.png')}}">
                    <a href="mailto: media@aaaa.pl" class="ml-1">media@aaaa.pl</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4 font-14">
        <div class="col-12 col-md-4 mb-4 mb-md-0">
            <div class="contact-box">
                <div class="bold">Siedziba firmy:</div>
                <div>Nazwa_firmy Sp. z o.o.</div>
                <div>ul. Tetmajera 35/12</div>
                <div>34-500 Zakopane</div>
            </div>
        </div>
        <div class="col-12 col-md-8" id="account">
            <div class="contact-box">
                <div><span class="bold">Konto (PLN):</span> PL 20 1050 1038 1000 0090 6587 9562</div>
                <div><span class="bold">Konto (EURO):</span> PL 08 1050 0015 1000 0090 4505 3866</div>
                <div><span class="bold">Kod SWIFT:</span> INGBPLPW</div>
                <div class="row mt-3">
                    <div class="col-12 col-md-3">
                        <div class=""><span class="bold">NIP:</span> 634-239-97-06</div>
                        <div><span class="bold">Regon:</span> 276898760</div>
                    </div>
                    <div class="col-12 col-md-9 font-11">
                        W treści przelewu prosimy podawać nr rezerwacji
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div id="mapka" style="width: 100%; height: 500px; margin-bottom: 30px;"></div>
</div>

<div style="position: fixed; top:0; left: 0; background-color: rgba(13, 13, 13, 0.6); width: 100%; height: 100%; z-index: 1999;">
    <div style="position: fixed; top: 50px; left: 50%; transform: translateX(-50%); z-index: 2000; width: 620px; background-color: #fff; padding: 18px">
        <form class="font-14">
            <div style="font-size: 24px; font-weight: bold;">Napisz do nas</div>
            <div class="pb-3 mb-3" style="border-bottom: 1px dashed black">Pola oznaczone gwiazdką są obowiązkowe.</div>
            <div class="row mb-5">
                <div class="col-6">
                    <label for="contactEmail" class="bold">Twój adres e-mail:*</label>
                    <input id="contactEmail" name="contactEmail" style="width: 100%;" type="text">
                </div>
                <div class="col-6">
                    <label for="contactPhone" class="bold">Numer telefonu:</label>
                    <input id="contactPhone" name="contactPhone" style="width: 100%;" type="text">
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-6">
                    <label for="contactEmail" class="bold">Dotyczy</label>
                    <input id="contactEmail" name="contactEmail" style="width: 100%;" type="text">
                </div>
                <div class="col-6">
                    <select style="width: 100%;">
                        <option value="0">Wybierz</option>
                        <option value="1">Mam problem z zalogowaniem</option>
                        <option value="2">Jak mogę zapłacić za rezerwację</option>
                        <option value="3">Lorem ipsum</option>
                    </select>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-6">
                    Być może pomocne będzie przeczytanie:
                </div>
                <div class="col-6">
                    Zapomniałem hasła - jak odzyskać dostęp?
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    <label for="contactMessage" class="bold">Treść</label>
                    <textarea id="contactMessage" name="contactMessage" style="width: 100%; height: 95px" placeholder="Treść wiadomości"></textarea>
                </div>
            </div>
            <div class="pb-3 mb-3" style="border-bottom: 1px dashed black">Dodaj załącznik</div>
            <div style="position: relative; height: 40px">
                <input style="position: absolute; left: 50%; transform: translateX(-50%); width: 182px" class="btn btn-black" type="submit" value="Wyślij">
            </div>
        </form>
    </div>
</div>

<script>
    $(".question").click(function() {
        $(".answer").hide();
        $(this).siblings(".answer").show();
    });
</script>

<script src="http://maps.google.com/maps/api/js?key=AIzaSyBBEtTo5au09GsH6EvJhj1R_uc0BpTLVaw&language={{$language}}" type="text/javascript"></script>
<script type="text/javascript">

    var mapa;
    var wspolrzedne = new google.maps.LatLng({{ $geo_lat }}, {{ $geo_lon }});

    function mapaStart()
    {
        var greenIcon = new google.maps.MarkerImage('{{ asset("images/map/u3576.png") }}');
        var opcjeMapy = {
            zoom: 13,
            center: wspolrzedne,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        mapa = new google.maps.Map(document.getElementById("mapka"), opcjeMapy);
        dodajZielonyMarker( {{ $geo_lat }}, {{ $geo_lon }},'', greenIcon);
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
    }

    $(document).ready(function(){
        mapaStart();
    });
</script>
@endsection