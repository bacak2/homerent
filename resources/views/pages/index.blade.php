@extends ('layout.layout')
@section('title', __('messages.Main page'))
@section('content')
	{{--SLIDER--}}
	@include('includes.slider')
	<section>
	{{--BENIFITS--}}
	@include('includes.benifits')
	{{--APARTAMENTS--}}
	<div class="container" id="apartamentsforyou">
		<h3 class="h3-index">{{ __('messages.ap4u') }}</h3>
		<div class="container mb-5">
		    <div class="row">
				@foreach ($apartaments as $apartament)
			      <a class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3" href="/apartaments/{{ $apartament->apartament_link }}">
			        <div style="background-image: url('{{ asset("images/apartaments/$apartament->id/main.jpg") }}');" class="apartament" itemscope itemtype="http://schema.org/Hotel">
    					<div class="col-8 col-sm-11 col-lg-8 semi-transparent">
    						<h4 style="font-size: 18px;" itemprop="name">{{$apartament->apartament_name}}</h4>
    						<p class="p-0 m-0 price">{{ __('messages.from') }} {{$apartament->price_value}} PLN{{ __('messages.pernight') }}</p>
    					</div>
                    </div>
			      </a>
				@endforeach
				<div class="col-12 text-center p-0 mt-2">
					<div class="gray-bar-index">
						<form action="/search/kafle" method="GET">
							<input type="hidden" name="region" value="">
							<input type="hidden" name="t-start" value="{{$todayDate}}">
							<input type="hidden" name="t-end" value="{{$tomorrowDate}}">
							<input type="hidden" name="dzieci" value="0">
							<input type="hidden" name="dorosli" value="1">
							<input class="hrefSubmit" type="submit" style="color: #0066CC" value="{{ __('messages.Other apartaments for you') }} >">
						</form>
					</div>
				</div>
		    </div>
		</div>

		<h3 class="h3-index">{{ __('messages.Apartment complexes') }}</h3>
		<div class="container mb-5">
		    <div class="row">
				@foreach ($apartamentComplexes as $apartament)
			      <a class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3" href="/apartaments-group/{{ $apartament->group_link }}">
			        <div style="background-image: url('{{ asset("images/apartaments_group/$apartament->group_id/main.jpg") }}');" class="apartament" itemscope itemtype="http://schema.org/Hotel">
    					<div class="col-8 col-sm-11 col-lg-8 semi-transparent">
    						<h4 style="font-size: 18px;" itemprop="name">{{$apartament->group_name}}</h4>
    						<p class="p-0 m-0 price">{{ $apartament->apartaments_amount }} {{ trans_choice('messages.apartaments', $apartament->apartaments_amount) }}</p>
    					</div>
                    </div>
			      </a>
				@endforeach
				<div class="col-12 text-center p-0 mt-2">
					<div class="gray-bar-index">
						<form action="/search/kafle" method="GET">
							<input type="hidden" name="region" value="">
							<input type="hidden" name="t-start" value="{{$todayDate}}">
							<input type="hidden" name="t-end" value="{{$tomorrowDate}}">
							<input type="hidden" name="dzieci" value="0">
							<input type="hidden" name="dorosli" value="1">
							<input type="hidden" name="complex-only" value="1">
							<input class="hrefSubmit" type="submit" style="color: #0066CC" value="{{ __('messages.See all complexes') }} >">
						</form>
					</div>
				</div>
		    </div>
		</div>

		<div class="row desktop-none">
			<div class="col-6">
				<h3 class="h3-index">{{ __('messages.Popular') }}</h3>
			</div>
			<div class="col-6">
				<a class="font-13 pull-right" href="/guidebooks" style="color: #0066CC">{{ __('messages.More guidebooks') }} »</a>
			</div>
		</div>
		<h3 class="h3-index mobile-none">{{ __('messages.Visit and explore') }}</h3>
		<div class="row mb-5">
			<div class="col-12 mb-4 font-15 mobile-none">{{ __('messages.v&e text') }}</div>
			@foreach($guidebooks as $guidebook)
			<div class="col-12 col-sm-6 col-md-4">
				<div style="position: relative">
					<a class="to-download-description" href="{{route('guidebooks.Detail', $guidebook->guidebook_link)}}">
						<img class="img-fluid" src="{{asset("images/guidebooks/$guidebook->guidebook_img")}}">
					</a>
					<div class="guidebooks-index-page">{{$guidebook->guidebook_title}}</div>
				</div>
			</div>
			@endforeach
			<!--div class="col-12 col-sm-6 col-md-4 font-15">
				<div style="height: 195px; border: 1px solid black; padding: 18px;">
					<span class="font-18 bold d-block">Polecaj i zarabiaj</span>
					<span class="d-block mb-2">Za każde polecenie dostaniesz <b>40 zł</b> do wykorzystania podczas kolejnych rezerwacji z naszej oferty.</span>
					<a href="#" class="btn btn-black" style="color: #fff; width: 100px; padding: 7px 20px">Zobacz</a>
				</div>
			</div-->
			<div class="col-12 text-center mobile-none">
				<div class="gray-bar-index">
					<a href="/guidebooks" style="color: #0066CC">{{ __('messages.More guidebooks') }} »</a>
				</div>
			</div>
		</div>

		<h3 class="h3-index mobile-none">{{ __('messages.Stay in our objects') }}</h3>
		<div class="row mb-5 mobile-none">
			<div class="col-12 col-sm-6 col-md-4">
				<form action="/search/kafle" method="GET">
					<input type="hidden" name="region" value="Zakopane">
					<input type="hidden" name="t-start" value="{{$todayDate}}">
					<input type="hidden" name="t-end" value="{{$tomorrowDate}}">
					<input type="hidden" name="dzieci" value="0">
					<input type="hidden" name="dorosli" value="1">
					<div class="mb-3" style="position: relative">
						<input class="w-100" type="image" src="{{asset('images/main/guidebook1.jpg')}}" alt="Zakopane">
						<div class="guidebooks-index-page">Zakopane - {{$apartamentsFirstCityAmount}} {{trans_choice('messages.apartaments', $apartamentsFirstCityAmount)}}</div>
					</div>

					<h4 class="h4-index">{{ __('messages.Recommend') }} {{ __('messages.in Zakopane') }}</h4>
					@foreach ($apartamentsFirstCity as $apartament)
						<div class="mb-2" style="position: relative">
							<a class="to-download-description" href="/apartaments/{{ $apartament->apartament_link }}">
								<img style="width:99%; height: 210px;" src="{{asset("images/apartaments/$apartament->id/polecane.jpg")}}">
							</a>
							<div class="col-8 col-sm-11 col-lg-8 semi-transparent semi-transparent2">
								<h4 style="font-size: 18px;" itemprop="name">{{$apartament->apartament_name}}</h4>
								<p class="p-0 m-0 price">{{ __('messages.from') }} {{$apartament->price_value}} PLN{{ __('messages.pernight') }}</p>
							</div>
						</div>
					@endforeach
					<div class="gray-bar-index text-center">
						<input class="hrefSubmit" type="submit" style="color: #0066CC" value="{{$apartamentsFirstCityAmount}} {{trans_choice('messages.other apartaments', $apartamentsFirstCityAmount)}} {{ __('messages.in Zakopane') }} >">
					</div>
				</form>
			</div>
			<div class="col-12 col-sm-6 col-md-4">
				<form action="/search/kafle" method="GET">
					<input type="hidden" name="region" value="Kościelisko">
					<input type="hidden" name="t-start" value="{{$todayDate}}">
					<input type="hidden" name="t-end" value="{{$tomorrowDate}}">
					<input type="hidden" name="dzieci" value="0">
					<input type="hidden" name="dorosli" value="1">
					<div class="mb-3" style="position: relative">
						<input class="w-100" type="image" src="{{asset('images/main/guidebook2.jpg')}}" alt="Submit">
						<div class="guidebooks-index-page">Kościelisko - {{$apartamentsSecondCityAmount}} {{trans_choice('messages.apartaments', $apartamentsSecondCityAmount)}}</div>
					</div>

					<h4 class="h4-index">{{ __('messages.Recommend') }} {{ __('messages.in Koscielisko') }}</h4>
					@foreach ($apartamentsSecondCity as $apartament)
						<div class="mb-2" style="position: relative">
							<a class="to-download-description" href="/apartaments/{{ $apartament->apartament_link }}">
								<img style="width:99%; height: 210px;" src="{{asset("images/apartaments/$apartament->id/polecane.jpg")}}">
							</a>
							<div class="col-8 col-sm-11 col-lg-8 semi-transparent semi-transparent2">
								<h4 style="font-size: 18px;" itemprop="name">{{$apartament->apartament_name}}</h4>
								<p class="p-0 m-0 price">{{ __('messages.from') }} {{$apartament->price_value}} PLN{{ __('messages.pernight') }}</p>
							</div>
						</div>
					@endforeach
					<div class="gray-bar-index text-center">
						<input class="hrefSubmit" type="submit" style="color: #0066CC" value="{{$apartamentsSecondCityAmount}} {{trans_choice('messages.other apartaments', $apartamentsSecondCityAmount)}} {{ __('messages.in Koscielisko') }} >">
					</div>
				</form>
			</div>
			<div class="col-12 col-sm-6 col-md-4">
				<form action="/search/kafle" method="GET">
					<input type="hidden" name="region" value="Witów">
					<input type="hidden" name="t-start" value="{{$todayDate}}">
					<input type="hidden" name="t-end" value="{{$tomorrowDate}}">
					<input type="hidden" name="dzieci" value="0">
					<input type="hidden" name="dorosli" value="1">
					<div class="mb-3" style="position: relative">
						<input class="w-100" type="image" src="{{asset('images/main/guidebook3.jpg')}}" alt="Submit">
						<div class="guidebooks-index-page">Witów - {{$apartamentsThirdCityAmount}} {{trans_choice('messages.apartaments', $apartamentsThirdCityAmount)}}</div>
					</div>

					<h4 class="h4-index">{{ __('messages.Recommend') }} {{ __('messages.in Witow') }}</h4>
					@foreach ($apartamentsThirdCity as $apartament)
						<div class="mb-2" style="position: relative">
							<a class="to-download-description" href="/apartaments/{{ $apartament->apartament_link }}">
								<img style="width:99%; height: 210px;" src="{{asset("images/apartaments/$apartament->id/polecane.jpg")}}">
							</a>
							<div class="col-8 col-sm-11 col-lg-8 semi-transparent semi-transparent2">
								<h4 style="font-size: 18px;" itemprop="name">{{$apartament->apartament_name}}</h4>
								<p class="p-0 m-0 price">{{ __('messages.from') }} {{$apartament->price_value}} PLN{{ __('messages.pernight') }}</p>
							</div>
						</div>
					@endforeach
					<div class="gray-bar-index text-center">
						<input class="hrefSubmit" type="submit" style="color: #0066CC" value="{{$apartamentsThirdCityAmount}} {{trans_choice('messages.other apartaments', $apartamentsThirdCityAmount)}} {{ __('messages.in Witow') }} >">
					</div>
				</form>
			</div>
		</div>

		<h3 class="h3-index">{{ __('messages.How it works') }}</h3>
		<div class="row mb-4 mb-md-5">
			<div class="col-sm-6 pr-3 mb-3 mb-md-0">
				<img style="position: relative; width: 100%; height: auto;" src="{{ asset('images/main/Dla_podrozujacych.jpg') }}">
				<a class="text-center bold py-2" href="{{route('travelers.index')}}" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); border: 3px solid black; width: 200px; background-color: rgba(255,255,255, 0.5);">{{ __('messages.For travelers') }}</a>
			</div>
			<div class="col-sm-6 pl-3 mb-sm-3 mb-md-0">
				<img style="position: relative; width: 100%; height: auto;" src="{{ asset('images/main/Dla_wlasicieli.jpg') }}">
				<a class="text-center bold py-2" href="http://wlasciciele-visitzakopane.pl{{--route('owners.index')--}}" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); border: 3px solid black; width: 200px; background-color: rgba(255,255,255, 0.5);">{{ __('messages.For owners') }}</a>
			</div>
		</div>
	</div>
	</section>
@endsection