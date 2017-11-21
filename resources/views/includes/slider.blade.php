<!-- Slider -->
<header>
  <div id="mainSliderSearch" class="carousel slide" data-ride="carousel" data-interval="4000">
      <div class="carousel-inner d-none d-md-block d-lg-block d-xl-block">
          <div class="carousel-item active">
              <img class="d-block w-100" src="images/slider/1.png" alt="First slide">
          </div>
          <div class="carousel-item">
              <img class="d-block w-100" src="images/slider/2.png" alt="Second slide">
          </div>
          <div class="carousel-item">
              <img class="d-block w-100" src="images/slider/3.png" alt="Third slide">
          </div>
      </div>
      <div id="topSearch">
        <div class="container searchCont">
              <h4 class="d-block d-sm-none">Szukaj wśród 34 678<br>
              noclegów w Polsce</h4>
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
    startDate: new Date(),
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