@extends ('layout.layout')
@section('title', __('messages.Contact'))

@section('content')
<div class="container">
    <img style="width: 100%; height: auto;" src='{{ asset("images/about_us/mainImg.png") }}'>

    <h1 id="faq" class="faq-header mt-4">{{__('messages.faq2')}}</h1>
    <span id="questions">
        <div class="mb-3">
            <div class="question">
                {{__('messages.faqQ1')}}
            </div>
            <div class="answer">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.
            </div>
        </div>
        <div class="mb-3">
            <div class="question">
                {{__('messages.faqQ2')}}
            </div>
            <div class="answer">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.
            </div>
        </div>
        <div class="mb-3">
            <div class="question">
                {{__('messages.faqQ3')}}
            </div>
            <div class="answer">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.
            </div>
        </div>
        <div class="mb-3">
            <div class="question">
                {{__('messages.faqQ3')}}
            </div>
            <div class="answer">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.
            </div>
        </div>
        <div class="mb-3">
            <div class="question">
                {{__('messages.faqQ3')}}
            </div>
            <div class="answer">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.
            </div>
        </div>
    </span>

    <div>
        <span class="faq-header">{{__('messages.Contact')}}</span>
        <a class="@desktop pull-right @else d-block @enddesktop font-14" href="#account">{{__('messages.Account number for payments for reservations')}} ↓</a>
    </div>

    <div class="row mb-3 mb-md-5">
        <div class="col-md-6 col-lg-7">
            <div class="contact-box font-14">
                <div class="row mb-3 mb-md-5">
                    <div class="col-lg-6">
                        <div class="mb-3 pb-3" style="border-bottom: dashed 1px black">
                            {{__('messages.We invite you to familiarize yourself with')}}
                            <a href="#faq">{{__('messages.frequently asked questions by travelers')}}</a>
                        </div>
                        <a href="#" class="btn btn-black writeToUsOpen" style="width: 100%">{{__('messages.Write to us')}}</a>
                    </div>
                    <div class="col-lg-6 mt-3 mt-lg-0">
                        <div class="mb-3">
                            <img src="{{asset('images/contact/phoneMinIcon.png')}}">
                            <span class="ml-1">{{ $infos['first_phone'] }}</span>
                        </div>
                        <div class="mb-3">
                            <img src="{{asset('images/contact/phoneMinIcon.png')}}">
                            <span class="ml-1">{{ $infos['second_phone'] }}</span>
                        </div>
                        <div class="mb-3">
                            <img src="{{asset('images/contact/Envelop_24.png')}}">
                            <span class="ml-1">{{ $infos['contact_email'] }}</span>
                        </div>
                        {{--<div class="">
                            <img src="{{asset('images/contact/Fax_24.png')}}">
                            <span class="ml-1">fax: {{ $infos['fax'] }}</span>
                        </div>--}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        {{__('messages.Talk with us via')}} Skype:
                        <div>
                            <a href="skype:{{ $infos['skype'] }}?call">
                                <img src="{{asset('images/contact/callMe.png')}}" alt="call me via Skype">
                            </a>
                        </div>
                    </div>
                    <div class="col-6">
                        {{--{{__('messages.Talk with us via')}} GG:
                        <div>
                            <img style="width: 25px; height: auto" src="{{asset('images/contact/gg.png')}}">Nr: {{ $infos['gg'] }}
                        </div>
                        --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-5 mt-3 mt-md-0">
            <div class="contact-box font-14">
                <div class="bold" style="font-size: 18px">{{__('messages.For media')}}</div>
                <div class="row my-2">
                    <div class="col-3">
                        <img src="{{asset('images/contact/forMediaPhoto.png')}}">
                    </div>
                    <div class="col-9">
                        <div class="bold">{{ $infos['contact_person'] }}</div>
                        <div class="font-11 mt-2">{{__('messages.Specialist in contact with the media')}}</div>
                    </div>
                </div>
                <a href="#" class="btn btn-black writeToUsOpen" style="width: 100%">{{__('messages.Write to us')}}</a>
                <div class="mt-3">
                    <img src="{{asset('images/contact/phoneMinIcon.png')}}">
                    <span class="ml-1">{{ $infos['first_phone'] }}</span>
                </div>
                <div class="mt-3">
                    <img src="{{asset('images/contact/Envelop_24.png')}}">
                    <a href="mailto: {{ $infos['contact_email'] }}" class="ml-1">{{ $infos['contact_email'] }}</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4 font-14">
        <div class="col-12 col-md-4 mb-3 mb-md-0">
            <div class="contact-box">
                <div class="bold">{{__('messages.Headquarters')}}</div>
                {!! $infos['headquarter'] !!}
            </div>
        </div>
        <div class="col-12 col-md-8" id="account">
            <div class="contact-box">
                <div><span class="bold">{{__('messages.Account')}} (PLN):</span> {{ $infos['accountPLN'] }}</div>
                <div><span class="bold">{{__('messages.Account')}}  (EURO):</span> {{ $infos['accountEUR'] }}</div>
                <div><span class="bold">Kod SWIFT:</span> {{ $infos['SWIFTcode'] }}</div>
                <div class="row mt-3">
                    <div class="col-md-6 col-lg-4">
                        <div class=""><span class="bold">NIP:</span> {{ $infos['NIP'] }}</div>
                        <div><span class="bold">Regon:</span> {{ $infos['Regon'] }}</div>
                    </div>
                    <div class="col-md-6 col-lg-8 font-11">
                        {{__('messages.Please state the reservation number in the transfer')}}
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div id="mapka" style="width: 100%; height: 500px; margin-bottom: 30px;"></div>
</div>

@if(session('status'))
    <div id="writeToUsClosing" style="display: block;">
        <div>
            <span id="writeToUsCloseConfirmation" class="writeToUsCloseConfirmation" style="position: absolute; top: 18px; right: 18px; font-weight: bold; font-size: 18px">x</span>
            <div style="font-size: 24px; font-weight: bold;">{{ __('messages.ThxMailContact') }}</div>
            <div class="pb-3 mb-3" style="border-bottom: 1px dashed black">{{ __('messages.ThxMailContact2') }}</div>
            <div style="position: relative; height: 40px">
                <button style="position: absolute; left: 50%; transform: translateX(-50%); width: 182px" class="btn btn-black writeToUsCloseConfirmation">{{ __('messages.Close') }}</button>
            </div>
        </div>
    </div>
@endif

@include('includes.write-to-us')

<script>
    $(".question").click(function() {
        $(".answer").hide();
        $(this).siblings(".answer").show();
    });

    @if(isset($faqToShow))
        $("#questions div:nth-child({{$faqToShow}}) .answer").show();
    @endif
</script>
@if(\App::environment('production'))
<script src="https://maps.google.com/maps/api/js?key=AIzaSyBBEtTo5au09GsH6EvJhj1R_uc0BpTLVaw&language={{$language}}" type="text/javascript"></script>
@else
<script src="http://maps.google.com/maps/api/js?key=AIzaSyBBEtTo5au09GsH6EvJhj1R_uc0BpTLVaw&language={{$language}}" type="text/javascript"></script>
@endif
<script type="text/javascript">

    var mapa;
    var dymek = new google.maps.InfoWindow();
    var wspolrzedne = new google.maps.LatLng({{ $infos['headquarter_geo_lat'] }}, {{ $infos['headquarter_geo_lon'] }});

    function mapaStart()
    {
        var greenIcon = new google.maps.MarkerImage('{{ asset("images/map/u3576.png") }}');
        var opcjeMapy = {
            zoom: 13,
            center: wspolrzedne,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        mapa = new google.maps.Map(document.getElementById("mapka"), opcjeMapy);
        dodajZielonyMarker( {{ $infos['headquarter_geo_lat'] }}, {{ $infos['headquarter_geo_lon'] }},'<div>{!! $infos['headquarter'] !!}</div>', greenIcon);
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
        google.maps.event.addListener(marker,"click",function()
        {
            dymek.setContent(marker.txt);
            dymek.open(mapa,marker);
        });
    }

    $(document).ready(function(){
        mapaStart();
    });

    $(".writeToUsCloseConfirmation").click(function() {
        $("#writeToUsClosing").hide();
    });
</script>
@endsection