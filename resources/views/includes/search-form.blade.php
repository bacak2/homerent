<div class="col">
  <form class="wyszukiwarka" action="/search/kafle" method="GET" >
    <div class="form-row">
      <div class="col-md-3 mb-2 mb-sm-0">
        <input type="text" class="form-control" id="region" name="region" placeholder="{{ __('messages.forexample')}}">
      </div>
      <div class="form-inline col-md-5 form-row pick-date ">
          <div class="col-md-6 mb-2 mb-sm-0">
              <div class="input-group mb-2 mb-sm-0">
                  <div class="input-group-addon"><i class="fa fa-lg fa-calendar" aria-hidden="true"></i></div>
                  <input type="text" class="form-control" id="przyjazd" name="przyjazd" placeholder="{{ __('messages.arrive')}}" required>
              </div>
          </div>
          <div class="col-md-6 mb-2 mb-sm-0">
              <div class="input-group mb-2 mb-sm-0">
                  <div class="input-group-addon"><i class="fa fa-lg fa-calendar" aria-hidden="true"></i></div>
                  <input type="text" class="form-control" id="powrot" name="powrot" placeholder="{{ __('messages.return')}}"  required>
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
                <option value="1">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
              </select>
        </div>
      </div>
      <div class="col-md">
        <button type="submit" class="btn btn-primary searchbtn">{{ __('messages.search') }}</button>
      </div>
    </div>
  </form>
</div>