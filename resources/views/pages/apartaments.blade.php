@extends ('layout.layout')

@section('title', '- '.$apartament->descriptions[0]->apartament_name )

@section('content')

<div class="row">
	<div class="container py-1"><button type="button" class="btn btn-primary ml-2">Powrót</button></div>
</div>

<div class="row back" style="background-image: url('{{ asset('images/placeholder.jpg') }}">
	<div class="container">
	    <div class="row" >
	        <div class="col-md-7 h-400">
	        	<div class="col transparent mt-2 mb-2 pb-1 pt-1">
	        		<h4><b>{{  $apartament->descriptions[0]->apartament_name or '' }}</b></h4>
					<p>{{ $apartament->apartament_city }}, {{ $apartament->apartament_address }}, {{ $apartament->apartament_address_2 }}</p>
	        	</div>
	        </div>
	        <div class="col-md-5">
	        	<div class="col transparent mt-2 mb-2 pb-1 pt-1">
	        		<div class="row">
	        			<div class="col-8">Najniższa cena za noc: 
	        			</div>
	        			<div class="col-4">
	        				<p align="right"><b>{{ $priceFrom }} zł</b></p>
	        			</div>
	        		</div>
	        		<form>
	        			<div class="form-row">
		        			<div class="form-group col-md-6">
		        				<span id="pick-date">
		        				<input type="text" class="form-control" id="przyjazd" name="przyjazd" placeholder="Przyjazd" pattern="(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))" required>
		        			</div>
		        			<div class="form-group col-md-6">
		        				<input type="text" class="form-control" id="powrot" name="powrot" placeholder="Powrót" pattern="(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))" required>
		        						        			</span>

		        			</div>
		        			<div class="form-group col-md-6">
							    <div class="input-group ">
									<div class="input-group-addon"><i class="fa fa-child" aria-hidden="true"></i></div>
									<input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Dzieci">
								</div>
							</div>
							<div class="form-group col-md-6">
								<div class="input-group ">
			                        <div class="input-group-addon"><i class="fa fa-male" aria-hidden="true"></i></div>
			                        <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Dorośli">
                      			</div>
		        			</div>

	        			</div>
	        		</form>
	        		<div class="row">
	        			<div class="col-8">
	        				Wybrana ilość nocy:
	        			</div>
	        			<div class="col-4">
	        				<p align="right"><b><span id="ilenocy"></span></b></p>
	        			</div>
	        		</div>
	        		<div class="row">
	        			<div class="col-8">
	        				<h4>Razem:</h4>
	        			</div>
	        			<div class="col-4">
	        				<h4 align="right"><b><span id="price"></span></b></p>
	        			</div>
	        		</div>	        		
	        	</div>
	        </div>
	    </div>
	</div>
</div>




<script type="text/javascript">

$(document).ready(function(){

	$.fn.changeVal = function (v) {
    return $(this).val(v).trigger("change");
}

	$('#pick-date').dateRangePicker(
	  {
	    separator : ' to ',
	    autoClose: true,
	    startOfWeek: 'monday',
	    startDate: new Date(),
	    customOpenAnimation: function(cb)
	    {
	      $(this).fadeIn(100, cb);
	    },
	    customCloseAnimation: function(cb)
	    {
	      $(this).fadeOut(100, cb);
	    },

	    getValue: function()
	    {
	      if ($('#przyjazd').val() && $('#powrot').val() )
	        return $('#przyjazd').val() + ' to ' + $('#powrot').val();
	      else
	        return '';
	    },
	    setValue: function(s,s1,s2)
	    {
	      $('#przyjazd').changeVal(s1);
	      $('#powrot').changeVal(s2);
	    },
	  });


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
					            console.log(data);  

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
