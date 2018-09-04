@extends('layout.layout')

@section('content')
    <div class="form-logowanie container">
        <div class="log">
            <h2 style="padding-bottom: 10px;">Zaloguj się</h2>
            <center><div class="fb-login-button" data-width="278px" data-max-rows="1" data-size="large" data-button-type="login_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="false" scope="public_profile,email" onlogin="checkLoginState();"></div></center>
            <p class="form">Nie publikujemy na tablicy bez Twojej zgody</p>
            <p class="form">Logując się przez Facebooka otrzymujesz <b>5% zniżki</b> na pierwszą rezerwację</p>

            <form class="logowanie" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email">Login</label>
                    <input id="login" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                    @if ($errors->has('email'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                    @endif

                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="col-md-4 control-label">Hasło</label>
                    <input id="password" type="password" class="form-control" name="password" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                    @endif
                </div>
                <input type="submit" id="submit" value="Zaloguj">
            </form><br><br>
            <a href="{{ route('password.request') }}">
                Zapomniałem hasła
            </a>
        </div>
    </div>
@endsection


