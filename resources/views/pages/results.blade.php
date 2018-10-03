@extends ('layout.layout')
@section('title', __('messages.Search'))
@section('content')

@handheld
@if(Request::is('*/account/*') && !$request->has('t-start')) <div class="results-search" style="display: none"> @endif
     @switch($request->region)
        @case('Kościelisko') @case('kościelisko') <div id="topSearch" style="background-image: url('{{asset('images/slider/1.jpg')}}');"> @break
        @case('Zakopane') @case('zakopane') <div id="topSearch" style="background-image: url('{{asset('images/slider/2.jpg')}}');"> @break
        @case('Witów') @case('witów') <div id="topSearch" style="background-image: url('{{asset('images/slider/3.jpg')}}');"> @break
        @default <div id="topSearch" style="background-image: url('{{asset('images/slider/1.jpg')}}');">
     @endswitch
    <div class="container searchCont">
        @include('includes.search-form-results')
    </div>
</div>
@if(Request::is('*/account/*') && !$request->has('t-start')) </div> @endif
@elsehandheld
    <div class="container pt-5 pb-5 results-search" @if(Request::is('*/account/*') && !$request->has('t-start')) style="display: none" @endif>
        <div class="col">
            @include('includes.search-form-results')
        </div>
    </div>
@endhandheld
	<div class="container" id="apartamentsforyou">
        @yield('displayResults')
	</div>
<div id="lang" style="display: none;">
        {{ App::getLocale() }}
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    $('.t-datepicker').tDatePicker({
        autoClose: true,
        numCalendar : @handheld 1 @elsehandheld 2 @endhandheld,
        dateCheckIn: '{{$_GET['t-start'] ?? ''}}',
        dateCheckOut: '{{$_GET['t-end'] ?? ''}}',
        titleCheckIn: '{{ __('messages.arrival date') }}',
        titleCheckOut: '{{ __('messages.departure date') }}',
        titleToday: '{{ __('messages.Today') }}',
        titleDateRange: '{{ __('messages.Day') }}',
        titleDateRanges: '{{ __('messages.Days') }}',
        iconDate: '<i class="fa fa-lg fa-calendar" aria-hidden="true"></i>',
        titleDays: {!! titleDays() !!},
        titleMonths: {!! titleMonths() !!},

    });

    var options = {
        url: function(phrase) {
            return "autocomplete?phrase=" + phrase + "&format=json";
        },

        getValue: "apartament_name",

        theme: "",
        adjustWidth: false,

        template: {
            type: "description",
            fields: {
                description: "apartament_city"
            }


        }

    };


    $("#region").easyAutocomplete(options);

    $( ".dropdown-menu" ).click(function( event ) {
        event.stopPropagation();
    });

    function restoreDefaultFilters(){
        $("#1room").prop('checked', false);
        $("#2rooms").prop('checked', false);
        $("#3rooms").prop('checked', false);
        $("#4rooms").prop('checked', false);

        $("#spa").prop('checked', false);
        $("#zwierzeta").prop('checked', false);
        $("#garaz").prop('checked', false);
        $("#kominek").prop('checked', false);
        $("#balkon").prop('checked', false);

        $('#slider-range').slider('values', 0, 0);
        $('#slider-range').slider('values', 1, 15);
        $("#amount").val('0');
        $("#amount2").val('1000+');

        $('#Mslider-range').slider('values', 0, 0);
        $('#Mslider-range').slider('values', 1, 15);
        $("#Mamount").val('0');
        $("#Mamount2").val('1000+');
    }

