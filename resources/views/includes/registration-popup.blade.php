<div id="registration-popup" @if(!$errors->isEmpty() && old('auth_attempt') == 'register')style="display: block;" @else style="display: none;"@endif>
    <div id="registration-form">
        <div>
            <div class="mb-3" style="font-size: 24px"><b>Zarejestruj się</b></div>
            <form class="logowanie" method="POST" action="{{ route('register') }}" style="border-bottom: dashed 1px black">
                {{ csrf_field() }}
                <input type="hidden" name="auth_attempt" value="register">

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <input id="login" type="text" class="form-control" name="name" placeholder="Imię" value="{{ old('name') }}" required="required" oninvalid="setCustomValidity('Wypełnij to pole')" oninput="setCustomValidity('')">

                    @if ($errors->has('name') && old('auth_attempt') == 'register')
                        <span class="help-block font-11" style="color: red">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('surname') ? ' has-error' : '' }}">
                    <input id="login" type="text" class="form-control" name="surname" placeholder="Nazwisko" value="{{ old('surname') }}" required="required" oninvalid="setCustomValidity('Wypełnij to pole')" oninput="setCustomValidity('')">

                    @if ($errors->has('surname') && old('auth_attempt') == 'register')
                        <span class="help-block font-11" style="color: red">
                            <strong>{{ $errors->first('surname') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <input id="login" type="email" class="form-control" name="email" placeholder="Adres e-mail" value="{{ old('email') }}" required="required" oninvalid="setCustomValidity('Wprowadź poprawny adres email')" oninput="setCustomValidity('')">
                    @if ($errors->has('email') && old('auth_attempt') == 'register')
                        <span class="help-block font-11" style="color: red">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <input id="password" type="password" class="form-control" name="password" placeholder="Hasło" required="required" oninvalid="setCustomValidity('Wypełnij to pole')" oninput="setCustomValidity('')">
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                    <input id="repeat-password" type="password" class="form-control" name="password_confirmation" placeholder="Powtórz hasło" required="required" oninvalid="setCustomValidity('Wypełnij to pole')" oninput="setCustomValidity('')">
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
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} required="required" oninvalid="setCustomValidity('Zaakceptuj regulamin')" oninput="setCustomValidity('')">
                                {{ __('Akceptuję') }} <a href="/regulations" target="blank">regulamin</a> serwisu Homent
                            </label>
                        </div>
                    <!--div class="col-6 pull-right" style="text-align: right;"> <a href="{{--route('password.request')--}}">Nie pamiętasz hasła?</a></div-->
                    </div>
                </div>
                <div class="form-group">
                    <input class="btn btn-black" type="submit" id="submit" value="Zarejestruj" style="width: 100%">
                </div>

            </form>
            <div class="font-12 mt-2"><b>Masz już konto? <a href="#" id="switch-to-log-in">{{ __('Zaloguj się')}}</a></b></div>
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