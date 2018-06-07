    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: white;" >
      <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">Homent</a>
			<div class="row mx-auto">        
		    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
		            <a style="text-decoration: none;" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
		                <img src="{{ asset("images/flags/".$localeCode.".gif") }}">&nbsp;
		            </a>
		    @endforeach
		</div>

       <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navMenuTop" aria-controls="navMenuTop" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navMenuTop">
          <ul class="navbar-nav ml-auto">
          	@guest
	            <li class="nav-item">
	              <a class="nav-link" id="log-in" href="#">{{ __('messages.login')}}</a>
	            </li>
	            <li class="nav-item">
	              <a class="nav-link" id="sign-up" href="#">{{ __('messages.register')}}</a>
	            </li>
	        @else
                  <li class="nav-item" style="position: relative">
                    <span id="favourites-nav-item">
                      <span id="favourites-nav" class="nav-link">{{ __('messages.My favourites') }} ({{Session::get('userFavouritesCount')}})</span>
                      <div id="favourites-bar" style="border-bottom: 1px solid black; background-image: url('{{ asset('images/account/favouritesPopup.png') }}'); background-repeat: no-repeat; background-position: left top; display: none; position: absolute; left: 8px; width: 320px; z-index: 2000;">
                          <div class="p-3">
                              <span class="bold" style="font-size: 24px">Ulubione({{Session::get('userFavouritesCount')}})</span> wyczyść listę
                              @foreach(Session::get('userFavourites') as $favourite)
                                  <div class="row">
                                      <div class="col-3" style="background-image: url('{{ asset("images/apartaments/$favourite->id/1.jpg") }}'); background-size: cover; position: relative; margin-bottom: 0px; margin-left: 15px; padding-left: 0px;"></div>
                                      <div class="col-8 row">
                                          <div class="col-12 font-13 txt-blue">{{$favourite->apartament_name}}</div>
                                          <div class="col-12 font-11 bold">{{$favourite->apartament_address}}</div>
                                          <div class="col-12 font-11">{{$favourite->apartament_address_2}}</div>
                                      </div>
                                      <div class="col-1">Heart</div>
                                  </div>
                                  <hr>
                              @endforeach
                              <a class="btn btn-black px-2" href="{{route('myFavourites')}}">Wszystkie ({{Session::get('userFavouritesCount')}})</a>
                              <a class="btn btn-black px-2" href="{{route('myFavouritesCompare')}}">Porównaj</a>
                              <button class="btn btn-black px-2">Wyślij</button>
                          </div>
                      </div>
                    </span>
                      <script>
                          $("#favourites-nav").click(function() {
                              $("#favourites-bar").toggle();
                          });
                      </script>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('myOpinions') }}">{{ __('messages.My opinions') }} </a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('myReservations') }}">{{ __('messages.My reservations') }} </a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('account') }}">{{ __('messages.My account') }} </a>
                  </li>
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                   <button class='btn '>{{ __('messages.logout') }}</button>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
			@endguest	        
          </ul>
        </div>
      </div>
    </nav>