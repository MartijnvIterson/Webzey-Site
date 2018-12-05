@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-0">
            <div class="card" style="width: 300px">
                <div class="card-body" style="text-align: center">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div style="text-align: center">
                            <img src="{{ asset('img/inlog-logo.png') }}" width="150px">
                            <br><br>
                            <h6><b>Inloggen</b></h6>
                            <p>Voer je gegevens hieronder in</p>
                            <input id="email" placeholder="Email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" width="150px" required autofocus>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                            <br>
                            <input id="password" placeholder="Wachtwoord" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" width="150px" required>

                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                            <br>
                            <button type="submit" class="btn btn-primary" style="width: 250px">
                                {{ __('Login') }}
                            </button>
                            <br><br>

                        </div>
                    </form>
                    <button onclick="location.href='{{ route('register') }}';" class="btn btn-primary" style="width: 250px">
                        {{ __('Registreren') }}
                    </button>
                    <br>
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
