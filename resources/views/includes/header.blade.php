<div id="fb-root"></div>
<script>
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        @if(App::isLocale('pl'))
        js.src = 'https://connect.facebook.net/pl_PL/sdk.js#xfbml=1&version=v3.1&appId=261522604441330';
        @else
        js.src = 'https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v3.1&appId=261522604441330';
        @endif
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: white;" >
      <div class="container px-0 px-md-3">
        <a class="navbar-brand" href="{{ url('/') }}">Homent</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navMenuTop" aria-controls="navMenuTop" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navMenuTop">
          <ul class="navbar-nav ml-auto">
              @desktop
              <li class="nav-item">
                  <div class="row mx-auto" style="padding-top: 8px">
                      @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                          <a style="text-decoration: none;" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                              <img src="{{ asset("images/flags/".$localeCode.".gif") }}">&nbsp;
                          </a>
                      @endforeach
                  </div>
              </li>
              <li class="nav-item pointer-none">
                  <span class="nav-link">
                      <img src="{{ asset("images/contact/phoneMinIcon.png") }}">
                      +48 600 49 49 49
                  </span>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="mailto:info@visitzakopane.pl">
                      <img src="{{ asset("images/contact/Envelop_24.png") }}">
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="{{route('aboutUs.contact')}}">{{ __('Kontakt')}}</a>
              </li>
              @elsedesktop
              <li class="nav-item">
                  <div class="d-inline" style="padding-top: 8px">
                      @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                          <a style="text-decoration: none;" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                              <img src="{{ asset("images/flags/".$localeCode.".gif") }}">&nbsp;
                          </a>
                      @endforeach
                  </div>
                  <a class="" href="mailto:info@visitzakopane.pl">
                      <img src="{{ asset("images/contact/Envelop_24.png") }}">
                  </a>
                  <a class="" href="tel:+48600494949">
                      <img src="{{ asset("images/contact/phoneMinIcon.png") }}">
                  </a>
                  <a class="nav-link" href="{{route('aboutUs.contact')}}">{{ __('Kontakt')}}</a>
              </li>
              @enddesktop
          	@guest
	            <li class="nav-item">
	              <a class="nav-link" id="log-in" href="#">{{ __('messages.login')}}</a>
	            </li>
	            <li class="nav-item">
	              <a class="nav-link" id="sign-up" href="#">{{ __('messages.register')}}</a>
	            </li>
	        @else
                  <li id="fav-nav" class="nav-item" style="position: relative">
                    <span id="favourites-nav-item">
                      <span id="favourites-nav" @if(Session::get('userFavouritesCount') != 0) onclick="$('#favourites-bar').toggle();" @else onclick="window.location.href='{{route("myFavourites")}}'" @endif class="nav-link">{{ __('messages.My favourites') }} ({{Session::get('userFavouritesCount') ?? 0}})</span>
                      <div id="favourites-bar" style="border-bottom: 1px solid black; background-image: url('{{ asset('images/account/favouritesPopup.png') }}'); background-repeat: no-repeat; background-position: left top; display: none; position: absolute; left: 8px; width: 320px; z-index: 2000;">
                          <div class="p-3 pt-4">
                              <span class="bold" style="font-size: 24px">Ulubione ({{Session::get('userFavouritesCount')}})</span>
                              <a id="clear-favourites-in-header" class="font-11" href="#">Wyczyść listę</a>
                              @if(Session::get('userFavouritesCount') != 0)
                                  @foreach(Session::get('userFavourites') as $favourite)
                                      <div class="row">
                                          <div class="col-3" style="background-image: url('{{ asset("images/apartaments/$favourite->id/1.jpg") }}'); background-size: cover; position: relative; margin-bottom: 0px; margin-left: 15px; padding-left: 0px; max-height: 52px;"></div>
                                          <div class="col-8 row" style="margin-right: -20px">
                                              <div class="col-12 font-13 txt-blue"><a href="/apartaments/{{$favourite->apartament_link}}">{{$favourite->apartament_name}}</a></div>
                                              <div class="col-12 font-11 bold">{{$favourite->apartament_address}}</div>
                                              <div class="col-12 font-11">{{$favourite->apartament_address_2}}</div>
                                          </div>
                                          <div class=""><img src="{{ asset("images/favourites/heart.png") }}"></div>
                                      </div>
                                      <hr>
                                  @endforeach
                              @endif
                              <a class="btn btn-primary px-2" href="{{route('myFavourites')}}">Wszystkie ({{Session::get('userFavouritesCount')}})</a>
                              <a class="btn btn-primary px-2" href="{{route('myFavouritesCompare')}}">Porównaj</a>
                              <button class="send-to-friends btn btn-primary px-2" onclick="$('#favourites-bar').hide()">Wyślij</button>
                          </div>
                      </div>
                    </span>
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