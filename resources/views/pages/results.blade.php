@extends ('layout.layout')
@section('title', '- Wyszukiwarka')
@section('content')
	<div id="found">
		<h3 class="found">{{__('messages.found')}} {{ $counted }} {{trans_choice('messages.apartaments',$counted)}} </h3>
	</div>
	{{-- ZNALEZIONE APARTAMENTY --}}
	<div id="apartaments" style="padding-top: 10px">
	<div class="parent">
		@foreach ($finds as $apartament)
			<a class="divlink" href="/apartaments/{{ $apartament->apartament_link }}">

				<div class="child-found">
					<div class="info-top" style="background-image: url('{{asset('images/1.jpg')}}')">
						<div class="wyniki-cena"><p class="cena-top">160 zł</p></div>
						<div class="info-bottom"><p class="info-addons">{{ __('messages.inclbreakfast') }}</p></div>

					</div>
					<p class="title-found">{{ $apartament->apartament_name }}</p>
					<p class="address">{{ $apartament->apartament_city }}, {{ $apartament->apartament_address }}, {{ $apartament->apartament_address_2 }}</p>

					<table class="t-options">
						<tbody>
						<tr>
							<td><img src="{{asset('images/person.png')}}" alt="Liczba miejsc dla dorosłych"></td>
							<td><img src="{{asset('images/cumel.png')}}" alt="Liczba miejsc dla dzieci"></td>
							<td><img src="{{asset('images/bed.png')}}" alt="Liczba łóżek"></td>
							<td><p class="ocena">4,5</p></td>
						</tr>
						<tr>
							<td> 3</td>
							<td> 2</td>
							<td>{{ $apartament->apartament_beds }}</td>
							<td>23 oceny</td>
						</tr>
						</tbody>
					</table>				
				</div>
			</a>
		@endforeach 	

		

	</div></div>
@endsection

