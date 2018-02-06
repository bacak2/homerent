@extends ('layout.layout')
@section('title', '- Wyszukiwarka')
@section('content')
<div class="container pt-5 pb-5 results-search">
<div class="col">

    @include('includes.search-form-results')
</div>
</div>
	<div class="container" id="apartamentsforyou">
	<h3 class="pb-2">{{__('messages.found')}} {{ $counted }} {{trans_choice('messages.apartaments',$counted)}} 
	</h3>



		<div class="row">
			@foreach ($finds as $apartament)
		      <a class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3" href="/apartaments/{{ $apartament->apartament_link }}">
		        <div style="background-image: url('{{ asset("images/apartaments/$apartament->id/1.jpg") }}'); background-size: cover;"  class="apartament">
		        <p class="title">{{$apartament->apartament_name}}</p>

		      </div>
		      </a>
			@endforeach 	
		</div>
	</div>

<div id="lang" style="display: none;">
        {{ App::getLocale() }}
</div>

<script type="text/javascript">
{{-- 
moment.locale('fr', {
    months : 'janvier_février_mars_avril_mai_juin_juillet_août_septembre_octobre_novembre_décembre'.split('_'),
    monthsShort : 'janv._févr._mars_avr._mai_juin_juil._août_sept._oct._nov._déc.'.split('_'),
    monthsParseExact : true,
    weekdays : 'dimanche_lundi_mardi_mercredi_jeudi_vendredi_samedi'.split('_'),
    weekdaysShort : 'dim._lun._mar._mer._jeu._ven._sam.'.split('_'),
    weekdaysMin : 'Di_Lu_Ma_Me_Je_Ve_Sa'.split('_'),
    weekdaysParseExact : true,
    longDateFormat : {
        LT : 'HH:mm',
        LTS : 'HH:mm:ss',
        L : 'DD/MM/YYYY',
        LL : 'D MMMM YYYY',
        LLL : 'D MMMM YYYY HH:mm',
        LLLL : 'dddd D MMMM YYYY HH:mm'
    },
    calendar : {
        sameDay : '[Aujourd’hui à] LT',
        nextDay : '[Demain à] LT',
        nextWeek : 'dddd [à] LT',
        lastDay : '[Hier à] LT',
        lastWeek : 'dddd [dernier à] LT',
        sameElse : 'L'
    },
    relativeTime : {
        future : 'dans %s',
        past : 'il y a %s',
        s : 'quelques secondes',
        m : 'une minute',
        mm : '%d minutes',
        h : 'une heure',
        hh : '%d heures',
        d : 'un jour',
        dd : '%d jours',
        M : 'un mois',
        MM : '%d mois',
        y : 'un an',
        yy : '%d ans'
    },
    dayOfMonthOrdinalParse : /\d{1,2}(er|e)/,
    ordinal : function (number) {
        return number + (number === 1 ? 'er' : 'e');
    },
    meridiemParse : /PD|MD/,
    isPM : function (input) {
        return input.charAt(0) === 'M';
    },
    // In case the meridiem units are not separated around 12, then implement
    // this function (look at locale/id.js for an example).
    // meridiemHour : function (hour, meridiem) {
    //     return /* 0-23 hour, given meridiem token and hour 1-12 */ ;
    // },
    meridiem : function (hours, minutes, isLower) {
        return hours < 12 ? 'PD' : 'MD';
    },
    week : {
        dow : 1, // Monday is the first day of the week.
        doy : 4  // The week that contains Jan 4th is the first week of the year.
    }
});
--}}


$('.pick-date').dateRangePicker(
  {
    separator : ' to ',
    autoClose: true,
    startOfWeek: 'monday',
    language:'pl',
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
      var lang = document.getElementById("lang").textContent;
      if (lang == "pl"){
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


</script>
@endsection