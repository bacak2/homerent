                <div class="d-xl-none filters-toggle filters-mobile font-12" style="display: none">
                    <div class="col-12">
                        <span class="cenaRange">{{ __('messages.Price per stay') }} (PLN)<i class="fa fa-caret-up cenaRange"></i></span>
                        <div class="cenaRange row" style="display: none">
                            <div class="col"><input class="w-100" type="text" id="Mamount" name="Mamount" readonly></div>
                            <div id="priceSlider" class="col-6 mt-1"></div>
                            <div class="col"><input class="w-100" type="text" id="Mamount2" name="Mamount2" readonly></div>
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
                            <label>{!! Form::checkbox('spa', null, null, ['id' => 'spa']) !!}<img src='{{ asset("images/results/Bathtub_24.png") }}'">{{ __('Spa') }}</label>
                        </p>
                        <p>
                            <label>{!! Form::checkbox('zwierzeta', null, null, ['id' => 'zwierzeta']) !!}<img src='{{ asset("images/results/Dog_24.png") }}'">{{ __('messages.Acceptance of animals') }}</label>                        </p>
                        <p>
                            <label>{!! Form::checkbox('garaz', null, null, ['id' => 'garaz']) !!}<img src='{{ asset("images/results/parking3.png") }}'">{{ __('messages.Garage/Parking') }}</label>
                        </p>
                        <p>
                            <label>{!! Form::checkbox('kominek', null, null, ['id' => 'kominek']) !!}<img src='{{ asset("images/results/Fireplace_24.png") }}'">{{ __('messages.Fireplace') }}</label>
                        </p>
                        <p>
                            <label>{!! Form::checkbox('balkon', null, null, ['id' => 'balkon']) !!}<img src='{{ asset("images/results/balcony.png") }}'">{{ __('messages.Balcony/Terrace') }}</label>
                        </p>
                    </div>

                    <div class="col-12">
                        <input class="btn btn-info btn-mobile filters-toggle" type="submit" value="zapisz">
                    </div>
                </div>