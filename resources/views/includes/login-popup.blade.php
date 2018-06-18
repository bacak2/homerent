<div id="login-popup" @if(!$errors->isEmpty() && old('auth_attempt') == 'login')style="display: block;" @else style="display: none;"@endif>
    <div id="login-form">
        <div>
            <div class="mb-3" style="font-size: 24px"><b>Zaloguj się</b></div>
            <form class="logowanie" method="POST" action="{{ route('login') }}" style="border-bottom: dashed 1px black">
                {{ csrf_field() }}
                <input type="hidden" name="auth_attempt" value="login">

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <input id="login" type="email" class="form-control" name="email" placeholder="Adres e-mail" value="{{ old('email') }}" required="required" oninvalid="setCustomValidity('Wprowadź poprawny adres email')" oninput="setCustomValidity('')">

                    @if ($errors->has('email') && old('auth_attempt') == 'login')
                        <span class="help-block font-11" style="color: red">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif

                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                    <input id="password" type="password" class="form-control" name="password" placeholder="Hasło" required="required" oninvalid="setCustomValidity('Wypełnij to pole')" oninput="setCustomValidity('')">

                    @if ($errors->has('password') && old('auth_attempt') == 'login')
                        <span class="help-block font-11" style="color: red">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <div class="row font-12">
                        <div class="col-6">
                            <label>
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Zapamiętaj
                            </label>
                        </div>
                        <!--div class="col-6 pull-right" style="text-align: right;"> <a href="{{--route('password.request')--}}">Nie pamiętasz hasła?</a></div-->
                    </div>
                </div>
                <div class="form-group">
                    <input class="btn btn-black" type="submit" id="submit" value="Zaloguj" style="width: 100%">
                </div>

            </form>
            <div class="font-12 mt-2"><b>Nie masz jeszcze konta? <a href="#" id="switch-to-sign-up">{{ __('Załóż je')}}</a> za darmo.</b></div>
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