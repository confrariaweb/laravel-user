@extends('user::auth.layouts.app')

@section('content')
    <h3>Seja bem vindo</h3>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group">
            <input id="email" type="email" class="input-text form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="E-mail">
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <input id="password" type="password" class="input-text form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Senha">
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="checkbox clearfix">
            <div class="form-check checkbox-theme">
                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                    {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="rememberMe">
                    Lembre-se de mim
                </label>
            </div>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">Esqueceu a senha</a>
            @endif
        </div>
        <div class="form-group">
            <button type="submit" class="btn-md btn-theme btn-block">Entrar</button>
        </div>
    </form>
    <p>Não tem conta ainda?<a href="{{ route('register') }}"> Cadastre-se aqui</a></p>
@endsection
