@extends ('pages.results')
@section('title', __('messages.For travelers2'))

@section('content')
<div class="container">
    <div class="img-container" style="position: relative">
        <img style="width: 100%; height: auto; min-height: 270px;" src='{{ asset("images/for_travelers/mainImg.jpg") }}'>
        <span style="position: absolute; left: 30px; bottom: 30px">
            <h1 class="h1-owners">{{__('messages.Information for travelers')}}</h1>
        </span>
    </div>

    <h2 class="mt-4 mb-1 h2-owners">{{__('messages.Why it is worth it')}}</h2>
    <div class="row mt-3">
        @include('includes.benifits')
    </div>

    <h2 class="mt-4 h2-owners">{{__('messages.How it works')}}</h2>
    <div class="row mt-3">
        <div id="guide-1" class="col-sm-12 col-md-4 mb-3">
            <div class="row mb-1">
                <div class="col-4"><img style="width: 100%; height: auto;" src='{{ asset("images/for_travelers/Search_96.png") }}'></div>
                <div class="col-6"><h3 class="h3-owners @mobile txt-blue @endmobile">{{__('messages.Find accommodation from')}} {{ countAllApartments() }} {{__('messages.objects2')}}</h3></div>
                <div class="col-2 mobile-none" style="position: relative">
                    <img src='{{ asset("images/for_travelers/arrow.png") }}' style="position: absolute; right: 0; top: 50%; transform: translateY(-50%);">
                </div>
            </div>
        </div>

        <span class="d-md-none">
            <div class="guide-1-popup guide-mobile-popup col-sm-12 col-md-4 mb-3">
                @include('includes.slider-for-travelers')
            </div>
        </span>

        <div id="guide-2" class="col-sm-12 col-md-4 mb-3">
            <div class="row mb-1">
                <div class="col-4"><img style="width: 100%; height: auto;" src='{{ asset("images/for_travelers/Check_96.png") }}'></div>
                <div class="col-6"><h3 class="h3-owners @mobile txt-blue @endmobile">{{__('messages.Book chosen object')}}</h3></div>
                <div class="col-2 mobile-none" style="position: relative">
                    <img src='{{ asset("images/for_travelers/arrow.png") }}' style="position: absolute; right: 0; top: 50%; transform: translateY(-50%);">
                </div>
            </div>
        </div>

        <span class="d-md-none">
            <div class="guide-2-popup guide-mobile-popup col-sm-12 col-md-4 mb-3">
                <span class="font-13">{{__('messages.TravelersInfo1')}} {{__('messages.TravelersInfo2')}}</span>
                <div><img class="w-100" src='{{ asset('images/for_travelers/pop2-inside-apartment.jpg') }}'></div>
            </div>
        </span>

        <div id="guide-3" class="col-sm-12 col-md-4 mb-3">
            <div class="row mb-1">
                <div class="col-4"><img style="width: 100%; height: auto;" src='{{ asset("images/for_travelers/User_Message_1_96.png") }}'></div>
                <div class="col-8"><h3 class="h3-owners @mobile txt-blue @endmobile">{{__('messages.Share your opinion')}}</h3></div>
            </div>
        </div>

        <span class="d-md-none">
            <div class="guide-3-popup guide-mobile-popup col-sm-12 col-md-4 mb-3">
                {{__('messages.travelers3')}}
                {{__('messages.travelers4')}}
                {{__('messages.travelers5')}}
                <img style="width: 100%" src='{{ asset('images/for_travelers/pop3-inside.jpg') }}'>
            </div>
        </span>
    </div>

<span class="d-none d-md-block">
    <div class="row">
        <div class="guide-1-popup guide-popup" style="background-image: url('{{ asset('images/for_travelers/popup.png') }}');">
            <div class="container searchCont">
                <span style="position: absolute; top: 40px; left: 50%;transform: translateX(-50%);width: 70%;">{{__('messages.travelers1')}}</span>
                @include('includes.slider-for-travelers')
            </div>
        </div>
    </div>
    <div class="row">
        <div class="guide-2-popup guide-popup px-4" style="background-image: url('{{ asset('images/for_travelers/popup2.png') }}');">
            <div class="row" style="margin: 40px 10px 20px 10px;">
                <div class="col-6 col-lg-7">{{__('messages.TravelersInfo1')}}{{__('messages.TravelersInfo2')}}</div>
                <div class="col-6 col-lg-4"><img class="img-fluid" src='{{ asset('images/for_travelers/pop2-inside-apartment.jpg') }}'></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="guide-3-popup guide-popup px-4" style="background-image: url('{{ asset('images/for_travelers/popup3.png') }}');">
            <div class="row" style="margin: 40px 10px 20px 10px;">
                <div class="col-6 col-lg-8" style="margin-top: 40px;text-align: center;">
                    <div class="my-2">{{__('messages.travelers3')}}</div>
                    <div class="my-2">{{__('messages.travelers4')}}</div>
                    <div class="my-2">{{__('messages.travelers5')}}</div>
                </div>
                <div class="col-6 col-lg-4"><img class="img-fluid" src='{{ asset('images/for_travelers/pop3-inside.jpg') }}'></div>
            </div>
        </div>
    </div>
