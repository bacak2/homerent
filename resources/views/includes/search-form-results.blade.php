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
        <div class="col-md btn-group">
            <button type="submit" class="btn btn-primary searchbtn">{{ __('messages.search') }}</button>
</form>            
            <button type="button" class="btn btn-filter dropdown-toggle" id="menu1" data-toggle="dropdown"><span>{{ __('messages.Filters') }}</span><!--img src="{{ asset("images/results/filter.png") }}"--></button>
            <div class="dropdown-menu" role="menu" aria-labelledby="menu1">
                {!! Form::open(array('url' => 'foo/bar')) !!}
                    
                {!! Form::close() !!}
                <form>
                    <input type="text">
                    <label for="male">Male</label>
                    <input name="male" type="checkbox">
                    <hr>
                    <button type="submit" class="btn btn-primary searchbtn">{{ __('messages.search') }}</button>
                </form>
            </div>
        </div>
    </div>

</div>