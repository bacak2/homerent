<!-- Slider -->
<header>
  <div id="mainSliderSearch" class="carousel slide" data-ride="carousel" data-interval="7000">
      <div class="carousel-inner d-none d-md-block d-lg-block d-xl-block">
          <div class="carousel-item active">
              <img class="d-block w-100" src="/images/slider/1.png" alt="First slide">
          </div>
          <div class="carousel-item">
              <img class="d-block w-100" src="/images/slider/2.png" alt="Second slide">
          </div>
          <div class="carousel-item">
              <img class="d-block w-100" src="/images/slider/3.png" alt="Third slide">
          </div>
      </div>
      <div id="topSearch" style="background-image: url('/images/slider/1.png');">
        <h1 class="container" style="padding-top: 0px; color: white; font-size: 32px; font-weight: bold;">Strona, której szukasz nie istnieje</h1>
        <div class="container searchCont" style="padding-top: 60px;">
              <span style="color: white; font-size: 32px; font-weight: bold;">Szukaj wśród 34 678 noclegów w Polsce</span>
              @include('includes.search-form')
        </div>
      </div>
  </div>
</header>

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
      if ('{{ App::getLocale() }}' == 'pl') {
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