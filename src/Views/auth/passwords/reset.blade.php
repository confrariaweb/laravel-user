@extends('user::auth.layouts.app')

@section('content')
    <h3>Recupere sua senha</h3>
    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="form-group">
            <input id="email" type="email" class="input-text form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus placeholder="Seu E-mail">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <input id="password" type="password" class="input-text form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Sua Senha">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <input id="password-confirm" type="password" class="input-text form-control" name="password_confirmation" required autocomplete="new-password"  placeholder="Confirme Sua Senha">
        </div>
        <div class="form-group">
            <button type="submit" class="btn-md btn-theme btn-block">Redefinir senha</button>
        </div>
    </form>
<p>já tem cadastro?<a href="{{ route('login') }}"> Entre aqui</a></p>
@endsection
