    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: white;" >
      <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">Homerent</a>
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
	              <a class="nav-link" href="{{ route('login') }}">{{ __('messages.login')}}</a>
	            </li>
	            <li class="nav-item">
	              <a class="nav-link" href="{{ route('register') }}">{{ __('messages.register')}}</a>
	            </li>
	        @else 
				{{ Auth::user()->name }} 

                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                   <button class='top-button'>{{ __('messages.logout') }}</button>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
			@endguest	        
          </ul>
        </div>
      </div>
    </nav>