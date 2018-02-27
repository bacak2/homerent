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
                        <span class="lozka">{{ __('messages.Beds') }}<i class="fa fa-caret-up lozka"></i></span>
                        <div class="lozka" style="display: none">
                            {!! Form::checkbox('mdoubleBed', null, null, ['id' => 'mdoubleBed', 'style'=>'display:none']) !!}
                            <label for="mdoubleBed">
                                <div class="filter-img-align" style="background-image: url('{{ asset("images/results/doubleBedFilter.png") }}');"></div>
                            </label>
                            {!! Form::checkbox('m1bed', null, null, ['id' => 'm1bed', 'style'=>'display:none']) !!}
                            <label for="m1bed">
                                <div class="filter-img" style="background-image: url('{{ asset("images/results/bed.png") }}');"> <span>1</span> </div>
                            </label>
                            {!! Form::checkbox('m2beds', null, null, ['id' => 'm2beds', 'style'=>'display:none']) !!}
                            <label for="m2beds">
                                <div class="filter-img" style="background-image: url('{{ asset("images/results/bed.png") }}');"> <span>2</span> </div>
                            </label>
                            {!! Form::checkbox('m3beds', null, null, ['id' => 'm3beds', 'style'=>'display:none']) !!}
                            <label for="m3beds">
                                <div class="filter-img more" style="background-image: url('{{ asset("images/results/bed.png") }}');"> <span>3+</span> </div>
                            </label>                            
                        </div>                        
                    </div> 
                    <div class="col-12">
                        <span class="budynek">{{ __('messages.Building') }}<i class="fa fa-caret-up budynek"></i></span>
                        <div class="budynek" style="display: none">
                            {!! Form::checkbox('mapartment', null, null, ['id' => 'mapartment', 'style'=>'display:none']) !!}
                            <label for="mapartment">
                                <div class="filter-img-align" style="background-image: url('{{ asset("images/results/house.png") }}');"></div>
                            </label>   
                            {!! Form::checkbox('mhouse', null, null, ['id' => 'mhouse', 'style'=>'display:none']) !!}
                            <label for="mhouse">
                                <div class="filter-img-align" style="background-image: url('{{ asset("images/results/house.png") }}');"></div>
                            </label>
                            {!! Form::checkbox('magrotourism', null, null, ['id' => 'magrotourism', 'style'=>'display:none']) !!}
                            <label for="magrotourism">
                                <div class="filter-img-align" style="background-image: url('{{ asset("images/results/house.png") }}');"></div>
                            </label>                            
                        </div>
                    </div>
                    <div class="col-12">
                        <span class="udogodnienia">{{ __('messages.Facilities') }}<i class="fa fa-caret-up udogodnienia"></i></span>
                    </div>
                    <div class="col-12 udogodnienia" style="display: none">
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
                    <div class="col-12 udogodnienia" style="display: none">
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
                    <div class="col-12 udogodnienia" style="display: none">
                        <p>
                            <label>{!! Form::checkbox('zwierzeta', null, null, ['id' => 'zwierzeta']) !!}<img src='{{ asset("images/results/wifi.png") }}'">{{ __('messages.Acceptance of animals') }}</label>
                        </p>
                        <p>
                            <label>{!! Form::checkbox('palacy', null, null, ['id' => 'palacy']) !!}<img src='{{ asset("images/results/wifi.png") }}'">{{ __('messages.For smokers') }}</label>
                        </p>
                        <p>
                            <label>{!! Form::checkbox('niepelnosprawni', null, null, ['id' => 'niepelnosprawni']) !!}<img src='{{ asset("images/results/wifi.png") }}'">{{ __('messages.For the disabled') }}</label>
                        </p>                       
                    </div> 
                    <div class="col-12 udogodnienia" style="display: none">
                        <p>
                            <label>{!! Form::checkbox('kuchenka', null, null, ['id' => 'kuchenka']) !!}<img src='{{ asset("images/results/wifi.png") }}'">{{ __('messages.Cooker') }}</label>
                        </p>
                        <p>
                            <label>{!! Form::checkbox('czajnik', null, null, ['id' => 'czajnik']) !!}<img src='{{ asset("images/results/wifi.png") }}'">{{ __('messages.Electric kettle') }}</label>
                        </p>
                        <p>
                            <label>{!! Form::checkbox('zmywarka', null, null, ['id' => 'zmywarka']) !!}<img src='{{ asset("images/results/wifi.png") }}'">{{ __('messages.Washing machine') }}</label>
                        </p>
                        <p>
                            <label>{!! Form::checkbox('mikrofalowka', null, null, ['id' => 'mikrofalowka']) !!}<img src='{{ asset("images/results/wifi.png") }}'">{{ __('messages.Microwave') }}</label>
                        </p>                        
                    </div>
                    <div class="col-12">
                        <span class="opinie">{{ __('messages.Filter by opinion') }}<i class="fa fa-caret-up opinie"></i></span>
                    </div>
                        <div class="col-12 opinie" style="display: none">
                            <p>
                                <label>{!! Form::checkbox('all', 'on') !!}{{ __('messages.All') }}</label>
                            </p>
                            <p>
                                <label>{!! Form::checkbox('4stars', 'on') !!}                                 
                                    @for ($i = 0; $i < 4; $i++)
                                        <img src="{{ asset("images/results/star.png") }}">
                                    @endfor
                                    <img src="{{ asset("images/results/star_empty.png") }}">
                                </label>
                            </p>
                            <p>
                                <label>{!! Form::checkbox('3stars', 'on') !!}                                 
                                    @for ($i = 0; $i < 3; $i++)
                                        <img src="{{ asset("images/results/star.png") }}">
                                    @endfor
                                    @for ($i = 0; $i < 2; $i++)
                                        <img src="{{ asset("images/results/star_empty.png") }}">
                                    @endfor                                
                                </label>
                            </p>  
                            <p>
                                <label>{!! Form::checkbox('2stars', 'on') !!}                                 
                                    @for ($i = 0; $i < 2; $i++)
                                        <img src="{{ asset("images/results/star.png") }}">
                                    @endfor
                                    @for ($i = 0; $i < 3; $i++)
                                        <img src="{{ asset("images/results/star_empty.png") }}">
                                    @endfor                                
                                </label>
                            </p>
                            <p>
                                <label>{!! Form::checkbox('1star', 'on') !!}                                 
                                    @for ($i = 0; $i < 1; $i++)
                                        <img src="{{ asset("images/results/star.png") }}">
                                    @endfor
                                    @for ($i = 0; $i < 4; $i++)
                                        <img src="{{ asset("images/results/star_empty.png") }}">
                                    @endfor                                
                                </label>
                            </p>
                        </div>
                    </div>