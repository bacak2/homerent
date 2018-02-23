<div class="col">
    <form class="wyszukiwarka" action="{{$request->getPathInfo()}}" method="GET" >
    <div class="form-row">
      <div class="col-md-3 mb-2 mb-sm-0">
        <input type="text" class="form-control" id="region" name="region" placeholder="{{ __('messages.forexample')}}" value="{{ $_GET['region'] }}">
      </div>
      <div class="form-inline col-md-5 form-row pick-date ">
          <div class="col-md-6 mb-2 mb-sm-0">
              <div class="input-group mb-2 mb-sm-0">
                  <div class="input-group-addon"><i class="fa fa-lg fa-calendar" aria-hidden="true"></i></div>
                  <input type="text" class="form-control" id="przyjazd" name="przyjazd" placeholder="{{ __('messages.arrive')}}" value="{{ $_GET['przyjazd'] }}" required>
              </div>
          </div>
          <div class="col-md-6 mb-2 mb-sm-0">
              <div class="input-group mb-2 mb-sm-0">
                  <div class="input-group-addon"><i class="fa fa-lg fa-calendar" aria-hidden="true"></i></div>
                  <input type="text" class="form-control" id="powrot" name="powrot" placeholder="{{ __('messages.return')}}"  value="{{ $_GET['powrot'] }}" required>
              </div>
          </div>
      </div>
      <div class="col-md">
          <div class="input-group mb-2 mb-sm-0">
            <div class="input-group-addon"><i class="fa fa-lg fa-male" aria-hidden="true"></i></div>
              <select class="form-control" placeholder="{{ __('messages.adults')}}" name='dorosli'>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
              </select>
          </div>
      </div>
      <div class="col-md">
        <div class="input-group mb-2 mb-sm-0">
          <div class="input-group-addon"><i class="fa fa-child" aria-hidden="true"></i></div>
              <select class="form-control" placeholder="{{ __('messages.kids')}}" name='dzieci'>
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
              </select>
        </div>
      </div>
            <button type="submit" class="btn btn-primary searchbtn desktop-none">{{ __('messages.search') }}</button>
        <div class="col-md btn-group mobile-none">
            <button type="submit" class="btn btn-primary searchbtn">{{ __('messages.search') }}</button>
