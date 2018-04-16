@extends ('layout.layout')
@section('title', 'Strona główna')
@section('content')
	{{--SLIDER--}}
	@include('includes.slider')
	<section>
	{{--BENIFITS--}}
	@include('includes.benifits')
	{{--APARTAMENTS--}}
	<div class="container" id="apartamentsforyou">
		<h4>{{ __('messages.ap4u') }}</h4>
		<div class="container">
		    <div class="row">
				@foreach ($apartaments as $apartament)
			      <a class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3" href="/apartaments/{{ $apartament->apartament_link }}">
			        <div style="background-image: url('{{ asset("images/apartaments/$apartament->id/1.jpg") }}');" class="apartament">
    					<div class="col-8 semi-transparent">
    						<h5>{{$apartament->apartament_name}}</h5>
    						<p class="p-0 m-0 price">{{ __('messages.from') }} {{$apartament->price_value}} PLN{{ __('messages.pernight') }}</p>
    					</div>
                                </div>
			      </a>
				@endforeach
		    </div>
		</div>
	</div>
	</section>
@endsection