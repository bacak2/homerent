<div class="col">
  <form class="wyszukiwarka" action="/search/kafle" method="GET" >
    <div class="form-row">
      <div class="col-md-2 col-lg-3 mb-2 mb-sm-0">
        <input type="text" class="form-control" id="region" name="region" placeholder="{{ __('messages.forexample')}}">
      </div>
      <div class="form-inline col-md-5 form-row pick-date py-sm-3 py-md-0">
          <div class="col-sm-6 mb-2 mb-sm-0">
              <div class="input-group mb-2 mb-sm-0">
                  <div class="input-group-addon"><i class="fa fa-lg fa-calendar" aria-hidden="true"></i></div>
                  <input type="text" class="form-control" id="przyjazd" name="przyjazd" placeholder="{{ __('messages.arrive')}}" required style="margin-right: 1px">
              </div>
          </div>
          <div class="col-sm-6 mb-2 mb-sm-0">
              <div class="input-group mb-2 mb-sm-0">
                  <div class="input-group-addon"><i class="fa fa-lg fa-calendar" aria-hidden="true"></i></div>
                  <input type="text" class="form-control" id="powrot" name="powrot" placeholder="{{ __('messages.return')}}"  required style="margin-right: 1px">
              </div>
          </div>
      </div>
      <div class="col-12 col-sm">
          <div class="input-group mb-2 mb-sm-0">
            <div class="input-group-addon" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.Adults') }}"><i class="fa fa-lg fa-male" aria-hidden="true" placeholder="{{ __('messages.adults')}}"></i></div>
              <select class="form-control" name='dorosli'>
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
      <div class="col-12 col-sm">
        <div class="input-group mb-2 mb-sm-0">
          <div class="input-group-addon" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.Kids') }}"><i class="fa fa-child" aria-hidden="true" placeholder="{{ __('messages.kids')}}"></i></div>
              <select class="form-control" name='dzieci'>
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
      <div class="col-12 col-md mt-sm-3 mt-md-0">
        <button type="submit" class="btn btn-primary searchbtn">{{ __('messages.search') }}</button>
      </div>
    </div>
  </form>
</div>