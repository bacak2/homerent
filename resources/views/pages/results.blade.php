@extends ('layout.layout')
@section('title', 'Wyszukiwarka')
@section('content')

@handheld
@if(Request::is('*/account/*') && !$request->has('przyjazd')) <div class="results-search" style="display: none"> @endif
     @switch($request->region)
        @case('Kraków') @case('kraków') <div id="topSearch" style="background-image: url('{{asset('images/slider/1.png')}}');"> @break
        @case('Zakopane') @case('zakopane') <div id="topSearch" style="background-image: url('{{asset('images/slider/2.png')}}');"> @break
        @case('Wrocław') @case('wrocław') <div id="topSearch" style="background-image: url('{{asset('images/slider/3.png')}}');"> @break
        @default <div id="topSearch" style="background-image: url('{{asset('images/slider/1.png')}}');">
     @endswitch
    <div class="container searchCont">
        @include('includes.search-form-results')
    </div>
</div>
@if(Request::is('*/account/*') && !$request->has('przyjazd')) </div> @endif
@elsehandheld
    <div class="container pt-5 pb-5 results-search" @if(Request::is('*/account/*') && !$request->has('przyjazd')) style="display: none" @endif>
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

    $('.pick-date').dateRangePicker(
            {
                separator : ' do ',
                autoClose: true,
                startOfWeek: 'monday',
                language:'{{ App::getLocale() }}',
                startDate: new Date(),
                format: 'ddd DD.MM.YYYY',  //more formats at http://momentjs.com/docs/#/displaying/format/
                customOpenAnimation: function(cb)
                {
                    $(this).fadeIn(100, cb);
                },
                customCloseAnimation: function(cb)
                {
                    $(this).fadeOut(100, cb);
                },

                getValue: function()
                {
                    if ($('#przyjazd').val() && $('#powrot').val() )
                        return $('#przyjazd').val() + ' to ' + $('#powrot').val();
                    else
                        return '';
                },
                setValue: function(s,s1,s2)
                {
                    if ('{{ App::getLocale() }}' == 'pl'){
                        s1 = s1.replace('Mon', 'Pon').replace('Tue', 'Wto').replace('Wed', 'Śro').replace('Thu', 'Czw').replace('Fri', 'Pią').replace('Sat', 'Sob').replace('Sun', 'Nie');
                        s2 = s2.replace('Mon', 'Pon').replace('Tue', 'Wto').replace('Wed', 'Śro').replace('Thu', 'Czw').replace('Fri', 'Pią').replace('Sat', 'Sob').replace('Sun', 'Nie');
                    }
                    $('#przyjazd').val(s1);
                    $('#powrot').val(s2);
                }
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
</script>
@endsection