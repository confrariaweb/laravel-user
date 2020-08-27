@extends('user::auth.layouts.app')

@section('content')
    <h3>Confirme a Senha</h3>
    {{ __('Please confirm your password before continuing.') }}
    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf
        <div class="form-group">
            <input id="password" type="password" class="input-text form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Seu E-mail">

            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="checkbox clearfix">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">Esqueceu a senha</a>
            @endif
        </div>
        <div class="form-group">
            <button type="submit" class="btn-md btn-theme btn-block">Confirme a Senha</button>
        </div>
    </form>
    <p>já tem cadastro?<a href="{{ route('login') }}"> Entre aqui</a></p>
@endsection
