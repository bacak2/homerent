	<header>
		<div class="top-left">
			<a href="{{ url('/') }}"><img src="{{ asset('images/logo.png') }}" alt="Logo"></a>
		</div>
		<div class="top-right">
		<div style="width: 60px;float: left;padding-top: 36px;">

		<ul style="list-style-type:none">
		    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
		        <li>
		            <a style="text-decoration: none;" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
		                <img src="{{ asset("images/flags/".$localeCode.".gif") }}">&nbsp;
		            </a>
		        </li>
		    @endforeach
		</ul>




		</div>	

			<div class="top-right-wrapper">
				<button class='add_apartament'>{{ __('messages.addapartament') }}</button>
	 		</div>	
	 		<div class="top-right-wrapper-right">
	 		<div class="top-buttons">
				{{--<button class="easy-modal-open" href="#logowanie">Logowanie</button>--}}

				@guest
					<a href="{{ route('login') }}"><button class='top-button'>{{ __('messages.login') }}</button></a>
					<font color="#a8b7c3">|</font>
					<a href="{{ route('register') }}"><button class='top-button'>{{ __('messages.register') }}</button></a>
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
				</div>
	 		</div>
		</div>
	</header>