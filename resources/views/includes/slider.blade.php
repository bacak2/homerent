<div id="search-slider">
	<div class="search">
		<div class="search-wrapper">
			<div class="region">{{ __('messages.entercity') }}</div>
			<div class="przyjazd">{{ __('messages.arrive') }}</div>
			<div class="przyjazd">{{ __('messages.return') }}</div>
		<form action="/search" method="GET" class="form-search">
			<input type="text" id="region" name="region" placeholder="{{ __('messages.forexample') }}">
			<input type="text" id="przyjazd" name="przyjazd">
			<input type="text" id="powrot">
			<input type="number"  value="0" min="0" max="100" id="nights" >
			<input type="number"  value="0" min="0" max="100" id="persons" >
			<input type="submit" id="submit" value="{{ __('messages.search') }}">
		</div>
		</form>
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