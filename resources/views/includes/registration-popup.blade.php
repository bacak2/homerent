<div id="registration-popup" @if(!$errors->isEmpty() && old('auth_attempt') == 'register')style="display: block;" @else style="display: none;"@endif>
    <div id="registration-form">
        <div>
            <div class="mb-3" style="font-size: 24px"><b>{{ __('messages.Sign in') }}</b></div>
            <form class="logowanie" method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}
                <input type="hidden" name="auth_attempt" value="register">

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <input id="login" type="text" class="form-control" name="name" placeholder="{{ __('messages.name') }}" value="{{ old('name') }}" required="required" oninvalid="setCustomValidity('{{ __('messages.Fill this field') }}')" oninput="setCustomValidity('')">

                    @if ($errors->has('name') && old('auth_attempt') == 'register')
                        <span class="help-block font-11" style="color: red">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('surname') ? ' has-error' : '' }}">
                    <input id="login" type="text" class="form-control" name="surname" placeholder="{{ __('messages.surname') }}" value="{{ old('surname') }}" required="required" oninvalid="setCustomValidity('{{ __('messages.Fill this field') }}')" oninput="setCustomValidity('')">

                    @if ($errors->has('surname') && old('auth_attempt') == 'register')
                        <span class="help-block font-11" style="color: red">
                            <strong>{{ $errors->first('surname') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <input id="login" type="email" class="form-control" name="email" placeholder="{{ __('messages.Email address') }}" value="{{ old('email') }}" required="required" oninvalid="setCustomValidity('{{ __('messages.Enter valid email address') }}')" oninput="setCustomValidity('')">
                    @if ($errors->has('email') && old('auth_attempt') == 'register')
                        <span class="help-block font-11" style="color: red">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <input id="password" type="password" class="form-control" name="password" placeholder="{{ __('messages.Password') }}" required="required" oninvalid="setCustomValidity('{{ __('messages.Fill this field') }}')" oninput="setCustomValidity('')">
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                    <input id="repeat-password" type="password" class="form-control" name="password_confirmation" placeholder="{{ __('messages.Repeat password') }}" required="required" oninvalid="setCustomValidity('{{ __('messages.Fill this field') }}')" oninput="setCustomValidity('')">
                    @if ($errors->has('password') && old('auth_attempt') == 'register')
                        <span class="help-block font-11" style="color: red">
                              <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group mt-3">
                    <div class="row font-12">
                        <div class="col-12">
                            <label>
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} required="required" oninvalid="setCustomValidity('{{ __('messages.Accept the regulations') }}')" oninput="setCustomValidity('')">
                                {{ __('messages.I accept') }} <a href="/regulations" target="blank">{{ __('messages.regulations') }}</a> {{ __('messages.service') }} Otozakopane
                            </label>
                        </div>
                    <!--div class="col-6 pull-right" style="text-align: right;"> <a href="{{--route('password.request')--}}">Nie pamiętasz hasła?</a></div-->
                    </div>
                </div>
                <div class="form-group">
                    <input class="btn btn-primary" type="submit" id="submit" value="{{ __('messages.register') }}" style="width: 100%">
                </div>
                <div class="row">
                    <div class="col"><div style="background-image: url('{{ asset('images/reservations/dottedLine.png') }}');background-repeat: no-repeat; height: 1px; position: relative; top: 50%;"></div></div>
                    <div class="font-14">{{__('messages.or')}}</div>
                    <div class="col"><div style="background-image: url('{{ asset('images/reservations/dottedLine.png') }}');background-repeat: no-repeat; height: 1px; position: relative; top: 50%;"></div></div>
                </div>
                <div class="fb-login-button mt-3" data-width="278px" data-max-rows="1" data-size="large" data-button-type="login_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="false" scope="public_profile,email" onlogin="registerViaFb();"></div>
                <div class="font-11 mb-3">{{__('messages.logMessage1')}}</div>
                <div class="row">
                    <div class="col"><div style="background-image: url('{{ asset('images/reservations/dottedLine.png') }}');background-repeat: no-repeat; height: 1px; position: relative; top: 50%;"></div></div>
                </div>
            </form>
            <div class="font-12 mt-2"><b>{{__('messages.Have you account already?')}} <a href="#" id="switch-to-log-in">{{ __('messages.Log in')}}</a></b></div>
            <div id="cancel-registration-popup"><i class="fa fa-lg fa-close"></i></div>
        </div>
    </div>
</div>

<script>
    $("#sign-up").on('click', function(){
        $('#registration-popup').css('display', 'block');
    });

    $('#registration-form').click(function(event) {
        event.stopPropagation();
    });

    $("#registration-popup").on('click', function(){
        $('#registration-popup').css('display', 'none');
    });

    $("#cancel-registration-popup").on('click', function(){
        $('#registration-popup').css('display', 'none');
    });

    $("#switch-to-log-in").on('click', function(){
        $('#login-popup').css('display', 'block');
        $('#registration-popup').css('display', 'none');
    });


</script>