@extends ('layout.layout')

@section('title', '- '.$apartament->descriptions[0]->apartament_name )

@section('content')

<div class="row">
	<div class="container py-1"><button type="button" class="btn btn-primary ml-2">Powrót</button></div>
</div>
<div class="row" id="apartament-big">
	<div class="col" style="background-image: url('{{ asset('images/placeholder.jpg') }}')">
			<div class="container pt-2">
				<div class="row">
						<div class="col ap-transparent">
							<h4>{{  $apartament->descriptions[0]->apartament_name or '' }}</h4>
							<p>{{ $apartament->apartament_city }}, {{ $apartament->apartament_address }}, {{ $apartament->apartament_address_2 }}</p>
						</div>
						<div class="col-auto reviews">
							<h4>9,1/10</h4>
						</div>
				</div>
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
