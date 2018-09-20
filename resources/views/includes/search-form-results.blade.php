<div class="col">
    <form id="wyszukiwarka" class="wyszukiwarka" action="{{$request->getPathInfo()}}" method="GET" >
    <div class="form-row">
      <div class="col-lg-3 mb-2 mb-lg-0">
        {{ Form::select('region', array('Zakopane'=>'Zakopane', 'Zakopane Centrum'=>'Zakopane Centrum', 'Zakopane Pardałówka'=>'Zakopane Pardałówka', 'Zakopane Nosal'=>'Zakopane Nosal', 'Zakopane Szymoszkowa'=>'Zakopane Szymoszkowa', 'Kościelisko'=>'Kościelisko', 'Witów'=>'Witów'), $request->region, array('class'=>'form-control'))}}
      </div>
      <div class="form-inline col-lg-5 px-1 mb-2 mb-lg-0">
          <div class="w-100 t-datepicker">
              <div class="t-check-in" style="background-color: #fff"></div>
              <div class="t-check-out" style="background-color: #fff"></div>
          </div>
      </div>
      <div class="col-12 col-sm">
          <div class="input-group mb-2 mb-lg-0 h-custom-search">
            <div class="input-group-addon" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.Adults') }}"><i class="fa fa-lg fa-male" aria-hidden="true"></i></div>
            {{ Form::select('dorosli', array(1=>1, 2=>2, 3=>3, 4=>4, 5=>5, 6=>6, 7=>7, 8=>8), $request->dorosli, array('class'=>'form-control'))}}
          </div>
      </div>
      <div class="col-12 col-sm">
        <div class="input-group mb-2 mb-lg-0 h-custom-search">
          <div class="input-group-addon" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.Kids') }}"><i class="fa fa-child" aria-hidden="true"></i></div>
            {{ Form::select('dzieci', array(0=>0, 1=>1, 2=>2, 3=>3, 4=>4, 5=>5, 6=>6, 7=>7, 8=>8), $request->dzieci, array('class'=>'form-control'))}}
        </div>
      </div>
        <div class="col-12 col-sm d-inline-block d-xl-none">
            <button type="submit" class="btn btn-primary searchbtn " style="width: 100%">{{ __('messages.search') }}</button>
        </div>

        <div class="col-md btn-group d-none d-xl-flex">
            <button type="submit" class="btn btn-primary searchbtn">{{ __('messages.search') }}</button>

            <button type="button" class="btn btn-filter dropdown-toggle" id="menu1" data-toggle="dropdown"><span>{{ __('messages.Filters') }}</span><!--img src="{{ asset("images/results/filter.png") }}"--></button>
            <div class="dropdown-menu" role="menu" aria-labelledby="menu1">
                {!! Form::open(array('url' => '#')) !!}
                <div class="row">
                    <div class="col-3">
                        <span class="cenaRange">{{ __('messages.Price per stay') }} (PLN)<i class="fa fa-caret-down cenaRange"></i></span>
                        <div class="cenaRange">
                            <input type="text" id="amount" name="amount" readonly>
                            <div id="slider-range"></div>
                            <input type="text" id="amount2" name="amount2" readonly>
                        </div>
                        {{--<div class="row">
                            <div class="col"><input id="firstPrice" class="w-100" type="number" min="0" max="1000" step="50"></div>
                            <div id="priceSlider" class="col mt-2"></div>
                            <div class="col"><input id="secondPrice" class="w-100" type="number" min="0" max="1000" step="50"></div>
                        </div>--}}
                    </div>
                    <div class="col-3">
                        <span class="lpokoi">{{ __('messages.Number of rooms') }}<i class="fa fa-caret-down lpokoi"></i></span>
                        <div class="lpokoi">
                            {!! Form::checkbox('1room', null, null, ['id' => '1room', 'style'=>'display:none']) !!}
                            <label for="1room">
                                <div class="filter-img" style="background-image: url('{{ asset("images/results/houseNumber.png") }}');"> <span>1</span> </div>
                            </label>
                            {!! Form::checkbox('2rooms', null, null, ['id' => '2rooms', 'style'=>'display:none']) !!}
                            <label for="2rooms">
                                <div class="filter-img" style="background-image: url('{{ asset("images/results/houseNumber.png") }}');"> <span>2</span> </div>
                            </label>
                            {!! Form::checkbox('3rooms', null, null, ['id' => '3rooms', 'style'=>'display:none']) !!}
                            <label for="3rooms">
                                <div class="filter-img" style="background-image: url('{{ asset("images/results/houseNumber.png") }}');"> <span>3</span> </div>
                            </label>
                            {!! Form::checkbox('4rooms', null, null, ['id' => '4rooms', 'style'=>'display:none']) !!}
                            <label for="4rooms">
                                <div class="filter-img more" style="background-image: url('{{ asset("images/results/houseNumber.png") }}');"> <span>4+</span> </div>
                            </label>
                        </div>
                    </div>
                    <div class="col-3">
                        <span class="udogodnienia">{{ __('messages.Facilities') }}<i class="fa fa-caret-down udogodnienia"></i></span>
                        <div class="udogodnienia">
                            <p>
                                <label>{!! Form::checkbox('spa', null, null, ['id' => 'spa']) !!}<img src='{{ asset("images/results/Bathtub_24.png") }}'">{{ __('SPA') }}</label>
                            </p>
                            <p>
                                <label>{!! Form::checkbox('zwierzeta', null, null, ['id' => 'zwierzeta']) !!}<img src='{{ asset("images/results/Dog_24.png") }}'">{{ __('messages.Acceptance of animals') }}</label>
                            </p>
                            <p>
                                <label>{!! Form::checkbox('garaz', null, null, ['id' => 'garaz']) !!}<img src='{{ asset("images/results/parking3.png") }}'">{{ __('messages.Garage/Parking') }}</label>
                            </p>
                            <p>
                                <label>{!! Form::checkbox('kominek', null, null, ['id' => 'kominek']) !!}<img src='{{ asset("images/results/Fireplace_24.png") }}'">{{ __('messages.Fireplace') }}</label>
                            </p>
                            <p>
                                <label>{!! Form::checkbox('balkon', null, null, ['id' => 'balkon']) !!}<img src='{{ asset("images/results/balcony.png") }}'">{{ __('messages.Balcony/Terrace') }}</label>
                            </p>
                        </div>
                    </div>
                    <div class="col-3">
                        {{--
                        <span class="dzielnica">{{ __('messages.District') }}<i class="fa fa-caret-up dzielnica"></i></span>
                        <div class="dzielnica" style="display: none;">

                            <p>
                                <label>{!! Form::checkbox('distr1', null, null, ['id' => 'distr1', 'style'=>'display:none']) !!}<span class="district">Stare miasto</span></label>
                            </p>
                            <p>
                                <label>{!! Form::checkbox('distr2', null, null, ['id' => 'distr2', 'style'=>'display:none']) !!}<span class="district">Kazimierz</span></label>
                            </p>

                        </div>
                        --}}
                    </div>
                </div>
                    <hr>
                    <button type="submit" class="btn btn-primary searchbtn">{{ __('messages.Apply filters') }}</button>
                    <a id="resetFilters" href="#">{{ __('messages.Restore default') }}</a>
            </div>
        </div>
    </div>
    <!--/form-->
</div>
