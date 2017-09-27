@extends ('layout.layout')

@section('title', '- Strona główna')

@section('content')
	{{--SLIDER--}}
	@include('includes.slider')
	{{--BENIFITS--}}
	@include('includes.benifits')
	{{--APARTAMENTS--}}
	<div id="apartaments" style="padding-top: 80px;">
	<h2 class="ap">Apartamenty dla Ciebie</h2>
	<div class="parent">
		@foreach ($apartaments as $apartament)
			<a class="divlink" href="/apartaments/{{ $apartament->id }}">
			<div class="child" style="background-image: url('{{ asset('images/1.jpg') }}');">
			<p class="title">{{ $apartament->id }}</p><p class="cena">od <b>260 zł</b> / noc</p></div>
			</a>
		@endforeach
	</div></div>
@endsection

