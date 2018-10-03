<!-- Slider -->
<header>
  <div id="mainSliderSearch" class="carousel slide" data-ride="carousel" data-interval="7000">
      <div class="carousel-inner d-none d-md-block d-lg-block d-xl-block">
          <div class="carousel-item active">
              <img class="d-block w-100" src="/images/slider/1.jpg" alt="First slide">
              <div class="font-16 text-white" style="text-shadow: 1px 1px 0 black; width: 158px; position: absolute; bottom: 12px; right: 12px;">
                  <div class="pl-2" style="width: 100%; background-color: rgba(248,249,255,0.43); margin-bottom: 5px">
                      <span class="d-block bold">{{__('messages.From')}}</span>
                      <span class="bold" style="font-size: 28px">{{$secondCityMinPrice}} PLN</span>
                      <span>{{__('messages.pernight')}}</span></span>
                  </div>
                  <div class="pl-2 py-1" style="width: 100%; background-color: rgba(45,45,47,0.74)">Kościelisko</div>
              </div>
          </div>
          <div class="carousel-item">
              <img class="d-block w-100" src="/images/slider/2.jpg" alt="Second slide">
              <div class="font-16 text-white" style="text-shadow: 1px 1px 0 black; width: 158px; position: absolute; bottom: 12px; right: 12px;">
                  <div class="pl-2" style="width: 100%; background-color: rgba(248,249,255,0.43); margin-bottom: 5px">
                      <span class="d-block bold">{{__('messages.From')}}</span>
                      <span class="bold" style="font-size: 28px">{{$thirdCityMinPrice}} PLN</span>
                      <span>{{__('messages.pernight')}}</span></span>
                  </div>
                  <div class="pl-2 py-1" style="width: 100%; background-color: rgba(45,45,47,0.74)">Witów</div>
              </div>
          </div>
          <div class="carousel-item">
              <img class="d-block w-100" src="/images/slider/3.jpg" alt="Third slide">
              <div class="font-16 text-white" style="text-shadow: 1px 1px 0 black; width: 158px; position: absolute; bottom: 12px; right: 12px;">
                  <div class="pl-2" style="width: 100%; background-color: rgba(248,249,255,0.43); margin-bottom: 5px">
                      <span class="d-block bold">{{__('messages.From')}}</span>
                      <span class="bold" style="font-size: 28px">{{$firstCityMinPrice}} PLN</span>
                      <span>{{__('messages.pernight')}}</span></span>
                  </div>
                  <div class="pl-2 py-1" style="width: 100%; background-color: rgba(45,45,47,0.74)">Zakopane</div>
              </div>
          </div>
          <span style="font-size: 32px; font-weight: bold; position: absolute; top: 20px; left: 10px;  background-color: rgba(248,249,255,0.43); margin-bottom: 5px; padding: 5px 10px;">{{__('messages.Discover Poland that you do not know')}}</span>
      </div>
      <div id="topSearch" style="background-image: {{url('/images/slider/1.jpg')}}; min-height: 200px">
        <div class="container searchCont">
              <h1 class="d-block d-sm-none">{{__('messages.Discover Poland that you do not know')}}</h1>
        </div>
      </div>
  </div>
</header>