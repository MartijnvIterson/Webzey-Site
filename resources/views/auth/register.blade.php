@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-0">
            <div class="card" style="width: 300px">
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div style="text-align: center">
                            <img src="{{ asset('img/inlog-logo.png') }}" width="150px">
                            <br><br>
                            <h6><b>Registreren</b></h6>
                            <p>Voer je gegevens hieronder in</p>
                            <input placeholder="Naam" id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                            <br>
                            <input placeholder="Email" id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                            <br>
                            <input placeholder="Wachtwoord" id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                            <br>
                            <input placeholder="Wachtwoord" id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            <br>
                            <button type="submit" class="btn btn-primary" style="width: 250px">
                                {{ __('Registreer') }}
                            </button>
                            <br><br>
                        </div>
                    </form>
                    <button onclick="location.href='{{ route('login') }}';" class="btn btn-primary" style="width: 250px">
                        {{ __('Inloggen') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
