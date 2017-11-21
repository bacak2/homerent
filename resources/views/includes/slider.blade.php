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

            <div class="col">
              <form class="wyszukiwarka" action="/search" method="GET" >
                <div class="form-row">
                  <div class="col-md-3 mb-2 mb-sm-0">
                    <input type="text" class="form-control" id="region" name="region" placeholder="{{ __('messages.forexample')}}">
                  </div>
                  <div class="form-inline col-md-4 form-row pick-date ">
                      <div class="col-md-6 mb-2 mb-sm-0">
                          <div class="input-group mb-2 mb-sm-0">
                              <div class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></div>
                              <input type="text" class="form-control" id="przyjazd" name="przyjazd" placeholder="{{ __('messages.arrive')}}" pattern="(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))" required>
                          </div>
                      </div>
                      <div class="col-md-6 mb-2 mb-sm-0">
                          <div class="input-group mb-2 mb-sm-0">
                              <div class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></div>
                              <input type="text" class="form-control" id="powrot" name="powrot" placeholder="{{ __('messages.return')}}" pattern="(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))" required>
                          </div>
                      </div>
                  </div>
                  <div class="col-md">
                      <div class="input-group mb-2 mb-sm-0">
                        <div class="input-group-addon"><i class="fa fa-male" aria-hidden="true"></i></div>
                        <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="{{ __('messages.adults')}}">
                      </div>
                  </div>
                  <div class="col-md">
                    <div class="input-group mb-2 mb-sm-0">
                      <div class="input-group-addon"><i class="fa fa-child" aria-hidden="true"></i></div>
                      <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="{{ __('messages.kids')}}">
                    </div>
                  </div>
                  <div class="col-md">
                    <button type="submit" class="btn btn-primary searchbtn">{{ __('messages.search') }}</button>
                  </div>
                </div>
              </form>
            </div>
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