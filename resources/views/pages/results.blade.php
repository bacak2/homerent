@extends ('layout.layout')
@section('title', '- Wyszukiwarka')
@section('content')
	<div id="found">
		<h3 class="found">243 obiekty</h3>
	</div>
	{{-- ZNALEZIONE APARTAMENTY --}}
	<div id="apartaments" style="padding-top: 10px">
	<div class="parent">
		@foreach ($finds as $apartament)
			<a class="divlink" href="apartament.html">

				<div class="child-found">
					<div class="info-top" style="background-image: url('images/1.jpg')">
						<div class="wyniki-cena"><p class="cena-top">160 zł</p></div>
						<div class="info-bottom"><p class="info-addons">Śniadanie w cenie</p></div>

					</div>
					<p class="title-found">{{ $apartament->apartament_name }}</p>
					<p class="address">{{ $apartament->apartament_city }},{{ $apartament->apartament_address }},{{ $apartament->apartament_address_2 }}</p>

					<table class="t-options">
						<tbody>
						<tr>
							<td><img src="images/person.png" alt="Liczba miejsc dla dorosłych"></td>
							<td><img src="images/cumel.png" alt="Liczba miejsc dla dzieci"></td>
							<td><img src="images/bed.png" alt="Liczba łóżek"></td>
							<td><p class="ocena">4,5</p></td>
						</tr>
						<tr>
							<td> 3</td>
							<td> 2</td>
							<td> 4</td>
							<td>23 oceny</td>
						</tr>
						</tbody>
					</table>				
				</div>
			</a>
		@endforeach 	

		

	</div></div>
@endsection

