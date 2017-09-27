	<header>
		<div class="top-left">
			<a href="{{ url('/') }}"><img src="{{ asset('images/logo.png') }}" alt="Logo"></a>
		</div>
		<div class="top-right">
			<div class="top-right-wrapper">
				<button class='add_apartament'>Dodaj apartament</button>
	 		</div>	
	 		<div class="top-right-wrapper-right">
	 		<div class="top-buttons">
				{{--<button class="easy-modal-open" href="#logowanie">Logowanie</button>--}}

				@guest
					<a href="{{ route('login') }}"><button class='top-button'>Logowanie</button></a>
					<font color="#a8b7c3">|</font>
					<a href="{{ route('register') }}"><button class='top-button'>Rejestracja</button></a>
				@else
					{{ Auth::user()->name }} 

                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                       <button class='top-button'>Wyloguj</button>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
				@endguest
				</div>
	 		</div>
		</div>
	</header>