@extends ('layout.layout')
@section('title', '- Strona główna')
@section('content')
	{{--SLIDER--}}
	@include('includes.slider')
	{{--BENIFITS--}}
	@include('includes.benifits')
	{{--APARTAMENTS--}}
	<div id="apartaments" style="padding-top: 80px;">
	<h2 class="ap">{{ __('messages.ap4u') }}</h2>
	<div class="parent">
		@foreach ($apartaments as $apartament)

			<a class="divlink" href="/apartaments/{{ $apartament->descriptions[0]->apartament_link }}">
			<div class="child" style="background-image: url('{{ asset('images/1.jpg') }}');">
			<p class="title">{{$apartament->descriptions[0]->apartament_name}}</p><p class="cena">{{ __('messages.from') }} <b>260 zł</b>{{ __('messages.pernight') }}</p></div>
			</a>
		@endforeach
	</div></div>
@endsection

