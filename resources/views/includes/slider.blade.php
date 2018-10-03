<!-- Slider -->
<header>
  <div id="mainSliderSearch" class="carousel slide" data-ride="carousel" data-interval="7000">
      <div class="carousel-inner d-none d-xl-block">
          <div class="carousel-item active">
              <img class="d-block w-100" src="{{asset('images/slider/1.jpg')}}" alt="First slide">
          </div>
          <div class="carousel-item">
              <img class="d-block w-100" src="{{asset('images/slider/2.jpg')}}" alt="Second slide">
          </div>
          <div class="carousel-item">
              <img class="d-block w-100" src="{{asset('images/slider/3.jpg')}}" alt="Third slide">
          </div>
      </div>
      <div id="topSearch" style="background-image: url('{{asset('images/slider/1.jpg')}}');">
        <div class="container searchCont">
              <h1 class="d-block d-sm-none bold" style="text-shadow: 1px 1px 0 black;">{{ __('messages.Search among') }} {{ countAllApartments() }}<br>
                  {{ __('messages.accommodation in Poland') }}</h1>
              @include('includes.search-form')
        </div>
      </div>
  </div>
</header>

<script type="text/javascript">
        $('.t-datepicker').tDatePicker({
            autoClose: true,
            numCalendar: @handheld 1 @elsehandheld 2 @endhandheld,
            titleCheckIn: '{{ __('messages.arrival date') }}',
            titleCheckOut: '{{ __('messages.departure date') }}',
            titleToday: '{{ __('messages.Today') }}',
            titleDateRange: '{{ __('messages.Day') }}',
            titleDateRanges: '{{ __('messages.Days') }}',
            iconDate: '<i class="fa fa-lg fa-calendar" aria-hidden="true"></i>',
            titleDays: {!! titleDays() !!},
            titleMonths: {!! titleMonths() !!},
        });

        $("#wyszukiwarka").submit(function( event ) {
            var getDates = $('.t-datepicker').tDatePicker('getDates')
            if(getDates[0] == null){
                event.preventDefault();
                alert("{{ __('messages.Please select the date of your stay') }}");
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