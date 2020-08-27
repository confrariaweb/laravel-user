@extends('user::auth.layouts.app')

@section('content')
    <h3>Redefinir senha</h3>
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="form-group">
            <input id="email" type="email" class="input-text  form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Seu E-mail">

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <button type="submit" class="btn-md btn-theme btn-block">Enviar link de redefinição</button>
        </div>
    </form>
<p>já tem cadastro?<a href="{{ route('login') }}"> Entre aqui</a></p>
@endsection
