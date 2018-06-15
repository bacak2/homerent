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
		<h3>{{ __('messages.ap4u') }}</h3>
		<div class="container mb-5">
		    <div class="row">
				@foreach ($apartaments as $apartament)
			      <a class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3" href="/apartaments/{{ $apartament->apartament_link }}">
			        <div style="background-image: url('{{ asset("images/apartaments/$apartament->id/main.jpg") }}');" class="apartament" itemscope itemtype="http://schema.org/Hotel">
    					<div class="col-8 semi-transparent">
    						<h4 style="font-size: 18px;" itemprop="name">{{$apartament->apartament_name}}</h4>
    						<p class="p-0 m-0 price">{{ __('messages.from') }} {{$apartament->price_value}} PLN{{ __('messages.pernight') }}</p>
    					</div>
                    </div>
			      </a>
				@endforeach
		    </div>
		</div>
		<h3>{{ __('Jak to działa') }}</h3>
		<div class="row mb-5">
			<div class="col-12 col-md-6 pr-3 mb-3 mb-md-0">
				<img style="position: relative; width: 100%; height: auto;" src="{{ asset('images/main/howItWork1.png') }}">
				<a class="text-center bold py-2" href="{{route('travelers.index')}}" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); border: 3px solid black; width: 200px;">Dla podróżnych</a>
			</div>
			<div class="col-12 col-md-6 pl-3">
				<img style="position: relative; width: 100%; height: auto;" src="{{ asset('images/main/howItWork2.png') }}">
				<a class="text-center bold py-2" href="{{route('owners.index')}}" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); border: 3px solid black; width: 200px;">Dla właścicieli</a>
			</div>
		</div>
	</div>
	</section>
@endsection