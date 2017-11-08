@extends ('layout.layout')

@section('title', '- '.$apartament->descriptions[0]->apartament_name )

@section('content')
	<div class="clear"></div>
	{{-- Apartament {{ $apartament->id }} --}}
	<div class="apartament-nawigacja">
		<a href="#"><button class='back'>{{ __('messages.backto') }}</button></a>

	</div>

	<div id="apartament-big" style="background-image: url('{{ asset('images/placeholder.jpg') }}');">
	<div class="apartament-big-l">
		
		<div class="apartament-l-container">
			<div class="apartament-l-title">
				<p class="apartament-l-title-big">{{  $apartament->descriptions[0]->apartament_name or '' }}</p>
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
			<div class="apartament-cena-cena"><p class="padding5">{{ __('messages.pricepernightfrom') }}</p><p class="cena-apart-noc">{{ $priceFrom }} PLN</p></div>

			<div class="form-apartament">
				<form class="apartament">
					<p class="przyjazd">{{ __('messages.arrived') }}</p><p class="wyjazd">{{ __('messages.return') }}</p><br>
					<input type="text" id="przyjazd" name="przyjazd" readonly="readonly">
					<input type="text" id="powrot" name="powrot" readonly="readonly">
					Ilość nocy: <b><span id="ilenocy"></span></b><br>
					Cena: <b><span id="price"></span></b><br>

					Ilość dorosłych:
					<input type="number"  style="width: 30px;" value="0" min="0" max="100" id="adults" ><br>
					Ilość dzieci:
					<input type="number"  style="width: 30px;" value="0" min="0" max="100" id="kids" >

				</form>
			</div>{{--
			 <hr class="ln1">
	
			<div class="form-apartament">{{ __('messages.fprice') }}<p class="cena-apart-noc" style="font-size: 25px;">300 zł</p></div> --}}
			<p class="termin" id="termin"></p>
			<button style="display:none;" name="reservation" id="reservation" >Rezerwuj</button>
		</div>
	</div>
	</div>
	<div class="clear"></div>
	<div class="apartament-info">
		<div class="apartament-info-l">
			<h2 class="apartamenty">{{ __('messages.description') }}</h2>
			<p class="article-text">{{ $apartament->descriptions[0]->apartament_description or '' }}</p>

			<h2 class="apartamenty" style="padding-top: 15px;">{{ __('messages.photos') }}</h2>
			<div class="galeria-container">
				<div class="fotorama" data-nav="thumbs" data-autoplay="true">

					@forelse($images as $image)
			 			<a href="{{ asset("images/apartaments/$image->id/$image->photo_link") }}"><img src="{{ asset("images/apartaments/$image->id/$image->photo_link") }}"></a>
			 		@empty
			 		<p>No photos for this apartment</p>
		 			@endforelse
				</div>
			</div>

			<h2 class="apartamenty">{{ __('messages.improvements') }}</h2>
			<p class="article-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.
			Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo.<br><br></p>

		</div>
		<div class="apartament-info-r">
			<h2 class="apartamenty">{{ __('messages.similiarap') }}</h2>
			<div class="parent">

			@foreach ($groups as $group)
				<a class="divlink" href="/apartaments/{{ $group->apartament_link }}">
					<div class="child-found">
						<div class="info-top">
							<div class="wyniki-cena"><p class="cena-top">160 zł</p></div>
							<div class="info-bottom"><p class="info-addons">{{ __('messages.inclbreakfast') }}</p></div>
						</div>
						<p class="title-found">{{ $group->apartament_name }}</p>
						<p class="address">{{ $group->apartament_city }}, {{$group->apartament_address}}, {{$group->apartament_address_2}}</p>

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
				</a>
			@endforeach

			</div>
		</div>
	</div>


<script type="text/javascript">



	$( "#przyjazd" ).datepicker({
		defaultDate: new Date(),
		dateFormat: "yy-mm-dd",
		minDate: new Date(), 
		onSelect: function(dateStr) 
		{         
			$("#powrot").datepicker("destroy");
			$("#powrot").val(dateStr);
			$("#powrot").datepicker({ 
				minDate: new Date(dateStr),
				dateFormat: "yy-mm-dd",
			})
		},
		onClose: function()
		{
			$("#powrot").focus();
		}
	});
	$( "#powrot").datepicker({
        defaultDate: new Date(),
		dateFormat: "yy-mm-dd",
		minDate: new Date(), 
	});




	$(document).ready(function(){


		$('#przyjazd').change(function(){

			if ($.trim($('#powrot').val()) != '')
			{
				ajaxConenction();
	
			}
		});

		$('#powrot').change(function(){
			if ($.trim($('#przyjazd').val()) != '')
			{
				ajaxConenction();
			}
		});

		function ajaxConenction(){
						var dateInc = $("#przyjazd");
						var dateOut = $("#powrot");
						var id = {{ $apartament->id }};
						
					    $.ajax({
					        type: "GET",
					        url: '/test',
					        dataType : 'json',
					        data: {
					        	przyjazd: dateInc.val(),
					        	powrot: dateOut.val(),
					        	id: id,
					        },
					        success: function(data) {
					            //console.log(data);  

					           $('#ilenocy').text(data.days_number);

					           if(data.is_available) {
		 							$('#termin').text("Apartament dostępny").css('color','green');
		 							$('#price').text(data.price+" PLN");
		 							$('#reservation').css('display','show');
					           }
					           else {
					           	 	$('#termin').text("Apartament zajęty").css('color','red');
					           }
					        },
					        error: function() {
					            console.log( "Error in connection with controller");
					        },
					    });	
			}
	});

	
</script>

@endsection
