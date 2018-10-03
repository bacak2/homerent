<div class="col">
  <form class="wyszukiwarka" action="/search/kafle" method="GET" >
    <div class="form-row">
      <div class="col-12">
          <span class="text-white">{{ __('messages.Enter city, region or address')}}</span>
        <input value="{{ $tagCity }}" type="text" class="form-control h-50 mb-3" id="region" name="region" placeholder="{{ __('messages.forexample')}}">
      </div>
        <div class="col-12 form-inline form-row pick-date mx-0 mb-3">
            <div class="w-100 t-datepicker">
                <div class="t-check-in" style="background-color: #fff"></div>
                <div class="t-check-out" style="background-color: #fff"></div>
            </div>
        </div>
      <div class="col-6">
          <div class="input-group mb-3">
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
      <div class="col-6">
        <div class="input-group mb-3">
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
      <div class="col-12">
        <button type="submit" class="btn btn-primary searchbtn" style="width: 100%">{{ __('messages.search') }}</button>
      </div>
    </div>
  </form>
</div>

<script type="text/javascript">

    $('.t-datepicker').tDatePicker({
        autoClose: true,
        numCalendar: @mobile 1 @elsemobile 2 @endmobile,
        titleCheckIn: '{{ __('messages.arrival date') }}',
        titleCheckOut: '{{ __('messages.departure date') }}',
        titleToday: '{{ __('messages.Today') }}',
        titleDateRange: '{{ __('messages.Day') }}',
        titleDateRanges: '{{ __('messages.Days') }}',
        iconDate: '<i class="fa fa-lg fa-calendar" aria-hidden="true"></i>',
        titleDays: {!! titleDays() !!},
        titleMonths: {!! titleMonths() !!},
    });


    var options = {
        url: function(phrase) {
            return "autocomplete?phrase=" + phrase + "&format=json";
        },

        getValue: "apartament_name",

        theme: "",
        adjustWidth: false,

        template: {
            type: "description",
            fields: {
                description: "apartament_city"
            }


        }

    };


    $("#region").easyAutocomplete(options);


</script>