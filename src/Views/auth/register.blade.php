@extends('user::auth.layouts.app')

@section('content')
    <h3>Vamos começar?</h3>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-group">
            <input id="name" type="text" class="input-text form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Seu Nome">
            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <input id="email" type="email" class="input-text form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Seu Email">
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <input id="password" type="password" class="input-text form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Senha">
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <input id="password-confirm" type="password" class="input-text form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirme a Senha">
        </div>
        <div class="checkbox clearfix">
            <div class="form-check checkbox-theme">
                <input class="form-check-input" type="checkbox" value="" id="termsOfService" required>
                <label class="form-check-label" for="termsOfService">
                    Eu concordo com o<a href="{{ route('home') }}" class="terms">termos de serviço</a>
                </label>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn-md btn-theme btn-block">Cadastrar</button>
        </div>
    </form>
    <p>já tem cadastro? <a href="{{ route('login') }}">Entre aqui</a></p>
@endsection
