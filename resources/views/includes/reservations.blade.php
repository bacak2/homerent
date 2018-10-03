@extends ('layout.layout')

@section('title', $apartament->descriptions[0]->apartament_name.' - '.__('messages.reservation2'))

@section('content')
	<div class="container">
		<div class="row mx-0 no-gutters noprint">
			<div class="col-4 col-lg-9">
				<a href="{{ url()->previous() }}" class="btn btn-link font-13 pl-0">« {{ __('messages.Return') }}</a>
			</div>
			<div class="col-8 col-lg-3">
				<img class="img-fluid pull-right" src="{{asset('images/reservations/security.png')}}">
			</div>
		</div>
	</div>
	@yield('reservation.content')

@endsection
