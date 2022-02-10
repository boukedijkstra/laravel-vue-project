@extends('layouts.app')

@section('content')
<div class="container">
    <div class="block block--small">
        <h1 class="mb-2">Inloggen</h1>
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email Adres" value="{{ old('email') }}" required autocomplete="email" autofocus>

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Wachtwoord" required autocomplete="current-password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

            <label class="form-check-label" for="remember">
                Onthouden
            </label>

            <button type="submit" class="button button--large">
                <i class="fas fa-sign-in-alt"></i> Inloggen
            </button>

{{--            @if (Route::has('password.request'))--}}
{{--                <a class="btn btn-link" href="{{ route('password.request') }}">Wachtwoord vergeten?</a>--}}
{{--            @endif--}}
        </form>
    </div>
</div>
@endsection
