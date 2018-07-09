<div class="col">
    <form class="wyszukiwarka" action="{{$request->getPathInfo()}}" method="GET" >
    <div class="form-row">
      <div class="col-md-2 mb-2 mb-sm-0">
        <input type="text" class="form-control" id="region" name="region" placeholder="{{ __('messages.forexample')}}" value="{{ $_GET['region'] ?? '' }}">
      </div>
      <div class="form-inline col-md-5 form-row pick-date ">
          <div class="col-md-6 mb-2 mb-sm-0">
              <div class="input-group mb-2 mb-sm-0">
                  <div class="input-group-addon"><i class="fa fa-lg fa-calendar" aria-hidden="true"></i></div>
                  <input type="text" class="form-control" id="przyjazd" name="przyjazd" placeholder="{{ __('messages.arrive')}}" value="{{ $_GET['przyjazd'] ?? ''}}" required style="margin-right: 1px">
              </div>
          </div>
          <div class="col-md-6 mb-2 mb-sm-0">
              <div class="input-group mb-2 mb-sm-0">
                  <div class="input-group-addon"><i class="fa fa-lg fa-calendar" aria-hidden="true"></i></div>
                  <input type="text" class="form-control" id="powrot" name="powrot" placeholder="{{ __('messages.return')}}"  value="{{ $_GET['powrot'] ?? ''}}" required style="margin-right: 1px">
              </div>
          </div>
      </div>
      <div class="col-md">
          <div class="input-group mb-2 mb-sm-0">
            <div class="input-group-addon" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.Adults') }}"><i class="fa fa-lg fa-male" aria-hidden="true"></i></div>
              <select class="form-control" placeholder="{{ __('messages.adults')}}" name='dorosli'>
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
      <div class="col-md">
        <div class="input-group mb-2 mb-sm-0">
          <div class="input-group-addon" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.Kids') }}"><i class="fa fa-child" aria-hidden="true"></i></div>
              <select class="form-control" placeholder="{{ __('messages.kids')}}" name='dzieci'>
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
            <button type="submit" class="btn btn-primary searchbtn desktop-none mx-1" style="width: 100%">{{ __('messages.search') }}</button>
        <div class="col-md btn-group mobile-none">
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
                                <label>{!! Form::checkbox('SPA', null, null, ['id' => 'spa']) !!}<img src='{{ asset("images/results/wifi.png") }}'">{{ __('SPA') }}</label>
                            </p>
                            <p>
                                <label>{!! Form::checkbox('zwierzeta', null, null, ['id' => 'zwierzeta']) !!}<img src='{{ asset("images/results/wifi.png") }}'">{{ __('messages.Acceptance of animals') }}</label>
                            </p>
                            <p>
                                <label>{!! Form::checkbox('garaz', null, null, ['id' => 'garaz']) !!}<img src='{{ asset("images/results/wifi.png") }}'">{{ __('messages.Garage/Parking') }}</label>
                            </p>
                            <p>
                                <label>{!! Form::checkbox('kominek', null, null, ['id' => 'kominek']) !!}<img src='{{ asset("images/results/wifi.png") }}'">{{ __('messages.Fireplace') }}</label>
                            </p>
                            <p>
                                <label>{!! Form::checkbox('balkon', null, null, ['id' => 'balkon']) !!}<img src='{{ asset("images/results/wifi.png") }}'">{{ __('messages.Balcony/Terrace') }}</label>
                            </p>
                        </div>
                    </div>
                    <div class="col-3">
                        <span class="dzielnica">{{ __('messages.District') }}<i class="fa fa-caret-up dzielnica"></i></span>
                        <div class="dzielnica" style="display: none;">

                            <p>
                                <label>{!! Form::checkbox('distr1', null, null, ['id' => 'distr1', 'style'=>'display:none']) !!}<span class="district">Stare miasto</span></label>
                            </p>
                            <p>
                                <label>{!! Form::checkbox('distr2', null, null, ['id' => 'distr2', 'style'=>'display:none']) !!}<span class="district">Kazimierz</span></label>
                            </p>

                        </div>
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