</span>

    <div class="row py-3 mt-4 mx-0" style="background-color: #cfcfcf">
        <div class="col-sm-12 col-md-4">
            <div class="row mb-sm-30">
                <div class="col-4"><img style="width: 100%; height: auto;" src='{{ asset("images/for_travelers/icon.png") }}'></div>
                <div class="col-8">
                    <span class="font-16 font-m-13">
                        "Szybko znalazłam na stronie wygodny apartament na nasz spontaniczny wyjazd, zależało nam na szczególnie na kominku. Kilka kliknięć i rezerwacja była już potwierdzona, a nam zostało pakowanie się do drogi."
                    </span>
                    <br><br>
                    <span class="font-13 font-m-11">Karolina, Kraków</span>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-4">
            <div class="row mb-sm-30">
                <div class="col-4"><img style="width: 100%; height: auto;" src='{{ asset("images/for_travelers/icon.png") }}'></div>
                <div class="col-8">
                    <span class="font-16 font-m-13">
                        "Bardzo duży wybór obiektów. Wszystko jasno i przejrzyście opisane jest na stronie. Na miejscu potwierdziło się, że apartament wygląda tak jak na zdjęciach. Polecam."
                    </span>
                    <br><br><br>
                    <span class="font-13 font-m-11">Andrzej, Chełm</span>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-4">
            <div class="row mb-sm-30">
                <div class="col-4"><img style="width: 100%; height: auto;" src='{{ asset("images/for_travelers/icon.png") }}'></div>
                <div class="col-8">
                    <span class="font-16 font-m-13">
                        "Szukaliśmy noclegu dla 4 rodzin z dziećmi – udało nam się znaleźć apartamenty w jednym kompleksie. Fajnie, że są w ten sposób wyszczególnione w wyszukiwarce.  Sam pobyt bardzo udany."
                    </span>
                    <br><br>
                    <span class="font-13 font-m-11">Kinga, Białystok</span>
                </div>
            </div>
        </div>
    </div>

    <div>
        <span class="faq-header">{{__('messages.Contact')}}</span>
        {{--<a class="@desktop pull-right @else d-block @enddesktop font-14" href="#account">{{__('messages.Account number for payments for reservations')}} ↓</a>--}}
    </div>

    <div class="row mb-3 mb-md-5">
        <div class="col-md-6 col-lg-7">
            <div class="contact-box font-14">
                <div class="row mb-3 mb-md-5">
                    <div class="col-lg-6">
                        {{--
                        <div class="mb-3 pb-3" style="border-bottom: dashed 1px black">
                            {{__('messages.We invite you to familiarize yourself with')}}
                            <a href="#faq">{{__('messages.frequently asked questions by travelers')}}</a>
                        </div>
                        --}}
                        <a href="mailto:{{ $infos['contact_email'] }}" class="btn btn-black mb-3" style="width: 100%">{{__('messages.Write to us')}}</a>
                        <span class="font-12">{{__('messages.Talk with us via')}} Skype:</span>
                        <a href="skype:{{ $infos['skype'] }}?call">
                            <img src="{{asset('images/contact/callMe.png')}}" alt="call me via Skype">
                        </a>
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
                        <div class="bold">{{__('messages.Headquarters')}}</div>
                        {!! $infos['headquarter'] !!}
                    </div>
                    <div class="col-6">
                        <div class="bold">{{__('messages.Working hours')}}</div>
                        <div><span style="min-width: 54px; display: inline-block;">{{__('messages.MonToFri')}}</span><span class="ml-1">8:00 - 22:00</span></div>
                        <div><span style="min-width: 54px; display: inline-block;">{{__('messages.SatToSun')}}</span><span class="ml-1">9:00 - 22:00</span></div>
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
                <div class="bold mb-3" style="font-size: 18px">{{__('messages.Account number for payments for reservations')}}</div>
                <div><span class="bold">{{__('messages.Account')}} (PLN):</span> {{ $infos['accountPLN'] }}</div>
                <div><span class="bold">{{__('messages.Account')}}  (EURO):</span> {{ $infos['accountEUR'] }}</div>
                <div><span class="bold">Kod SWIFT:</span> {{ $infos['SWIFTcode'] }}</div>
                <div class="mt-5">OtoZakopane {{__('messages.belongs to vg')}}</div>
                <div class="mt-3"><span class="bold">NIP:</span> {{ $infos['NIP'] }}</div>
                <div><span class="bold">Regon:</span> {{ $infos['Regon'] }}</div>
            </div>
        </div>
    </div>

    {{--<h2 class="mt-4 h2-owners">{{__('messages.Media about us')}}</h2>
    <div class="row mb-5">
        <div class="col-sm-12 col-md-4">
            <div class="row mb-4">
                <div class="col-5"><img style="width: 100%; height: 60px;" src='{{ asset("images/for_travelers/icon.png") }}'></div>
                <div class="col-7">
                    <a href="#" class="font-16 font-m-13">Tytuł artykułu lorem ipsum</a>
                    <br>
                    <span class="font-13">Dziennik Bałtycki</span>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-4">
            <div class="row mb-4">
                <div class="col-5"><img style="width: 100%; height: 60px;" src='{{ asset("images/for_travelers/icon.png") }}'></div>
                <div class="col-7">
                    <a href="#" class="font-16 font-m-13">Tytuł artykułu lorem ipsum</a>
                    <br>
                    <span class="font-13">Dziennik Bałtycki</span>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-4">
            <div class="row">
                <div class="col-5"><img style="width: 100%; height: 60px;" src='{{ asset("images/for_travelers/icon.png") }}'></div>
                <div class="col-7">
                    <a href="#" class="font-16 font-m-13">Tytuł artykułu lorem ipsum</a>
                    <br>
                    <span class="font-13">Dziennik Bałtycki</span>
                </div>
            </div>
        </div>
    </div>
    --}}
    <h2 class="mt-4 h2-owners">{{--__('messages.help')--}}</h2>
    <div class="row mb-3">
        <div class="col-12 col-md-4">
            {{--<div class="mb-2"><a href="#" class="font-16 font-m-13">Tytuł artykułu lorem ipsum</a></div>
            <div class="mb-2"><a href="#" class="font-16 font-m-13">Tytuł artykułu lorem ipsum</a></div>
            <div class="mb-2"><a href="#" class="font-16 font-m-13">Tytuł artykułu lorem ipsum</a></div>
            <div class="mb-2"><a href="#" class="font-16 font-m-13">Tytuł artykułu lorem ipsum</a></div>
            <div class="mb-2"><a href="#" class="font-16 font-m-13">Tytuł artykułu lorem ipsum</a></div>
            --}}
        </div>
        {{--
        <div class="col-12 col-md-8">
            <div class="row mobile-none" style="margin-bottom: 28px">
                <div class="col-12">
                    <div style="width:100%; min-height: 125px; background-color: #cfcfcf; border: 1px solid black; padding: 12px 20px">
                        <h4 style="font-size: 24px; font-weight: bold; margin-bottom: 15px">{{__('messages.Do you have any questions? Contact with us')}}</h4>
                        <div class="mr-2" style="float: left"><img src='{{ asset("images/for_travelers/Call_48.png") }}'></div>
                        <a href="mailto: {{ $infos['contact_email'] }}" class="btn btn-black pull-right" style="width: 170px">{{__('messages.Write to us')}}</a>
                        <span style="font-size: 20px;">{{__('messages.phoneShort')}}: {{ $infos['first_phone'] }}, {{ $infos['second_phone'] }}</span><br>
                        <span class="font-13" style="display: inline-block">{{__('messages.monToFri')}}, 8:00-18:00</span>
                    </div>
                </div>
            </div>
            <div class="row desktop-none mt-4" style="margin-bottom: 28px">
                <div style="width:100%; min-height: 125px; background-color: #cfcfcf; border: 1px solid black; width: 408px; padding: 16px 20px">
                    <h4 style="font-size: 18px; font-weight: bold; margin-bottom: 15px">{{__('messages.Do you have any questions? Contact with us')}}</h4>
                    <div class="mr-2" style="float: left"><img src='{{ asset("images/for_owners/icon2.png") }}'></div>
                    <span class="font-13 bold" style="display: inline-block">{{__('messages.phoneShort')}}: {{ $infos['first_phone'] }}, {{ $infos['second_phone']}}</span>
                    <span class="font-13" style="display: inline-block;">{{__('messages.monToFri')}}, 8:00-18:00</span>
                    <div style="clear: both"></div>
                    <button class="btn btn-black mt-4" style="width: 100%">{{__('messages.Write to us')}}</button>
                </div>
            </div>
        </div>
        --}}
    </div>
