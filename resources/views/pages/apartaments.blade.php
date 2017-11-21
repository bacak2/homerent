@extends ('layout.layout')

@section('title', '- '.$apartament->descriptions[0]->apartament_name )

@section('content')

<div class="row">
	<div class="container py-1"><button type="button" class="btn btn-primary ml-2">Powrót</button></div>
</div>

<div class="row back" style="background-image: url('{{ asset('images/placeholder.jpg') }}">
	<div class="container">
	    <div class="row" >
	        <div class="col-md-8 h-400">
	        	<div class="col transparent mt-2 mb-2 pb-1 pt-1 ">
	        		<h4><b>{{  $apartament->descriptions[0]->apartament_name or '' }}</b></h4>
					<p>{{ $apartament->apartament_city }}, {{ $apartament->apartament_address }}, {{ $apartament->apartament_address_2 }}</p>
	        	</div>
	        </div>
	        <div class="col-md-4 ml-2 mr-2 ml-sm-0 mr-sm-0">
	        	<div class="col transparent mt-2 mb-2 pb-1 pt-1">
	        		<div class="row">
	        			<div class="col-8">{{ __('messages.lowestpricepnight')}}</div>
	        			<div class="col-4 text-right">
	        				<p><b>{{ $priceFrom }} zł</b></p>
	        			</div>
	        		</div>

	        		<form>
	        			<div class="form-row">
	        				<div class="pick-date form-row">
			        			<div class="col-md-6 pb-2">
			        				<input type="text" class="form-control" id="przyjazd" name="przyjazd" placeholder="{{ __('messages.arrive')}}" pattern="(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))" required>
			        			</div>
			        			<div class="col-md-6 pb-2">
			        				<input type="text" class="form-control" id="powrot" name="powrot" placeholder="{{ __('messages.return')}}" pattern="(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))" required>
			        			</div>
		        			</div>
	        				<div class="form-row pb-3">
			        			<div class="col-md-6 pb-2">
			        			    <div class="input-group mb-sm-0">
				                        <div class="input-group-addon"><i class="fa fa-male" aria-hidden="true"></i></div>
				                        <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="{{ __('messages.adults')}}">
				                    </div>	
			        			</div>
			        			<div class="col-md-6 pb-2">
			        			    <div class="input-group mb-sm-0">
					                    <div class="input-group-addon"><i class="fa fa-child" aria-hidden="true"></i></div>
					                    <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="{{ __('messages.kids')}}">
					                </div>				        				
			        			</div>
		        			</div>

	        			</div>
	        		</form>
	        		<div class="res-info">
		        		<div class="row">
		        			<div class="col-8">
		        				{{ __('messages.nights')}}
		        			</div>
		        			<div class="col-4">
		        				<p align="right"><b><span id="ilenocy"></span></b></p>
		        			</div>
		        		</div>
		        		<div class="row">
		        			<div class="col-6">
		        				<h4>{{ __('messages.fprice') }}</h4>
		        			</div>
		        			<div class="col-6 text-right">
		        				<h4><b><span id="price"></span></b></h4>
		        			</div>
		        			<div class="col-12 text-center font-weight-bold">
		        				<p class="termin"></p>
		        				<button class="btn btn-block btn-success res-btn">{{ __('messages.reserve')}}</button>
		        			</div>
		        		</div>	
	        		</div>        		
	        	</div>
	        </div>
	    </div>
	</div>
</div>
<div class="container">
	<div class="row ml-2 mr-2 ml-sm-0 mr-sm-0 mt-2">
		<div class="col-md-8">
			<div class="row">
				<h5><b>{{ __('messages.description') }}</b></h5>
				<p>{{ $apartament->descriptions[0]->apartament_description or '' }}</p>
				<h5><b>{{ __('messages.photos') }}</b></h5>
					<div class="fotorama" data-nav="thumbs" data-autoplay="true">

						@forelse($images as $image)
				 			<a href="{{ asset("images/apartaments/$image->id/$image->photo_link") }}"><img src="{{ asset("images/apartaments/$image->id/$image->photo_link") }}"></a>
				 		@empty
				 		<p>No photos for this apartment</p>
			 			@endforelse
					</div>
			</div>

		</div>
		<div class="col-md-4">
			<div class="row">
				<h5 class="mt-2 mt-md-0"><b>Udogodnienia</b></h5>
				<div class="row">
					<div class="col-8">Max- liczba osób</div><div class="col-4 text-right"><b>12</b></div>
					<div class="col-8">Ilość pokoi</div><div class="col-4 text-right"><b>5</b></div>
					<div class="col-8">Ilość łóżek</div><div class="col-4 text-right"><b>3</b></div>
				
				</div>
			</div>
			<div class="row">
				
			</div>
		</div>
	</div>
</div>



<script type="text/javascript">

 $('.res-info').hide();

$(document).ready(function(){

	$.fn.changeVal = function (v) {
    return $(this).val(v).trigger("change");
}

	$('.pick-date').dateRangePicker(
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
	      $('#przyjazd').val(s1);
	      $('#powrot').val(s2);
	      ajaxConenction();

	    },
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
		 							$('.termin').text("Apartament dostępny").css('color','green');
		 							$('#price').text(data.price+" PLN");
		 							$('.res-info').show(1000);
					           }
					           else {
					           	 	$('.termin').text("Apartament zajęty").css('color','red');
					           	 	$('.res-btn').hide();
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
