@extends ('layout.layout')

@section('title', '- '/*.$apartament->descriptions[0]->apartament_name */)

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

	<div class="bg-gray">
		<div class="container py-3">
			<div class="row">
				<div class="col-lg-9 col-sm-12">
					<a href="{{ url()->previous() }}" class="btn btn-link ml-2">{{ __('messages.Return') }}</a>
				</div>
				<div class="col-lg-3 col-sm-12">
					<a href="{{ url()->previous() }}" class="btn ml-2 pointer">{{ __('messages.next') }}</a>
				</div>
			</div>
		</div>
	</div>
@endsection
