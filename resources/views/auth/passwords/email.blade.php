@extends('layouts.app')

@section('content')
  <div class="leftZone">
    <div class="displayLogReg">
      <div class="text-center">
        <p class="login-logo">GLOBOX</p>
        <p>
          {{ __('Reset Password') }}
        </p>
        <strong>Te enviaremos un link para reestablecer tu contraseña</strong>
        <br>
        @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div>
        @endif
        <form method="POST" action="{{ route('password.email') }}">
          @csrf

          <div class="form-group">
            <input id="email" type="email" placeholder="Correo electrónico" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            @error('email')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <div class="form-group mb-0">
            <button type="submit" class="btn btn-globox btn-block">
              Enviarme Link
            </button>
          </div>
          <div class="lineSeparator"></div>
          <p class="small text-center">
            ¿Recordaste tus datos de acceso? <br>Puedes regresar al ingreso haciendo clic<a href="{{ route('login') }}"> AQUÍ</a>
          </p>
          
        </form>

      </div>
    </div>
  </div>
  <div class="rightZone"></div>
@endsection