</div>

<script>
    $('#guide-1').click(function() {
        if($('.guide-1-popup').is(":visible")) $('.guide-1-popup').hide();
        else $('.guide-1-popup').show();
        $('.guide-2-popup').hide();
        $('.guide-3-popup').hide();
    });

    $('#guide-2').click(function() {
        if($('.guide-2-popup').is(":visible")) $('.guide-2-popup').hide();
        else $('.guide-2-popup').show();
        $('.guide-1-popup').hide();
        $('.guide-3-popup').hide();
    });

    $('#guide-3').click(function() {
        if($('.guide-3-popup').is(":visible")) $('.guide-3-popup').hide();
        else $('.guide-3-popup').show();
        $('.guide-1-popup').hide();
        $('.guide-2-popup').hide();
    });

@desktop
    $('#guide-1').hover(function() {
        $('.guide-1-popup').show();
        $('.guide-2-popup').hide();
        $('.guide-3-popup').hide();
    });

    $('#guide-2').hover(function() {
        $('.guide-2-popup').show();
        $('.guide-1-popup').hide();
        $('.guide-3-popup').hide();
    });

    $('#guide-3').hover(function() {
        $('.guide-3-popup').show();
        $('.guide-1-popup').hide();
        $('.guide-2-popup').hide();
    });
@enddesktop
</script>

@endsection