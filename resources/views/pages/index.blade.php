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
    					<div class="col-8 semi-transparent">
    						<h4 style="font-size: 18px;" itemprop="name">{{$apartament->apartament_name}}</h4>
    						<p class="p-0 m-0 price">{{ __('messages.from') }} {{$apartament->price_value}} PLN{{ __('messages.pernight') }}</p>
    					</div>
                    </div>
			      </a>
				@endforeach
				<div class="col-12 text-center p-0 mt-2">
					<div class="gray-bar-index">
						<a href="#" style="color: #0066CC">235 innych apartamentów dla Ciebie ></a>
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

		<div class="row mb-3 mb-md-5 desktop-none">
			<div class="col-12 col-md-4">
				<div style="position: relative">
					<a class="to-download-description" href="{{route('aboutUs.guidebookDetail', 0)}}">
						<img style="width:100%" src="{{asset('images/main/guidebook.png')}}">
					</a>
					<div class="guidebooks-index-page">Na narty</div>
				</div>
			</div>
            <div class="col-12 col-md-4">
				<div style="position: relative">
					<a class="to-download-description" href="{{route('aboutUs.guidebookDetail', 0)}}">
						<img style="width:100%" src="{{asset('images/main/guidebook.png')}}">
					</a>
					<div class="guidebooks-index-page">Z dziećmi</div>
				</div>
			</div>
			<div class="col-12 col-md-4">
				<div style="position: relative">
					<a class="to-download-description" href="{{route('aboutUs.guidebookDetail', 1)}}">
						<img style="width:100%" src="{{asset('images/main/guidebook.png')}}">
					</a>
					<div class="guidebooks-index-page">Zakopane</div>
				</div>
			</div>
			<div class="col-12 col-md-4">
				<div style="position: relative">
					<a class="to-download-description" href="{{route('aboutUs.guidebookDetail', 2)}}">
						<img style="width:100%" src="{{asset('images/main/guidebook.png')}}">
					</a>
					<div class="guidebooks-index-page">Kraków</div>
				</div>
			</div>
			<div class="col-12 col-md-4">
				<div style="position: relative">
					<a class="to-download-description" href="{{route('aboutUs.guidebookDetail', 2)}}">
						<img style="width:100%" src="{{asset('images/main/guidebook.png')}}">
					</a>
					<div class="guidebooks-index-page">Warszawa</div>
				</div>
			</div>
		</div>

		<h3 class="h3-index mobile-none">{{ __('Odwiedzaj i zwiedzaj') }}</h3>
		<div class="row mb-5 mobile-none">
			<div class="col-12 mb-4 font-15">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.</div>
			<div class="col-12 col-md-4">
				<div style="position: relative">
					<a class="to-download-description" href="{{route('aboutUs.guidebookDetail', 0)}}">
						<img style="width:100%" src="{{asset('images/main/guidebook.png')}}">
					</a>
					<div class="guidebooks-index-page">Kraków dla miłośników kuchni</div>
				</div>
			</div>
            <div class="col-12 col-md-4">
				<div style="position: relative">
					<a class="to-download-description" href="{{route('aboutUs.guidebookDetail', 0)}}">
						<img style="width:100%" src="{{asset('images/main/guidebook.png')}}">
					</a>
					<div class="guidebooks-index-page">Kraków dla miłośników kuchni</div>
				</div>
			</div>
			<div class="col-12 col-md-4">
				<div style="position: relative">
					<a class="to-download-description" href="{{route('aboutUs.guidebookDetail', 1)}}">
						<img style="width:100%" src="{{asset('images/main/guidebook.png')}}">
					</a>
					<div class="guidebooks-index-page">Kraków dla miłośników kuchni</div>
				</div>
			</div>
			<div class="col-12 col-md-4">
				<div style="position: relative">
					<a class="to-download-description" href="{{route('aboutUs.guidebookDetail', 2)}}">
						<img style="width:100%" src="{{asset('images/main/guidebook.png')}}">
					</a>
					<div class="guidebooks-index-page">Kraków dla miłośników kuchni</div>
				</div>
			</div>
			<div class="col-12 col-md-4">
				<div style="position: relative">
					<a class="to-download-description" href="{{route('aboutUs.guidebookDetail', 2)}}">
						<img style="width:100%" src="{{asset('images/main/guidebook.png')}}">
					</a>
					<div class="guidebooks-index-page">Kraków dla miłośników kuchni</div>
				</div>
			</div>
			<div class="col-12 col-md-4 font-15">
				<div style="height: 195px; border: 1px solid black; padding: 18px;">
					<span class="font-18 bold d-block">Polecaj i zarabiaj</span>
					<span class="d-block mb-2">Za każde polecenie dostaniesz <b>40 zł</b> do wykorzystania podczas kolejnych rezerwacji z naszej oferty.</span>
					<a href="#" class="btn btn-black" style="color: #fff; width: 100px; padding: 7px 20px">Zobacz</a>
				</div>
			</div>
			<div class="col-12 text-center">
				<div class="gray-bar-index">
					<a href="/guidebooks" style="color: #0066CC">Więcej przewodników »</a>
				</div>
			</div>
		</div>

		<h3 class="h3-index mobile-none">{{ __('Zatrzymuj się w 17 miastach') }}</h3>
		<div class="row mb-5 mobile-none">
			<div class="col-12 col-md-4">
				<div class="mb-3" style="position: relative">
					<a class="to-download-description" href="{{route('aboutUs.guidebookDetail', 0)}}">
						<img style="width:100%" src="{{asset('images/main/guidebook.png')}}">
					</a>
					<div class="guidebooks-index-page">Kraków - 56 apartamentów</div>
				</div>

				<h4 class="h4-index">Polecamy w Krakowie</h4>
				<div class="row">
				@foreach ($apartaments as $apartament)
					<a class="" href="/apartaments/{{ $apartament->apartament_link }}">
						<div style="background-image: url('{{ asset("images/apartaments/$apartament->id/main.jpg") }}');" class="apartament" itemscope itemtype="http://schema.org/Hotel">
							<div class="col-8 semi-transparent">
								<h4 style="font-size: 18px;" itemprop="name">{{$apartament->apartament_name}}</h4>
								<p class="p-0 m-0 price">{{ __('messages.from') }} {{$apartament->price_value}} PLN{{ __('messages.pernight') }}</p>
							</div>
						</div>
					</a>
				@endforeach
				</div>
				<div style="position: relative">
					<a class="to-download-description" href="{{route('aboutUs.guidebookDetail', 0)}}">
						<img style="width:100%" src="{{asset('images/main/guidebook.png')}}">
					</a>
					<div class="guidebooks-index-page">Kraków - 56 apartamentów</div>
				</div>
				<div style="position: relative">
					<a class="to-download-description" href="{{route('aboutUs.guidebookDetail', 0)}}">
						<img style="width:100%" src="{{asset('images/main/guidebook.png')}}">
					</a>
					<div class="guidebooks-index-page">Kraków - 56 apartamentów</div>
				</div>
				<div class="gray-bar-index text-center">
					<a href="/guidebooks" style="color: #0066CC">235 innych apartamentów w Krakowie ></a>
				</div>
			</div>
			<div class="col-12 col-md-4">
				<div class="mb-3" style="position: relative">
					<a class="to-download-description" href="{{route('aboutUs.guidebookDetail', 0)}}">
						<img style="width:100%" src="{{asset('images/main/guidebook.png')}}">
					</a>
					<div class="guidebooks-index-page">Wrocław - 56 apartamentów</div>
				</div>

				<h4 class="h4-index">Polecamy we Wrocławiu</h4>
				<div style="position: relative">
					<a class="to-download-description" href="{{route('aboutUs.guidebookDetail', 0)}}">
						<img style="width:100%" src="{{asset('images/main/guidebook.png')}}">
					</a>
					<div class="guidebooks-index-page">Kraków - 56 apartamentów</div>
				</div>
				<div style="position: relative">
					<a class="to-download-description" href="{{route('aboutUs.guidebookDetail', 0)}}">
						<img style="width:100%" src="{{asset('images/main/guidebook.png')}}">
					</a>
					<div class="guidebooks-index-page">Kraków - 56 apartamentów</div>
				</div>
				<div class="gray-bar-index text-center">
					<a href="/guidebooks" style="color: #0066CC">235 innych apartamentów w Krakowie ></a>
				</div>
			</div>
			<div class="col-12 col-md-4">
				<div class="mb-3" style="position: relative">
					<a class="to-download-description" href="{{route('aboutUs.guidebookDetail', 0)}}">
						<img style="width:100%" src="{{asset('images/main/guidebook.png')}}">
					</a>
					<div class="guidebooks-index-page">Zakopane - 56 apartamentów</div>
				</div>

				<h4 class="h4-index">Polecamy w Zakopanem</h4>
				<div style="position: relative">
					<a class="to-download-description" href="{{route('aboutUs.guidebookDetail', 0)}}">
						<img style="width:100%" src="{{asset('images/main/guidebook.png')}}">
					</a>
					<div class="guidebooks-index-page">Kraków - 56 apartamentów</div>
				</div>
				<div style="position: relative">
					<a class="to-download-description" href="{{route('aboutUs.guidebookDetail', 0)}}">
						<img style="width:100%" src="{{asset('images/main/guidebook.png')}}">
					</a>
					<div class="guidebooks-index-page">Kraków - 56 apartamentów</div>
				</div>
				<div class="gray-bar-index text-center">
					<a href="/guidebooks" style="color: #0066CC">235 innych apartamentów w Krakowie ></a>
				</div>
			</div>
		</div>

		<h3 class="h3-index">{{ __('Jak to działa') }}</h3>
		<div class="row mb-4 mb-md-5">
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