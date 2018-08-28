<!-- Slider -->
<header>
  <div id="mainSliderSearch" class="carousel slide" data-ride="carousel" data-interval="7000">
      <div class="carousel-inner d-none d-xl-block">
          <div class="carousel-item active">
              <img class="d-block w-100" src="{{asset('images/slider/1.png')}}" alt="First slide">
          </div>
          <div class="carousel-item">
              <img class="d-block w-100" src="{{asset('images/slider/2.png')}}" alt="Second slide">
          </div>
          <div class="carousel-item">
              <img class="d-block w-100" src="{{asset('images/slider/3.png')}}" alt="Third slide">
          </div>
      </div>
      <div id="topSearch" style="background-image: url('{{asset('images/slider/1.png')}}');">
        <div class="container searchCont">
              <h1 class="d-block d-sm-none">Szukaj wśród 34 678<br>
              noclegów w Polsce</h1>
              @include('includes.search-form')
        </div>
      </div>
  </div>
</header>

<script type="text/javascript">
        $('.t-datepicker').tDatePicker({
            autoClose: true,
            numCalendar: @handheld 1 @elsehandheld 2 @endhandheld,
            titleCheckIn: 'Data przyjazdu',
            titleCheckOut: 'Data wyjazdu',
            titleToday: 'Dzisiaj',
            titleDateRange: 'Doba',
            titleDateRanges: 'Doby',
            iconDate: '<i class="fa fa-lg fa-calendar" aria-hidden="true"></i>',
            titleDays: ['Pn', 'Wt', 'Śr', 'Cz', 'Pt', 'Sb', 'Nd'],
            titleMonths: ['Styczeń', 'Luty', 'Marzec', 'Kwiecień', 'Maj', 'Czerwiec', 'Lipiec', 'Sierpień', 'Wrzesień', 'Październik', 'Listopad', 'Grudzień'],
        });

        $("#wyszukiwarka").submit(function( event ) {
            var getDates = $('.t-datepicker').tDatePicker('getDates')
            if(getDates[0] == null){
                event.preventDefault();
                alert("Proszę wybrać termin pobytu");
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