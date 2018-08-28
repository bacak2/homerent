<div class="col">
  <form id="wyszukiwarka" class="wyszukiwarka" action="/search/kafle" method="GET" >
    <div class="form-row">
      <div class="col-lg-2 col-xl-3 mb-2 mb-lg-0">
        <input type="text" class="form-control" id="region" name="region" placeholder="{{ __('messages.forexample')}}">
      </div>
      <div class="form-inline col-lg-5 px-1 mb-2 mb-lg-0">
          <div class="w-100 t-datepicker">
              <div class="t-check-in" style="background-color: #fff" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Proszę"></div>
              <div class="t-check-out" style="background-color: #fff"></div>
          </div>
      </div>
      <div class="col-12 col-sm">
          <div class="input-group mb-2 mb-lg-0 h-custom-search">
            <div class="input-group-addon" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.Adults') }}"><i class="fa fa-lg fa-male" aria-hidden="true" placeholder="{{ __('messages.adults')}}"></i></div>
              <select class="form-control font-14" name='dorosli' style="min-width: 95px" required oninvalid="this.setCustomValidity('Proszę wybrać liczbę osób')" oninput="this.setCustomValidity('')">
                <option value="" selected="selected">Dorośli</option>
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
        <div class="input-group mb-2 mb-lg-0 h-custom-search">
          <div class="input-group-addon" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.Kids') }}"><i class="fa fa-child" aria-hidden="true" placeholder="{{ __('messages.kids')}}"></i></div>
              <select class="form-control font-14" name='dzieci'>
                <option value="0" selected="selected">Dzieci</option>
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
      <div class="col-12 col-sm col-xl-1 mt-3 mt-sm-0 h-100">
        <button type="submit" class="btn btn-primary searchbtn py-2">{{ __('messages.search') }}</button>
      </div>
    </div>
  </form>
</div>