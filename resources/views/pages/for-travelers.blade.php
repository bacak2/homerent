@extends ('pages.results')
@section('title', __('messages.For travelers2'))

@section('content')
<div class="container">
    <div class="img-container" style="position: relative">
        <img style="width: 100%; height: auto; min-height: 270px;" src='{{ asset("images/for_travelers/mainImg.png") }}'>
        <span style="position: absolute; left: 30px; bottom: 30px">
            <h1 class="h1-owners">{{__('messages.Information for travelers')}}</h1>
        </span>
    </div>

    <h2 class="mt-4 mb-1 h2-owners">{{__('messages.Why it is worth it')}}</h2>
    <div class="row mt-3">
        <div class="col-sm-12 col-md-4 mb-3">
            <div class="row mb-1">
                <div class="col-4"><img style="width: 100%; height: auto;" src='{{ asset("images/for_travelers/procent.png") }}'></div>
                <div class="col-8"><h3 class="h3-owners">{{__('messages.cheap')}}</h3><span class="font-13">{{__('messages.travelersWhy1')}}</span></div>
            </div>
        </div>
        <div class="col-sm-12 col-md-4 mb-3">
            <div class="row mb-1">
                <div class="col-4"><img style="width: 100%; height: auto;" src='{{ asset("images/for_travelers/time.png") }}'></div>
                <div class="col-8"><h3 class="h3-owners">{{__('messages.fast')}}</h3><span class="font-13">{{__('messages.travelersWhy2')}}</span></div>
            </div>
        </div>
        <div class="col-sm-12 col-md-4">
            <div class="row mb-1">
                <div class="col-4"><img style="width: 100%; height: auto;" src='{{ asset("images/for_travelers/up.png") }}'></div>
                <div class="col-8"><h3 class="h3-owners">{{__('messages.safe')}}</h3><span class="font-13">{{__('messages.safeExp')}} {{ countAllReservations() }} {{__('messages.travelersWhy3')}}</span></div>
            </div>
        </div>
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
                <span class="font-13">
                    {{__('messages.TravelersInfo1')}}
                </span>
                <img style="width: 100%" src='{{ asset('images/for_travelers/pop2-inside-').App::getLocale().'.png' }}'>
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
                <img style="width: 100%" src='{{ asset('images/for_travelers/pop3-inside-').App::getLocale().'.png' }}'>
            </div>
        </span>
    </div>

<span class="d-sm-none d-md-block">
    <div class="row">
        <div class="guide-1-popup guide-popup" style="background-image: url('{{ asset('images/for_travelers/popup.png') }}');">
            <div class="container searchCont">
                @include('includes.slider-for-travelers')
            </div>
        </div>
    </div>

    <div class="row">
        <div class="guide-2-popup guide-popup px-4" style="background-image: url('{{ asset('images/for_travelers/popup2.png') }}');">
            <div class="row" style="margin: 40px 10px 0px 10px;">
                <div class="col-4 @handheld font-11 @endhandheld" style="position: relative;">
                    {{__('messages.TravelersInfo1')}}
                    <br><br>
                    {{__('messages.TravelersInfo2')}}
                    <br><br>
                    {{__('messages.TravelersInfo3')}}
                    <span style="position: absolute; bottom: 10px; left: 6px;">
                        <img src='{{ asset('images/for_travelers/miniIcon.png') }}'>
                        <img src='{{ asset('images/for_travelers/miniIcon.png') }}'>
                        <img src='{{ asset('images/for_travelers/miniIcon.png') }}'>
                    </span>
                </div>
                <div class="col-8">
                    <img style="margin: 20px 40px 30px 40px; width: 100%" src='{{ asset('images/for_travelers/pop2-inside-').App::getLocale().'.png' }}'>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="guide-3-popup guide-popup px-4" style="background-image: url('{{ asset('images/for_travelers/popup3.png') }}');">
            <img style="margin: 40px 0px; border: 1px solid black; width: 100%" src='{{ asset('images/for_travelers/pop3-inside-').App::getLocale().'.png' }}'>
        </div>
    </div>
