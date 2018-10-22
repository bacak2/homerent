<div id="login-popup" @if(!$errors->isEmpty() && old('auth_attempt') == 'login')style="display: block;" @else style="display: none;"@endif>
    <div id="login-form">
        <div>
            <div class="mb-3" style="font-size: 24px"><b>{{ __('messages.Log in') }}</b></div>
            <div class="fb-login-button" data-width="278px" data-max-rows="1" data-size="large" data-button-type="login_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="false" scope="public_profile,email" onlogin="checkLoginState();"></div>
            <div class="font-11 mb-2">{{ __('messages.logMessage1') }}</div>
            <div class="font-11">{{ __('messages.logMessage2') }}</div>
            <div class="font-11 bold">{{ __('messages.logMessage3') }}</div>
            <div class="row">
                <div class="col"><div style="background-image: url('{{ asset('images/reservations/dottedLine.png') }}');background-repeat: no-repeat; height: 1px; position: relative; top: 50%;"></div></div>
                <div class="font-14">{{__('messages.or')}}</div>
                <div class="col"><div style="background-image: url('{{ asset('images/reservations/dottedLine.png') }}');background-repeat: no-repeat; height: 1px; position: relative; top: 50%;"></div></div>
            </div>
            <form class="logowanie" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
                <input type="hidden" name="auth_attempt" value="login">

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <input id="login" type="email" class="form-control" name="email" placeholder="{{ __('messages.Email address') }}" value="{{ old('email') }}" required="required" oninvalid="setCustomValidity('{{ __('messages.Enter valid email address') }}')" oninput="setCustomValidity('')">

                    @if ($errors->has('email') && old('auth_attempt') == 'login')
                        <span class="help-block font-11" style="color: red">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif

                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                    <input id="password" type="password" class="form-control" name="password" placeholder="{{ __('messages.Password') }}" required="required" oninvalid="setCustomValidity('{{ __('messages.Fill this field') }}')" oninput="setCustomValidity('')">

                    @if ($errors->has('password') && old('auth_attempt') == 'login')
                        <span class="help-block font-11" style="color: red">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <div class="row font-12">
                        <div class="col-6">
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> <span style="position: relative;top: -4px;">{{ __('messages.Remember') }}</span>
                        </div>
                        <div class="col-6 pull-right" style="text-align: right;"> <a href="{{route('password.request')}}">{{ __('messages.Have you forgot your password?') }}</a></div>
                    </div>
                </div>
                <div class="form-group">
                    <input class="btn btn-primary" type="submit" id="submit" value="{{ __('messages.login') }}" style="width: 100%">
                </div>

            </form>
            <div class="row">
                <div class="col"><div style="background-image: url('{{ asset('images/reservations/dottedLine.png') }}');background-repeat: no-repeat; height: 1px; position: relative; top: 50%;"></div></div>
            </div>
            <div class="font-12 mt-2"><b>{{ __('messages.Dont you have account?') }}<a href="#" id="switch-to-sign-up">{{ __('messages.Create it') }}</a> {{ __('messages.for free') }}.</b></div>
        <div id="cancel-login-popup"><i class="fa fa-lg fa-close"></i></div>
        </div>
    </div>
</div>

<script>
    $("#log-in").on('click', function(){
        $('#login-popup').css('display', 'block');
    });

    $('#login-form').click(function(event) {
        event.stopPropagation();
    });
    //$('#login-form').click(false);

    $("#login-popup").on('click', function(){
        $('#login-popup').css('display', 'none');
    });

    $("#cancel-login-popup").on('click', function(){
        $('#login-popup').css('display', 'none');
    });

    $("#switch-to-sign-up").on('click', function(){
        $('#registration-popup').css('display', 'block');
        $('#login-popup').css('display', 'none');
    });
</script>