@handheld
    var priceSlider = document.getElementById('priceSlider');
    var firstPrice = document.getElementById('Mamount');
    var secondPrice = document.getElementById('Mamount2');
    var inputs = [firstPrice, secondPrice];
    noUiSlider.create(priceSlider, {
        range: {
            'min': 0,
            '5%': 50,
            '10%': 100,
            '15%': 150,
            '20%': 200,
            '25%': 250,
            '30%': 300,
            '35%': 350,
            '40%': 400,
            '45%': 450,
            '50%': 500,
            '60%': 600,
            '70%': 700,
            '80%': 800,
            '90%': 900,
            'max': 1000
        },
        snap: true,
        start: [{{$request->Mamount ?? 0 }}, @if($request->Mamount2 == '1000+') {{1000}} @else {{$request->Mamount2 ?? 1000}} @endif],
        format: wNumb({
            decimals: 0,
        }),
    });

    priceSlider.noUiSlider.on('update', function( values, handle ) {
        if(values[handle] == 1000) values[handle] = '1000+';
        inputs[handle].value = values[handle];
    });

    function setSliderHandle(i, value) {
        var r = [null,null];
        r[i] = value;
        priceSlider.noUiSlider.set(r);
    }

    inputs.forEach(function(input, handle) {
        input.addEventListener('change', function(){
            setSliderHandle(handle, this.value);
        });
    });
