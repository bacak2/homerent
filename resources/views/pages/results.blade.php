@extends ('layout.layout')
@section('title', '- Wyszukiwarka')
@section('content')
<div class="container pt-5 pb-5 results-search">
<div class="col">

    @include('includes.search-form-results')
</div>
</div>
	<div class="container" id="apartamentsforyou">

                @yield('displayResults')
	</div>
<div id="lang" style="display: none;">
        {{ App::getLocale() }}
</div>
<script type="text/javascript">

    $('.pick-date').dateRangePicker(
            {
                separator : ' to ',
                autoClose: true,
                startOfWeek: 'monday',
                language:'{{ App::getLocale() }}',
                startDate: new Date(),
                format: 'ddd D.M.YYYY',  //more formats at http://momentjs.com/docs/#/displaying/format/
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

        rangeBar();
        MrangeBar();
    }

    function rangeBar(){
        $( "#slider-range" ).slider({
            step: 50,
            range: true,
            min: 0,
            max: 1000,
            values: [ 0, 1000 ],
            slide: function( event, ui ) {
                $( "#amount" ).val( ui.values[ 0 ] );
                $( "#amount2" ).val( ui.values[ 1 ] );
            }
        });
        $( "#amount" ).val( $( "#slider-range" ).slider( "values", 0 ) );
        $( "#amount2" ).val( $( "#slider-range" ).slider( "values", 1 ) );
    }

    function MrangeBar(){
        $( "#Mslider-range" ).slider({
            step: 50,
            range: true,
            min: 0,
            max: 1000,
            values: [ 0, 1000 ],
            slide: function( event, ui ) {
                $( "#Mamount" ).val( ui.values[ 0 ] );
                $( "#Mamount2" ).val( ui.values[ 1 ] );
            }
        });
        $( "#Mamount" ).val( $( "#Mslider-range" ).slider( "values", 0 ) );
        $( "#Mamount2" ).val( $( "#Mslider-range" ).slider( "values", 1 ) );
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