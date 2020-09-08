@extends('layouts.app')

@section('content')
  <div class="leftZone">
    <div class="displayLogReg">
      <div class="text-center">
        <p class="login-logo">GLOBOX</p>
        <p>
          ¡ Reestablece tu contraseña !
        </p>
        <strong>Recuerda que tu seguridad es nuestra prioridad, por eso este enlace expirará pronto</strong>
        <br>
      </div>
      <form method="POST" action="{{ route('password.update') }}">
          @csrf
          <input type="hidden" name="token" value="{{ $token }}">

          <div class="form-group">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

            @error('email')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <div class="form-group">
            <input id="password" placeholder="Nueva contraseña" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

            @error('password')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <div class="form-group">
            <input id="password-confirm" placeholder="Confirmar contraseña" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
          </div>

          <div class="form-group">
            <button type="submit" class="btn btn-globox btn-block">
              Reestablecer Contraseña
            </button>
          </div>
      </form>
    </div>
  </div>
  <div class="rightZone"></div>
@endsection
