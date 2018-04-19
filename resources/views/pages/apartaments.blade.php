@extends ('layout.layout')

@section('title', $apartament->apartament_city.' - '.$apartament->descriptions[0]->apartament_name.' - Zarezerwuj już teraz' )

@section('content')
	<div class="row">
		<div class="container py-1"><a href="{{ url()->previous() }}" class="btn btn-primary ml-2">{{ __('messages.Return') }}</a></div>
	</div>
	<div class="row back" style="background-image: url('{{ asset("images/apartaments/$apartament->id/1.jpg") }}">
		<div class="container">
			<div class="row apartament-info" >
				<div class="col-md-8">
					<div class="col transparent mt-2 mb-2 pb-1 pt-1 ">
						<h1 style="font-size: 26px"><b>{{  $apartament->descriptions[0]->apartament_name or '' }}</b></h1>
						<h2 style="font-size: 20px">{{ $apartament->apartament_city }}, {{ $apartament->apartament_address }}, {{ $apartament->apartament_address_2 }}</h2>
					</div>
					<div class="col transparent mt-4 mb-2 pt-3 ">
						<div class="container">
							<div class="row">
								<div class="col-md-3">
									<div class="row">
										<i class="fa fa-user fa-lg pt-1" aria-hidden="true"></i>
										<p class="pl-2">{{ __('messages.Room for') }} {{ $apartament->apartament_persons }} {{trans_choice('messages.persons',$apartament->apartament_persons)}}</p>
									</div>
								</div>
								<div class="col-md-3">
									<div class="row">
										<i class="fa fa-home fa-lg pt-1" aria-hidden="true"></i>
										<p class="pl-2">{{ $apartament->apartament_rooms_number }} {{trans_choice('messages.rooms_number',$apartament->apartament_rooms_number)}}</p>
									</div>
								</div>
								<div class="col-md-3">
									<div class="row">
										<i class="fa fa-calculator fa-lg pt-1" aria-hidden="true"></i>
										<p class="pl-2">{{ __('messages.ApSize') }}: 17 m²</p>
									</div>
								</div>
								<div class="col-md-3">
									<div class="row">
										<i class="fa fa-bed fa-lg pt-1" aria-hidden="true"></i>
										<p class="pl-2">{{ $beds }} {{trans_choice('messages.beds_number',$beds)}} </p>
									</div>
								</div>
							</div>
						</div>
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
						{!! Form::open(array('route' => 'reservations.firstStep', 'method' => 'get')) !!}
						{!! Form::hidden('link', $apartament->descriptions[0]->apartament_link) !!}
						{!! Form::hidden('id', $apartament->id) !!}
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
											<div class="input-group-addon" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.Adults') }}"><i class="fa fa-lg fa-male" aria-hidden="true" placeholder="{{ __('messages.adults')}}"></i></div>
											<select class="form-control" name='dorosli' style="width: 120px; height: 38px">
												@for($i=1; $i <= $apartament->apartament_persons; $i++)
													<option value="{{$i}}">{{$i}}</option>
												@endfor
											</select>
										</div>
									</div>
									<div class="col-md-6 pb-2">
										<div class="input-group mb-sm-0">
											<div class="input-group-addon" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.Kids') }}"><i class="fa fa-child" aria-hidden="true" placeholder="{{ __('messages.kids')}}"></i></div>
											<select class="form-control" name='dzieci' style="width: 120px; height: 38px">
												<option value="0">0</option>
												<option value="1">1</option>
												<option value="2">2</option>
												<option value="3">3</option>
												<option value="4">4</option>
												<option value="5">5</option>
												<option value="6">6</option>
												<option value="7">7</option>
												<option value="8">8</option>
											</select>
										</div>
									</div>
								</div>

							</div>

							<div class="res-info">
								<div class="row">
									<div class="col-8">
										{{ __('messages.Chosen nights')}}
									</div>
									<div class="col-4">
										<p align="right"><b><input class="form-control" id="ilenocy" name="ilenocy" readonly style="width: 50px"></input></b></p>
									</div>
								</div>
								<div class="row">
									<div class="col-6">
										<h3>{{ __('messages.fprice') }}</h3>
									</div>
									<div class="col-6 text-right">
										<h3><b><span id="price"></span></b></h3>
									</div>
									<div class="col-12 text-center font-weight-bold">
										<p class="termin"></p>
										<button class="btn btn-block btn-success res-btn" type="submit">{{ __('messages.reserve')}}</button>
									</div>
								</div>
							</div>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row ">
			<div class="col-md-8">
				<div class="row mt-3 mb-3">
					<div class="col">
						<h4><b>{{ __('messages.description') }}</b></h4>
						<p>{{ $apartament->descriptions[0]->apartament_description or '' }}</p>
					</div>
				</div>
				<div class="row mb-3">
					<div class="col-12">
						<h4 class="mt-2 mt-md-0"><b>{{__('messages.General information')}}</b></h4>
					</div>
					<div class="col-md-4">
						<div class="row">
							<div class="col">
								{{__('messages.Number of')}} {{__('messages.people')}}: <b>{{$apartament->apartament_persons}}</b>
							</div>
						</div>
						<div class="row">
							<div class="col">
								{{__('messages.Number of')}} {{__('messages.rooms')}}: <b>{{$apartament->apartament_rooms_number}}</b>
							</div>
						</div>
						<div class="row">
							<div class="col">
								{{__('messages.Number of')}} {{__('messages.floors')}}: <b>{{$apartament->apartament_floors_number}}</b>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="row">
							<div class="col">{{__('messages.Number of')}} {{__('messages.single beds')}}: <b>{{$apartament->apartament_single_beds}}</b></div>
						</div>
						<div class="row">
							<div class="col">{{__('messages.Number of')}} {{__('messages.double beds')}}: <b>{{$apartament->apartament_double_beds}}</b></div>
						</div>
						<div class="row">
							<div class="col">Wifi: <b>{{ $apartament->apartament_wifi ? __('messages.Yes') : __('messages.No')}}</b></div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="row">
							<div class="col">{{__('messages.Check-in')}}: <b>{{$apartament->apartament_registration_time }}</b></div>
						</div>
						<div class="row">
							<div class="col">{{__('messages.Check-out')}}: <b>{{$apartament->apartament_checkout_time }}</b></div>
						</div>
						<div class="row">
							<div class="col">{{__('messages.Deposit')}}: </div>
						</div>
					</div>
				</div>



				<div class="row mb-3">
					<div class="col">
						<h4><b>{{ __('messages.photos') }}</b></h4>
						<div class="fotorama" data-nav="thumbs" data-autoplay="true">

							@forelse($images as $image)
								<a href="{{ asset("images/apartaments/$image->id/$image->photo_link") }}"><img src="{{ asset("images/apartaments/$image->id/$image->photo_link") }}"></a>
							@empty
								<p>No photos for this apartment</p>
							@endforelse
						</div>
					</div>
				</div>
				<!--div id="calendar"></div-->
			</div>
			<div class="col-md-4">
				<div class="row">

				</div>
				<div class="row">

				</div>
			</div>
		</div>

	</div>

	<script type="text/javascript">
		var $calendar = $('#calendar').fullCalendar({
			header: {
				left: 'prev',
				center: 'title',
				right: 'next'
			},

			lang: 'en',
			defaultView: 'month',

			dayRender: function (date, cell) {
				var today = new Date();
				var date = new Date(2019);

				if (date.getDate() < today.getDate()) {
					//cell.css("background-color", "red");
					cell.addClass("notAv");;
				}
			}
		});

		$('#calendar').fullCalendar({

		});

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

						$('#ilenocy').val(data.days_number);


						if(data.is_available) {
							$('.termin').css('color','green');
							if (data.message == 1) $('.termin').text("Apartament dostępny");
							else $('.termin').text("Apartment is available");
							$('#price').text(data.price+" PLN");
							$('.res-info').show(1000);
							$('.res-btn').show();
						}
						else {
							$('.termin').css('color','red');
							if (data.message == 1) $('.termin').text("Apartament zajęty");
							else $('.termin').text("Apartment is not available");
							$('.res-info').show(1000);
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