@endhandheld

    function rangeBar(){

        myData = [ 0, 50, 100, 150, 200, 250, 300, 350, 400, 450, 500, 600, 700, 800, 900, 1000 ];

        switch({{$request->amount ?? 0}}) {
            case 50: amountStep = 1; break;
            case 100: amountStep = 2; break;
            case 150: amountStep = 3; break;
            case 200: amountStep = 4; break;
            case 250: amountStep = 5; break;
            case 300: amountStep = 6; break;
            case 350: amountStep = 7; break;
            case 400: amountStep = 8; break;
            case 450: amountStep = 9; break;
            case 500: amountStep = 10; break;
            case 600: amountStep = 11; break;
            case 700: amountStep = 12; break;
            case 800: amountStep = 13; break;
            case 900: amountStep = 14; break;
            case 1000: amountStep = 15; break;
            default:
                amountStep = 0;
        }

        switch({{$request->amount2 ?? 1000}}) {
            case 0: amountStep2 = 0; break;
            case 50: amountStep2 = 1; break;
            case 100: amountStep2 = 2; break;
            case 150: amountStep2 = 3; break;
            case 200: amountStep2 = 4; break;
            case 250: amountStep2 = 5; break;
            case 300: amountStep2 = 6; break;
            case 350: amountStep2 = 7; break;
            case 400: amountStep2 = 8; break;
            case 450: amountStep2 = 9; break;
            case 500: amountStep2 = 10; break;
            case 600: amountStep2 = 11; break;
            case 700: amountStep2 = 12; break;
            case 800: amountStep2 = 13; break;
            case 900: amountStep2 = 14; break;
            default:
                amountStep2 = 15;
        }

        slider_config = {
            range: true,
            min: 0,
            max: myData.length - 1,
            step: 1,
            slide: function( event, ui ) {
                // Set the real value into the inputs
                $('#amount').val( myData[ ui.values[0] ] );
                $('#amount2').val( myData[ ui.values[1] ] );

                if (myData[ ui.values[0] ] == 1000) $("#amount").val('1000+');
                if (myData[ ui.values[1] ] == 1000) $("#amount2").val('1000+');
            },
            create: function() {
                $(this).slider('values', 0, amountStep);
                $(this).slider('values', 1, amountStep2);
            }
        };

        // Render Slider
        $('#slider-range').slider(slider_config);
        $("#amount").val('<?php
            if($request->amount > 900) echo '1000+';
            else echo $request->amount ?? '0';
            ?>');
        $("#amount2").val('<?php
            if($request->amount2 > 900) echo '1000+';
            else echo $request->amount2 ?? '1000+';
            ?>');

    }

    function MrangeBar(){

        myData = [ 0, 50, 100, 150, 200, 250, 300, 350, 400, 450, 500, 600, 700, 800, 900, 1000 ];

        switch({{$request->amount ?? 0}}) {
            case 50: amountStep = 1; break;
            case 100: amountStep = 2; break;
            case 150: amountStep = 3; break;
            case 200: amountStep = 4; break;
            case 250: amountStep = 5; break;
            case 300: amountStep = 6; break;
            case 350: amountStep = 7; break;
            case 400: amountStep = 8; break;
            case 450: amountStep = 9; break;
            case 500: amountStep = 10; break;
            case 600: amountStep = 11; break;
            case 700: amountStep = 12; break;
            case 800: amountStep = 13; break;
            case 900: amountStep = 14; break;
            case 1000: amountStep = 15; break;
            default:
                amountStep = 0;
        }

        switch({{$request->amount2 ?? 1000}}) {
            case 0: amountStep2 = 0; break;
            case 50: amountStep2 = 1; break;
            case 100: amountStep2 = 2; break;
            case 150: amountStep2 = 3; break;
            case 200: amountStep2 = 4; break;
            case 250: amountStep2 = 5; break;
            case 300: amountStep2 = 6; break;
            case 350: amountStep2 = 7; break;
            case 400: amountStep2 = 8; break;
            case 450: amountStep2 = 9; break;
            case 500: amountStep2 = 10; break;
            case 600: amountStep2 = 11; break;
            case 700: amountStep2 = 12; break;
            case 800: amountStep2 = 13; break;
            case 900: amountStep2 = 14; break;
            default:
                amountStep2 = 15;
        }

        slider_config = {
            range: true,
            min: 0,
            max: myData.length - 1,
            step: 1,
            slide: function( event, ui ) {
                // Set the real value into the inputs
                $('#Mamount').val( myData[ ui.values[0] ] );
                $('#Mamount2').val( myData[ ui.values[1] ] );
                if (myData[ ui.values[0] ] == 1000) $("#Mamount").val('1000+');
                if (myData[ ui.values[1] ] == 1000) $("#Mamount2").val('1000+');
            },
            create: function() {
                $(this).slider('values', 0, amountStep);
                $(this).slider('values', 1, amountStep2);
            }
        };

        // Render Slider
        $('#Mslider-range').slider(slider_config);
        $("#Mamount").val('<?php
            if($request->amount > 900) echo '1000+';
            else echo $request->amount ?? '0';
            ?>');
        $("#Mamount2").val('<?php
            if($request->amount2 > 900) echo '1000+';
            else echo $request->amount2 ?? '1000+';
            ?>');
    }

    $( "a#resetFilters" ).click(function( event ) {
        event.stopPropagation();
        restoreDefaultFilters();
    });

    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });

    $(document).ready(function(){
        $("span.cenaRange").click(function(){
            $("div.cenaRange").toggle();
            $("i.cenaRange").toggleClass("fa-caret-down fa-caret-up");
        });

        $("span.lpokoi").click(function(){
            $("div.lpokoi").toggle();
            $("i.lpokoi").toggleClass("fa-caret-down fa-caret-up");
        });

        $("span.lozka").click(function(){
            $("div.lozka").toggle();
            $("i.lozka").toggleClass("fa-caret-down fa-caret-up");
        });

        $("span.budynek").click(function(){
            $("div.budynek").toggle();
            $("i.budynek").toggleClass("fa-caret-down fa-caret-up");
        });

        $("span.udogodnienia").click(function(){
            $("div.udogodnienia").toggle();
            $("i.udogodnienia").toggleClass("fa-caret-down fa-caret-up");
        });

        $("span.dzielnica").click(function(){
            $("div.dzielnica").toggle();
            $("i.dzielnica").toggleClass("fa-caret-up fa-caret-down");
        });

        $("span.opinie").click(function(){
            $("div.opinie").toggle();
            $("i.opinie").toggleClass("fa-caret-down fa-caret-up");
        });

        $("a.filters-toggle").click(function(){
            $("div.filters-toggle").toggle();
        });

        rangeBar();
        MrangeBar();

    });

@if(!Request::is('*/account/*'))
    function addToFavourites(apartamentId, userId){

        if(userId == 0) alert("{{__('messages.AddToFav1')}}");

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
                            htmlForeach += '<div class="row"> <div class="col-3" style="background-image: url(\'{{ url('/') }}/images/apartaments/' + responseMessage[2][i].id + '/main.jpg\'); background-size: cover; position: relative; margin-bottom: 0px; margin-left: 15px; padding-left: 0px; max-height: 52px;"></div> <div class="col-8 row" style="margin-right: -20px"> <div class="col-12 font-13 txt-blue"><a href="/apartaments/' + responseMessage[2][i].apartament_link + '">' + responseMessage[2][i].apartament_name + '</a></div> <div class="col-12 font-11 bold">' + responseMessage[2][i].apartament_address + '</div> <div class="col-12 font-11">' + responseMessage[2][i].apartament_address_2 + '</div> </div> <div class=""><img src="{{ asset("images/favourites/heart.png") }}"></div> </div> <hr>';
                        }

                        html = $('<span id="favourites-nav" onclick="$(\'#favourites-bar\').toggle();" class="nav-link">{{ __('messages.My favourites') }} (' + responseMessage[1] + ')</span> <div id="favourites-bar" style="border-bottom: 1px solid black; background-image: url({{ asset('images/account/favouritesPopup.png') }}); background-repeat: no-repeat; background-position: left top; display: none; position: absolute; left: 8px; width: 320px; z-index: 2000;"> <div class="p-3 pt-4"> <span class="bold" style="font-size: 24px">{{__('messages.My favourites')}} (' + responseMessage[1] + ')</span> <a class="font-11" onclick="clearFavouritesPopup()" href="#">{{__('messages.Clear list')}}</a> ' + htmlForeach + '<a class="btn btn-black px-2" href="{{route('myFavourites')}}">{{__('messages.All')}} (' + responseMessage[1] + ')</a> <a class="btn btn-black px-2" href="{{route('myFavouritesCompare')}}">{{__('messages.Compare')}}</a> <button class="send-to-friends btn btn-black px-2" onclick="$(\'#favourites-bar\').hide(); $(\'#send-to\').show();">{{__('messages.Send')}}</button> </div> </div>');
                        $('#fav-nav').html('');
                        html.appendTo('#fav-nav');

                        for (var i = 0; i < responseMessage[3].length; i++) {
                            htmlForeach2 += '<li> <span id="link'+responseMessage[3][i].id+'">{{ url('/') }}/pl/apartaments/'+responseMessage[3][i].apartament_link+'</span> <span class="txt-blue copy-to-clipboard" onclick="copyToClipboard(\'#link'+responseMessage[3][i].id+'\')">{{__('messages.Copy')}}</span> </li>';
                            foreachLinks += '{{ url('/') }}/pl/apartaments/'+responseMessage[3][i].apartament_link+',';
                        }

                        html2 = $('<span style="font-size: 24px; font-weight: bold">{{__('messages.Send to friend')}}</span><br><div class="row"><div class="col-2"><span class="font-14">{{__('messages.Links')}}:</span></div><div class="col-10"><ul class="font-13">'+ htmlForeach2 +'</ul></div></div><label for="emails">{{__('messages.Email addresses')}}:</label><input id="emails" name="emails" type="text" placeholder="{{__('messages.Emails ph')}}"><input id="links" name="links" type="hidden" value="'+foreachLinks+'"><hr><button onclick="sendMailToFriends()" class="btn btn-default">{{__('messages.Send')}}</button><button onClick="closeSendTo()" class="btn btn-default">{{__('messages.Cancel')}}</button><div onClick="closeSendTo()" id="close-send-to" class="close-send-to">x</div>');
                        $('#send-to').html('');
                        html2.appendTo('#send-to');
                    }

                    @if($favouritesAmount == 0 && Auth::check())
                    if(responseMessage[0] == 1) $("#first-added-favourites").show();
                    else alert("{{__('messages.AddToFav2')}}");
                    @else
                    if(responseMessage[0] == 1) responseAlert = "{{__('messages.AddToFav3')}}";
                    else responseAlert = "{{__('messages.AddToFav2')}}";
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
@endif
</script>
@endsection