</form>            
            <button type="button" class="btn btn-filter dropdown-toggle" id="menu1" data-toggle="dropdown"><span>{{ __('messages.Filters') }}</span><!--img src="{{ asset("images/results/filter.png") }}"--></button>
            <div class="dropdown-menu" role="menu" aria-labelledby="menu1">
                {!! Form::open(array('url' => '#')) !!}
                <div class="row">
                    <div class="col-3">
                        <span class="cenaRange">{{ __('messages.Price per stay') }} (PLN)<i class="fa fa-caret-down cenaRange"></i></span>
                        <div class="cenaRange">
                            <input type="text" id="amount" readonly>
                            <div id="slider-range"></div>
                            <input type="text" id="amount2" readonly>
                        </div>
                    </div> 
                    <div class="col-3">
                        <span class="lpokoi">{{ __('messages.Number of rooms') }}<i class="fa fa-caret-down lpokoi"></i></span>
                        <div class="lpokoi">
                            {!! Form::checkbox('1room', null, null, ['id' => '1room', 'style'=>'display:none']) !!}
                            <label for="1room">
                                <div class="filter-img" style="background-image: url('{{ asset("images/results/bed.png") }}');"> <span>1</span> </div>
                            </label>
                            {!! Form::checkbox('2rooms', null, null, ['id' => '2rooms', 'style'=>'display:none']) !!}
                            <label for="2rooms">
                                <div class="filter-img" style="background-image: url('{{ asset("images/results/bed.png") }}');"> <span>2</span> </div>
                            </label>
                            {!! Form::checkbox('3rooms', null, null, ['id' => '3rooms', 'style'=>'display:none']) !!}
                            <label for="3rooms">
                                <div class="filter-img" style="background-image: url('{{ asset("images/results/bed.png") }}');"> <span>3</span> </div>
                            </label>
                            {!! Form::checkbox('4rooms', null, null, ['id' => '4rooms', 'style'=>'display:none']) !!}
                            <label for="4rooms">
                                <div class="filter-img more" style="background-image: url('{{ asset("images/results/bed.png") }}');"> <span>4+</span> </div>
                            </label>                            
                        </div>
                    </div>   
                    <div class="col-3">
                        <span class="lozka">{{ __('messages.Beds') }}<i class="fa fa-caret-down lozka"></i></span>
                        <div class="lozka">
                            {!! Form::checkbox('doubleBed', null, null, ['id' => 'doubleBed', 'style'=>'display:none']) !!}
                            <label for="doubleBed">
                                <div class="filter-img-align" style="background-image: url('{{ asset("images/results/doubleBedFilter.png") }}');"></div>
                            </label>
                            {!! Form::checkbox('1bed', null, null, ['id' => '1bed', 'style'=>'display:none']) !!}
                            <label for="1bed">
                                <div class="filter-img" style="background-image: url('{{ asset("images/results/bed.png") }}');"> <span>1</span> </div>
                            </label>
                            {!! Form::checkbox('2beds', null, null, ['id' => '2beds', 'style'=>'display:none']) !!}
                            <label for="2beds">
                                <div class="filter-img" style="background-image: url('{{ asset("images/results/bed.png") }}');"> <span>2</span> </div>
                            </label>
                            {!! Form::checkbox('3beds', null, null, ['id' => '3beds', 'style'=>'display:none']) !!}
                            <label for="3beds">
                                <div class="filter-img more" style="background-image: url('{{ asset("images/results/bed.png") }}');"> <span>3+</span> </div>
                            </label>                            
                        </div>                        
                    </div> 
                    <div class="col-3">
                        <span class="budynek">{{ __('messages.Building') }}<i class="fa fa-caret-down budynek"></i></span>
                        <div class="budynek">
                            {!! Form::checkbox('apartment', null, null, ['id' => 'apartment', 'style'=>'display:none']) !!}
                            <label for="apartment">
                                <div class="filter-img-align" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Apartment') }}" style="background-image: url('{{ asset("images/results/doubleBedFilter.png") }}');"></div>
                            </label>   
                            {!! Form::checkbox('house', null, null, ['id' => 'house', 'style'=>'display:none']) !!}
                            <label for="house">
                                <div class="filter-img-align" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.House') }}" style="background-image: url('{{ asset("images/results/doubleBedFilter.png") }}');"></div>
                            </label>
                            {!! Form::checkbox('agrotourism', null, null, ['id' => 'agrotourism', 'style'=>'display:none']) !!}
                            <label for="agrotourism">
                                <div class="filter-img-align" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Agrotourism') }}" style="background-image: url('{{ asset("images/results/doubleBedFilter.png") }}');"></div>
                            </label>                            
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <span class="udogodnienia">{{ __('messages.Facilities') }}<i class="fa fa-caret-down udogodnienia"></i></span>
                    </div>
                    <div class="col-3 udogodnienia">
                        <p>
                            <label>{!! Form::checkbox('klimatyzacja', null, null, ['id' => 'klimatyzacja']) !!}<img src='{{ asset("images/results/wifi.png") }}'">{{ __('messages.Air conditioning') }}</label>
                        </p>
                        <p>
                            <label>{!! Form::checkbox('wifi', null, null, ['id' => 'wifi']) !!}<img src='{{ asset("images/results/wifi.png") }}'">Internet/Wifi</label>
                        </p>
                        <p>
                            <label>{!! Form::checkbox('garaz', null, null, ['id' => 'garaz']) !!}<img src='{{ asset("images/results/wifi.png") }}'">{{ __('messages.Garage/Parking') }}</label>
                        </p>
                        <p>
                            <label>{!! Form::checkbox('winda', null, null, ['id' => 'winda']) !!}<img src='{{ asset("images/results/wifi.png") }}'">{{ __('messages.Elevator') }}</label>
                        </p>                        
                    </div> 
                    <div class="col-3 udogodnienia">
                        <p>
                            <label>{!! Form::checkbox('balkon', null, null, ['id' => 'balkon']) !!}<img src='{{ asset("images/results/wifi.png") }}'">{{ __('messages.Balcony/Terrace') }}</label>
                        </p>
                        <p>
                            <label>{!! Form::checkbox('telewizor', null, null, ['id' => 'telewizor']) !!}<img src='{{ asset("images/results/wifi.png") }}'">{{ __('messages.Television set') }}</label>
                        </p>
                        <p>
                            <label>{!! Form::checkbox('odkurzacz', null, null, ['id' => 'odkurzacz']) !!}<img src='{{ asset("images/results/wifi.png") }}'">{{ __('messages.Vacuum cleaner') }}</label>
                        </p>
                        <p>
                            <label>{!! Form::checkbox('lozeczko', null, null, ['id' => 'lozeczko']) !!}<img src='{{ asset("images/results/wifi.png") }}'">{{ __('messages.Bed for a child') }}</label>
                        </p>                        
                    </div> 
                    <div class="col-3 udogodnienia">
                        <p>
                            <label>{!! Form::checkbox('klimatyzacja', null, null, ['id' => 'klimatyzacja']) !!}<img src='{{ asset("images/results/wifi.png") }}'">{{ __('messages.Acceptance of animals') }}</label>
                        </p>
                        <p>
                            <label>{!! Form::checkbox('wifi', null, null, ['id' => 'wifi']) !!}<img src='{{ asset("images/results/wifi.png") }}'">{{ __('messages.For smokers') }}</label>
                        </p>
                        <p>
                            <label>{!! Form::checkbox('garaz', null, null, ['id' => 'garaz']) !!}<img src='{{ asset("images/results/wifi.png") }}'">{{ __('messages.For the disabled') }}</label>
                        </p>                       
                    </div> 
                    <div class="col-3 udogodnienia">
                        <p>
                            <label>{!! Form::checkbox('balkon', null, null, ['id' => 'balkon']) !!}<img src='{{ asset("images/results/wifi.png") }}'">{{ __('messages.Cooker') }}</label>
                        </p>
                        <p>
                            <label>{!! Form::checkbox('telewizor', null, null, ['id' => 'telewizor']) !!}<img src='{{ asset("images/results/wifi.png") }}'">{{ __('messages.Electric kettle') }}</label>
                        </p>
                        <p>
                            <label>{!! Form::checkbox('odkurzacz', null, null, ['id' => 'odkurzacz']) !!}<img src='{{ asset("images/results/wifi.png") }}'">{{ __('messages.Washing machine') }}</label>
                        </p>
                        <p>
                            <label>{!! Form::checkbox('lozeczko', null, null, ['id' => 'lozeczko']) !!}<img src='{{ asset("images/results/wifi.png") }}'">{{ __('messages.Microwave') }}</label>
                        </p>                        
                    </div>                    
                </div>
                
                <div class="row">
                    <div class="col-3">
                        <span>{{ __('messages.Filter by opinion') }}</span>
                        <p>
                            <label>{!! Form::checkbox('all', 'value') !!}{{ __('messages.All') }}</label>
                        </p>
                        <p>
                            <label>{!! Form::checkbox('name', 'value') !!}                                 
                                @for ($i = 0; $i < 4; $i++)
                                    <img src="{{ asset("images/results/star.png") }}">
                                @endfor
                                <img src="{{ asset("images/results/star_empty.png") }}">
                            </label>
                        </p>
                        <p>
                            <label>{!! Form::checkbox('name', 'value') !!}                                 
                                @for ($i = 0; $i < 3; $i++)
                                    <img src="{{ asset("images/results/star.png") }}">
                                @endfor
                                @for ($i = 0; $i < 2; $i++)
                                    <img src="{{ asset("images/results/star_empty.png") }}">
                                @endfor                                
                            </label>
                        </p>  
                        <p>
                            <label>{!! Form::checkbox('name', 'value') !!}                                 
                                @for ($i = 0; $i < 2; $i++)
                                    <img src="{{ asset("images/results/star.png") }}">
                                @endfor
                                @for ($i = 0; $i < 3; $i++)
                                    <img src="{{ asset("images/results/star_empty.png") }}">
                                @endfor                                
                            </label>
                        </p>
                        <p>
                            <label>{!! Form::checkbox('name', 'value') !!}                                 
                                @for ($i = 0; $i < 1; $i++)
                                    <img src="{{ asset("images/results/star.png") }}">
                                @endfor
                                @for ($i = 0; $i < 4; $i++)
                                    <img src="{{ asset("images/results/star_empty.png") }}">
                                @endfor                                
                            </label>
                        </p>                         
                    </div>
                    <div class="col-9">
                        <span class="dzielnica">{{ __('messages.District') }}<i class="fa fa-caret-up dzielnica"></i></span>
                    </div>
                        <div class="dzielnica col-3 udogodnienia" style="display: none;">

                            <p>
                                <label>Stare miasto</label>
                            </p>
                            <p>
                                <label>Kazimierz</label>
                            </p>

                        </div>
                        <div class="dzielnica col-6 udogodnienia" style="display: none;">

                            <p>
                                <label>Stare miasto</label>
                            </p>
                            <p>
                                <label>Kazimierz</label>
                            </p>

                        </div>
                   
                </div>
                    <hr>
                    <button type="submit" class="btn btn-primary searchbtn">{{ __('messages.Apply filters') }}</button>
                    <a id="resetFilters" href="#">{{ __('messages.Restore default') }}</a>
                {!! Form::close() !!}

            </div>
        </div>
    </div>

</div>