@extends ('layout.layout')

@section('title', '- '.$apartament->descriptions[0]->apartament_name )

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-lg-9 col-sm-12">
				<a href="{{ url()->previous() }}" class="btn btn-link ml-2"><< {{ __('messages.Return') }}</a>
			</div>
			<div class="col-lg-3 col-sm-12">
				<div  style="background-image: url('{{asset('images/reservations/security.png')}}'); width: 270px; height: 51px"></div>
			</div>
		</div>
	</div>
	<div class="container">
				<h2><b>{{ __('messages.reservation') }}</b></h2>
	</div>

	@yield('reservation.content')

@endsection
