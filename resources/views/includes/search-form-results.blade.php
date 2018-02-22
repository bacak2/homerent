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
                {!! Form::open(array('url' => 'foo/bar')) !!}
                <div class="row">
                    <div class="col-3">
                        <span>Cena za pobyt (PLN)</span>
                    </div> 
                    <div class="col-3">
                        <span>Liczba pokoi</span>
                        <p>
                            <div class="filter-img" style="background-image: url('{{ asset("images/results/bed.png") }}');"> <span>1</span> </div>
                            <div class="filter-img" style="background-image: url('{{ asset("images/results/bed.png") }}');"> <span>2</span> </div>
                        </p>
                    </div>   
                    <div class="col-3">
                        <span>Łóżka</span>
                        <p>
                            <div class="filter-img" style="background-image: url('{{ asset("images/results/doubleBed.png") }}');"></div>
                            <div class="filter-img" style="background-image: url('{{ asset("images/results/bed.png") }}');"> <span>1</span></div>
                            <div class="filter-img" style="background-image: url('{{ asset("images/results/bed.png") }}');"> <span>2</span></div>
                            <div class="filter-img" style="background-image: url('{{ asset("images/results/bed.png") }}');"> <span>3+</span></div>
                        </p>                        
                    </div> 
                    <div class="col-3">
                        <span>Budynek</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <span>Udogodnienia</span>
                    </div>
                    <div class="col-3">

                        <p>
                            {!! Form::checkbox('klimatyzacja', null, null, ['id' => 'klimatyzacja']) !!}
                            {!! Form::label('klimatyzacja', 'Klimatyzacja') !!}
                        </p>
                        <p>
                            {!! Form::checkbox('wifi', null, null, ['id' => 'wifi']) !!}
                            {!! Form::label('wifi', 'Internet/Wifi') !!}
                        </p>
                        
                    </div> 
                    <div class="col-3">
                        <p>
                            {!! Form::checkbox('balkon', null, null, ['id' => 'balkon']) !!}
                            {!! Form::label('balkon', 'Balkon/taras') !!}
                        </p>
                        <p>
                            {!! Form::checkbox('telewizor', null, null, ['id' => 'telewizor']) !!}
                            {!! Form::label('telewizor', 'Telewizor') !!}
                        </p> 
                    </div> 
                </div>
                
                <div class="row">
                    <div class="col-3">
                        <span>Filtruj wg opinii</span>
                        <p>
                            {!! Form::checkbox('all', 'value') !!}
                            {!! Form::label('all', 'Wszystkie') !!}
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
                    <div class="col-3">
                        <span>Dzielnica</span>
                    </div>
                </div>
                    <hr>
                    <button type="submit" class="btn btn-primary searchbtn">{{ __('messages.Apply filters') }}</button>
                {!! Form::close() !!}

            </div>
        </div>
    </div>

</div>