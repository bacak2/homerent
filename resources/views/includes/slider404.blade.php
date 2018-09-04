<!-- Slider -->
<header>
  <div id="mainSliderSearch" class="carousel slide" data-ride="carousel" data-interval="7000">
      <div class="carousel-inner d-none d-md-block d-lg-block d-xl-block">
          <div class="carousel-item active">
              <img class="d-block w-100" src="/images/slider/1.jpg" alt="First slide">
          </div>
          <div class="carousel-item">
              <img class="d-block w-100" src="/images/slider/2.jpg" alt="Second slide">
          </div>
          <div class="carousel-item">
              <img class="d-block w-100" src="/images/slider/3.jpg" alt="Third slide">
          </div>
      </div>
      <div id="topSearch" style="background-image: {{url('/images/slider/1.jpg')}}">
        <h1 class="container" style="padding-top: 0px; color: white; font-size: 32px; font-weight: bold;">Strona, której szukasz nie istnieje</h1>
        <div class="container searchCont" style="padding-top: 60px;">
              <span style="color: white; font-size: 32px; font-weight: bold;">Szukaj wśród 34 678 noclegów w Polsce</span>
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