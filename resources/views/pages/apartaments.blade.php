@extends ('layout.layout')

@section('title', '- Apartament '.$apartament->id)

{{--{{ dd($description) }} --}}



@section('content')
	<div class="clear"></div>
	{{-- Apartament {{ $apartament->id }} --}}
	<div class="apartament-nawigacja">
		<a href="#"><button class='back'>Powrót do wyników wyszukiwania</button></a>


	</div>

	<div id="apartament-big" style="background-image: url('{{ asset('images/placeholder.jpg') }}');">
	<div class="apartament-big-l">
		
		<div class="apartament-l-container">
			<div class="apartament-l-title">
				<p class="apartament-l-title-big">Wiosenny apartament</p>
				<p class="apartament-l-title-address">{{ $apartament->apartament_city }}, {{ $apartament->apartament_address }}, {{ $apartament->apartament_address_2 }}</p>
			</div>
			<div class="apartament-l-ocena">
				<p class="apartament-ocena">4,7/5</p>
				<p class="apartament-opinie">88 opinii</p>
			</div>
			<div class="apartament-l-bottom">
				<table class="t-options" style="	color: black; font-weight: bold; font-size: 17px;">
					<tbody>
					<tr>
						<td><img src="{{ asset('images/person.png') }}" alt="Liczba miejsc dla dorosłych"></td>
						<td><img src="{{ asset('images/cumel.png') }}" alt="Liczba miejsc dla dzieci"></td>
						<td><img src="{{ asset('images/bed.png') }}" alt="Liczba łóżek"></td>
					</tr>
					<tr>
						<td>3</td>
						<td>2</td>
						<td>4</td>
					</tr>
					</tbody>
				</table>	
			</div>

			<div class="apartament-l-navigator">


			</div>


		</div>


	</div>

	<div class="apartament-big-r">
		<div class="apartament-cena">
			<div class="apartament-cena-cena"><p class="padding5">Cena za noc od:</p><p class="cena-apart-noc">150 PLN</p></div>

			<div class="form-apartament">
				<form class="apartament">
					<p class="przyjazd">Przyjazd</p><p class="wyjazd">Wyjazd</p><br>
					<input type="text" id="przyjazd">
					<input type="text" id="powrot">
					<input type="text" id="ileosob" placeholder="dorośli, dzieci">
				</form>
			</div>
			 <hr class="ln1">
			<div class="form-apartament">Razem do zapłaty:<p class="cena-apart-noc" style="font-size: 25px;">300 zł</p></div>
			<p class="termin">Ten termin jest dostępny</p>
		</div>
	</div>
	</div>
	<div class="clear"></div>
	<div class="apartament-info">
		<div class="apartament-info-l">
			<h2 class="apartamenty">Opis</h2>
			<p class="article-text">x</p>

			<h2 class="apartamenty" style="padding-top: 15px;">Zdjęcia</h2>
			<div class="galeria-container">
				<div class="fotorama" data-nav="thumbs" data-autoplay="true">
		 			<a href="{{ asset('images/4.jpg') }}"><img src="{{ asset('images/4.jpg') }}"></a>		
		 			<a href="{{ asset('images/1.jpg') }}"><img src="{{ asset('images/1.jpg') }}"></a>
		 			<a href="{{ asset('images/2.jpg') }}"><img src="{{ asset('images/2.jpg') }}"></a>
		 			<a href="{{ asset('images/3.jpg') }}"><img src="{{ asset('images/3.jpg') }}"></a>
				</div>
			</div>

			<h2 class="apartamenty">Udogodnienia</h2>
			<p class="article-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.
			Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo.<br><br></p>

		</div>
		<div class="apartament-info-r">
			<h2 class="apartamenty">Podobne apartamenty</h2>
			<div class="parent">


			<div class="child-found">
				<div class="info-top">
					<div class="wyniki-cena"><p class="cena-top">160 zł</p></div>
					<div class="info-bottom"><p class="info-addons">Śniadanie w cenie</p></div>

				</div>
				<p class="title-found">Nowoczesny apartament z basenem</p>
				<p class="address">Kraków (Stare Miasto), ul. Testowa 1/1 </p>

				<table class="t-options" >
					<tbody>
					<tr >
						<td><img src="{{ asset('images/person.png') }}" alt="Liczba miejsc dla dorosłuch"></td>
						<td><img src="{{ asset('images/cumel.png') }}" alt="Liczba miejsc dla dzieci"></td>
						<td><img src="{{ asset('images/bed.png') }}" alt="Liczba łóżek"></td>
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

			<div class="child-found">
				<div class="info-top">
					<div class="wyniki-cena"><p class="cena-top">160 zł</p></div>
					<div class="info-bottom"><p class="info-addons">Śniadanie w cenie</p></div>

				</div>
				<p class="title-found">Nowoczesny apartament z basenem</p>
				<p class="address">Kraków (Stare Miasto), ul. Testowa 1/1 </p>

				<table class="t-options">
					<tbody>
					<tr >
						<td><img src="{{ asset('images/person.png') }}" alt="Liczba miejsc dla dorosłuch"></td>
						<td><img src="{{ asset('images/cumel.png') }}" alt="Liczba miejsc dla dzieci"></td>
						<td><img src="{{ asset('images/bed.png') }}" alt="Liczba łóżek"></td>
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

			<div class="child-found">
				<div class="info-top">
					<div class="wyniki-cena"><p class="cena-top">160 zł</p></div>
					<div class="info-bottom"><p class="info-addons">Śniadanie w cenie</p></div>

				</div>
				<p class="title-found">Nowoczesny apartament z basenem</p>
				<p class="address">Kraków (Stare Miasto), ul. Testowa 1/1 </p>

				<table class="t-options">
					<tbody>
				<tr >
						<td><img src="{{ asset('images/person.png') }}" alt="Liczba miejsc dla dorosłuch"></td>
						<td><img src="{{ asset('images/cumel.png') }}" alt="Liczba miejsc dla dzieci"></td>
						<td><img src="{{ asset('images/bed.png') }}" alt="Liczba łóżek"></td>
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



			</div>




		</div>
	</div>
@endsection

