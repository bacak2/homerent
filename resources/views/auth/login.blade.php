@extends('layout.layout')

@section('title', __('messages.Log in'))

@section('content')
    <div class="form-logowanie container">
        <div class="log">
            <h2 style="padding-bottom: 10px;">{{ __('messages.Log in') }}</h2>
            <center><div class="fb-login-button" data-width="278px" data-max-rows="1" data-size="large" data-button-type="login_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="false" scope="public_profile,email" onlogin="checkLoginState();"></div></center>
            <p class="form">{{ __('messages.logMessage1') }}</p>
            <p class="form">{{ __('messages.logMessage2') }} <b>{{ __('messages.logMessage3') }}</b></p>

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
                    <label for="password">{{ __('messages.Password') }}</label>
                    <input id="password" type="password" class="form-control" name="password" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                    @endif
                </div>
                <input type="submit" id="submit" value="{{ __('messages.Log in') }}">
            </form><br><br>
            <a href="{{ route('password.request') }}">
                {{ __('messages.I forgot my password') }}
            </a>
        </div>
    </div>
@endsection


