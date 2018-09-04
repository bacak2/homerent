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
							<input class="hrefSubmit" type="submit" style="color: #0066CC" value="Pozostałe apartamenty dla Ciebie >">
						</form>
					</div>
				</div>
		    </div>
		</div>

		<div class="row desktop-none">
			<div class="col-6">
				<h3 class="h3-index">{{ __('Popularne') }}</h3>
			</div>
			<div class="col-6">
				<a class="font-13 pull-right" href="/guidebooks" style="color: #0066CC">Więcej przewodników »</a>
			</div>
		</div>
		<h3 class="h3-index mobile-none">{{ __('Odwiedzaj i zwiedzaj') }}</h3>
		<div class="row mb-5">
			<div class="col-12 mb-4 font-15 mobile-none">Szukasz pomysłu na wymarzoną podróż? Chcesz wiedzieć gdzie można miło spędzić czas, co warto zobaczyć? Zajrzyj do naszych przewodników, zainspiruj się i zaplanuj swój pobyt! Znajdziesz tu propozycje atrakcji dla rodzin, dla osób aktywnych, dla miłośników zabytków, dla amatorów wędrówek... i nie tylko</div>
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
					<a href="/guidebooks" style="color: #0066CC">Więcej przewodników »</a>
				</div>
			</div>
		</div>

		<h3 class="h3-index mobile-none">{{ __('Zatrzymaj się w naszych obiektach') }}</h3>
		<div class="row mb-5 mobile-none">
			<div class="col-12 col-sm-6 col-md-4">
				<form action="/search/kafle" method="GET">
					<input type="hidden" name="region" value="Zakopane">
					<input type="hidden" name="t-start" value="{{$todayDate}}">
					<input type="hidden" name="t-end" value="{{$tomorrowDate}}">
					<input type="hidden" name="dzieci" value="0">
					<input type="hidden" name="dorosli" value="1">
					<div class="mb-3" style="position: relative">
						<input class="w-100" type="image" src="{{asset('images/main/guidebook1.png')}}" alt="Zakopane">
						<div class="guidebooks-index-page">Zakopane - {{$apartamentsFirstCityAmount}} {{trans_choice('messages.apartaments', $apartamentsFirstCityAmount)}}</div>
					</div>

					<h4 class="h4-index">Polecamy w Zakopanem</h4>
					@foreach ($apartamentsFirstCity as $apartament)
						<div style="position: relative">
							<a class="to-download-description" href="/apartaments/{{ $apartament->apartament_link }}">
								<img style="width:99%" src="{{asset("images/apartaments/$apartament->id/main.jpg")}}">
							</a>
							<div class="col-8 col-sm-11 col-lg-8 semi-transparent semi-transparent2">
								<h4 style="font-size: 18px;" itemprop="name">{{$apartament->apartament_name}}</h4>
								<p class="p-0 m-0 price">{{ __('messages.from') }} {{$apartament->price_value}} PLN{{ __('messages.pernight') }}</p>
							</div>
						</div>
					@endforeach
					<div class="gray-bar-index text-center">
						<input class="hrefSubmit" type="submit" style="color: #0066CC" value="{{$apartamentsFirstCityAmount}} {{trans_choice('messages.other apartaments', $apartamentsFirstCityAmount)}} w Zakopanem >">
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
						<input class="w-100" type="image" src="{{asset('images/main/guidebook2.png')}}" alt="Submit">
						<div class="guidebooks-index-page">Kościelisko - {{$apartamentsSecondCityAmount}} {{trans_choice('messages.apartaments', $apartamentsSecondCityAmount)}}</div>
					</div>

					<h4 class="h4-index">Polecamy w Kościelisku</h4>
					@foreach ($apartamentsSecondCity as $apartament)
						<div style="position: relative">
							<a class="to-download-description" href="/apartaments/{{ $apartament->apartament_link }}">
								<img style="width:99%" src="{{asset("images/apartaments/$apartament->id/main.jpg")}}">
							</a>
							<div class="col-8 col-sm-11 col-lg-8 semi-transparent semi-transparent2">
								<h4 style="font-size: 18px;" itemprop="name">{{$apartament->apartament_name}}</h4>
								<p class="p-0 m-0 price">{{ __('messages.from') }} {{$apartament->price_value}} PLN{{ __('messages.pernight') }}</p>
							</div>
						</div>
					@endforeach
					<div class="gray-bar-index text-center">
						<input class="hrefSubmit" type="submit" style="color: #0066CC" value="{{$apartamentsSecondCityAmount}} {{trans_choice('messages.other apartaments', $apartamentsSecondCityAmount)}} w Kościelisku >">
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
						<input class="w-100" type="image" src="{{asset('images/main/guidebook3.png')}}" alt="Submit">
						<div class="guidebooks-index-page">Witów - {{$apartamentsThirdCityAmount}} {{trans_choice('messages.apartaments', $apartamentsThirdCityAmount)}}</div>
					</div>

					<h4 class="h4-index">Polecamy w Witowie</h4>
					@foreach ($apartamentsThirdCity as $apartament)
						<div style="position: relative">
							<a class="to-download-description" href="/apartaments/{{ $apartament->apartament_link }}">
								<img style="width:99%" src="{{asset("images/apartaments/$apartament->id/main.jpg")}}">
							</a>
							<div class="col-8 col-sm-11 col-lg-8 semi-transparent semi-transparent2">
								<h4 style="font-size: 18px;" itemprop="name">{{$apartament->apartament_name}}</h4>
								<p class="p-0 m-0 price">{{ __('messages.from') }} {{$apartament->price_value}} PLN{{ __('messages.pernight') }}</p>
							</div>
						</div>
					@endforeach
					<div class="gray-bar-index text-center">
						<input class="hrefSubmit" type="submit" style="color: #0066CC" value="{{$apartamentsThirdCityAmount}} {{trans_choice('messages.other apartaments', $apartamentsThirdCityAmount)}} w Witowie >">
					</div>
				</form>
			</div>
		</div>

		<h3 class="h3-index">{{ __('Jak to działa') }}</h3>
		<div class="row mb-4 mb-md-5">
			<div class="col-sm-6 pr-3 mb-3 mb-md-0">
				<img style="position: relative; width: 100%; height: auto;" src="{{ asset('images/main/Dla_podrozujacych.jpg') }}">
				<a class="text-center bold py-2" href="{{route('travelers.index')}}" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); border: 3px solid black; width: 200px; background-color: rgba(255,255,255, 0.5);">Dla podróżnych</a>
			</div>
			<div class="col-sm-6 pl-3 mb-sm-3 mb-md-0">
				<img style="position: relative; width: 100%; height: auto;" src="{{ asset('images/main/Dla_wlasicieli.jpg') }}">
				<a class="text-center bold py-2" href="http://wlasciciele-visitzakopane.pl{{--route('owners.index')--}}" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); border: 3px solid black; width: 200px; background-color: rgba(255,255,255, 0.5);">Dla właścicieli</a>
			</div>
		</div>
	</div>
	</section>
@endsection