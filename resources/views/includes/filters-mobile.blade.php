                <div class="desktop-none filters-toggle filters-mobile" style="display: none">
                    <div class="col-12">
                        <span class="cenaRange">{{ __('messages.Price per stay') }} (PLN)<i class="fa fa-caret-up cenaRange"></i></span>
                        <div class="cenaRange" style="display: none">
                            <input type="text" id="Mamount" readonly>
                            <div id="Mslider-range"></div>
                            <input type="text" id="Mamount2" readonly>
                        </div>
                    </div> 
                    <div class="col-12">
                        <span class="lpokoi">{{ __('messages.Number of rooms') }}<i class="fa fa-caret-up lpokoi"></i></span>
                        <div class="lpokoi" style="display: none">
                            {!! Form::checkbox('m1room', null, null, ['id' => 'm1room', 'style'=>'display:none']) !!}
                            <label for="m1room">
                                <div class="filter-img" style="background-image: url('{{ asset("images/results/houseNumber.png") }}');"> <span>1</span> </div>
                            </label>
                            {!! Form::checkbox('m2rooms', null, null, ['id' => 'm2rooms', 'style'=>'display:none']) !!}
                            <label for="m2rooms">
                                <div class="filter-img" style="background-image: url('{{ asset("images/results/houseNumber.png") }}');"> <span>2</span> </div>
                            </label>
                            {!! Form::checkbox('m3rooms', null, null, ['id' => 'm3rooms', 'style'=>'display:none']) !!}
                            <label for="m3rooms">
                                <div class="filter-img" style="background-image: url('{{ asset("images/results/houseNumber.png") }}');"> <span>3</span> </div>
                            </label>
                            {!! Form::checkbox('m4rooms', null, null, ['id' => 'm4rooms', 'style'=>'display:none']) !!}
                            <label for="m4rooms">
                                <div class="filter-img more" style="background-image: url('{{ asset("images/results/houseNumber.png") }}');"> <span>4+</span> </div>
                            </label>                            
                        </div>
                    </div>
                    <div class="col-12">
                        <span class="udogodnienia">{{ __('messages.Facilities') }}<i class="fa fa-caret-up udogodnienia"></i></span>
                    </div>
                    <div class="col-12 udogodnienia" style="display: none">
                        <p>
                            <label>{!! Form::checkbox('SPA', null, null, ['id' => 'spa']) !!}<img src='{{ asset("images/results/wifi.png") }}'">{{ __('Spa') }}</label>
                        </p>
                        <p>
                            <label>{!! Form::checkbox('zwierzeta', null, null, ['id' => 'zwierzeta']) !!}<img src='{{ asset("images/results/wifi.png") }}'">{{ __('messages.Acceptance of animals') }}</label>                        </p>
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