</span>

    <div class="row py-3 mt-4" style="background-color: #cfcfcf">
        <div class="col-sm-12 col-md-4">
            <div class="row mb-sm-30">
                <div class="col-4"><img style="width: 100%; height: auto;" src='{{ asset("images/for_travelers/icon.png") }}'></div>
                <div class="col-8">
                    <span class="font-16 font-m-13">
                        "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. "
                    </span>
                    <br><br>
                    <span class="font-13 font-m-11">Joanna, Zakopane</span>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-4">
            <div class="row mb-sm-30">
                <div class="col-4"><img style="width: 100%; height: auto;" src='{{ asset("images/for_travelers/icon.png") }}'></div>
                <div class="col-8">
                    <span class="font-16 font-m-13">
                        "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. "
                    </span>
                    <br><br>
                    <span class="font-13 font-m-11">Joanna, Zakopane</span>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-4">
            <div class="row mb-sm-30">
                <div class="col-4"><img style="width: 100%; height: auto;" src='{{ asset("images/for_travelers/icon.png") }}'></div>
                <div class="col-8">
                    <span class="font-16 font-m-13">
                        "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. "
                    </span>
                    <br><br>
                    <span class="font-13 font-m-11">Joanna, Zakopane</span>
                </div>
            </div>
        </div>
    </div>

    <h2 class="mt-4 h2-owners">{{__('messages.Media about us')}}</h2>
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

    <h2 class="mt-4 h2-owners">{{__('messages.help')}}</h2>
    <div class="row mb-3">
        <div class="col-12 col-md-4">
            <div class="mb-2"><a href="#" class="font-16 font-m-13">Tytuł artykułu lorem ipsum</a></div>
            <div class="mb-2"><a href="#" class="font-16 font-m-13">Tytuł artykułu lorem ipsum</a></div>
            <div class="mb-2"><a href="#" class="font-16 font-m-13">Tytuł artykułu lorem ipsum</a></div>
            <div class="mb-2"><a href="#" class="font-16 font-m-13">Tytuł artykułu lorem ipsum</a></div>
            <div class="mb-2"><a href="#" class="font-16 font-m-13">Tytuł artykułu lorem ipsum</a></div>
        </div>
        <div class="col-12 col-md-8">
            <div class="row mobile-none" style="margin-bottom: 28px">
                <div class="col-12">
                    <div style="width:100%; min-height: 125px; background-color: #cfcfcf; border: 1px solid black; padding: 12px 20px">
                        <h4 style="font-size: 24px; font-weight: bold; margin-bottom: 15px">{{__('messages.Do you have any questions? Contact with us')}}</h4>
                        <div class="mr-2" style="float: left"><img src='{{ asset("images/for_travelers/Call_48.png") }}'></div>
                        <a href="mailto: {{ $infos->contact_email }}" class="btn btn-black pull-right" style="width: 170px">{{__('messages.Write to us')}}</a>
                        <span style="font-size: 20px;">{{__('messages.phoneShort')}}: {{ $infos->first_phone }}, {{ $infos->second_phone }}</span><br>
                        <span class="font-13" style="display: inline-block">{{__('messages.monToFri')}}, 8:00-18:00</span>
                    </div>
                </div>
            </div>
            <div class="row desktop-none mt-4" style="margin-bottom: 28px">
                <div style="width:100%; min-height: 125px; background-color: #cfcfcf; border: 1px solid black; width: 408px; padding: 16px 20px">
                    <h4 style="font-size: 18px; font-weight: bold; margin-bottom: 15px">{{__('messages.Do you have any questions? Contact with us')}}</h4>
                    <div class="mr-2" style="float: left"><img src='{{ asset("images/for_owners/icon2.png") }}'></div>
                    <span class="font-13 bold" style="display: inline-block">{{__('messages.phoneShort')}}: {{ $infos->first_phone }}, {{ $infos->second_phone }}</span>
                    <span class="font-13" style="display: inline-block;">{{__('messages.monToFri')}}, 8:00-18:00</span>
                    <div style="clear: both"></div>
                    <button class="btn btn-black mt-4" style="width: 100%">{{__('messages.Write to us')}}</button>
                </div>
            </div>
        </div>
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