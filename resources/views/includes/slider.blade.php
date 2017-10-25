<style type="text/css">
	.easy-autocomplete-container {
    width: 50%;
    margin-top: 45px;
}

</style>

<div id="search-slider">
	<div class="search">
		<div class="search-wrapper">
		<form action="/search" method="GET" class="form-search">
			<input type="text"  id="region" name="region" placeholder="{{ __('messages.forexample') }}" required>
			<input type="text" class="date" id="przyjazd" name="przyjazd" placeholder='{{__('messages.choosedate')}}' pattern="(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))" required>
			<input type="text" class="date" id="powrot" name="powrot" placeholder='{{__('messages.choosedate')}}' pattern="(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))" required>
			<input type="number"  value="0" min="0" max="100" id="nights" >
			<input type="number"  value="0" min="0" max="100" id="persons" > 
			<input type="submit" id="submit" value="{{ __('messages.search') }}"> 
		</form>
		</div>
	</div>

	<div class="ism-slider" data-transition_type="fade" data-play_type="loop" data-image_fx="none" data-buttons="false" id="slider">
	  <ol>
	    <li>
	      <img src="{{ asset('ism/image/slides/tatry1.jpg') }}">
	    </li>
	    <li>
	      <img src="{{ asset('ism/image/slides/krakow-city.jpg') }}">
	    </li>
	    <li>
	      <img src="{{ asset('ism/image/slides/tatry2.jpg') }}">
	    </li>
	    <li>
	      <img src="{{ asset('ism/image/slides/gdansk.jpg') }}">
	    </li>
	  </ol>
	</div>
</div>

<script type="text/javascript">
	$( "#przyjazd" ).datepicker({
		defaultDate: new Date(),
		dateFormat: "yy-mm-dd",
		minDate: new Date(), 
		onSelect: function(dateStr) 
		{         
			$("#powrot").datepicker("destroy");
			$("#powrot").val(dateStr);
			$("#powrot").datepicker({ 
				minDate: new Date(dateStr),
				dateFormat: "yy-mm-dd",
			})
		},
		onClose: function()
		{
			$("#powrot").focus();
		}
	});
	$( "#powrot").datepicker({
        defaultDate: new Date(),
		dateFormat: "yy-mm-dd",
		minDate: new Date(), 
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
			description: "apartament_address"
		}


	}

};


	$("#region").easyAutocomplete(options);

 	$('.ui-autocomplete-input').css('height','300px');

</script>