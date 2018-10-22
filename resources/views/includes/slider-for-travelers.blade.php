<!-- Slider -->
<header>
  <div id="mainSliderSearch" class="carousel slide" data-ride="carousel" data-interval="7000">
      <div id="topSearch" style="height: 100%; top: 70px;" @tablet class="position-relative" @endtablet>
        <div class="container searchCont px-0" style="padding-top: 0px">
              <span class="d-block d-sm-none px-3" style="color: black">{{__('messages.travelers1')}}</span>
              @include('includes.search-form')
        </div>
      </div>
  </div>
</header>

<script type="text/javascript">
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

var jsCalendarLegend = false;

$("#region").easyAutocomplete(options);

$("#wyszukiwarka").submit(function( event ) {
    var getDates = $('.t-datepicker').tDatePicker('getDates')
    if(getDates[0] == null){
        event.preventDefault();
        alert("{{ __('messages.Please select the date of your stay') }}");
    }
});

</script>