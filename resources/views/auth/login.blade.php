@extends('layouts.login')

@section('content')
  <div class="leftZone">
    <div class="displayLogReg">
      <div class="text-center">
        <p class="login-logo">GLOBOX</p>
        <p>
          ¡ ingresa con tu cuenta !
        </p>
        <strong>Prueba todo nuestro sistema por 30 días</strong>
        <br>
      </div>
      
      <form method="POST" action="{{ route('login') }}" autocomplete="false">
        @csrf

        <div class="input-group mb-3">
          <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required placeholder="Correo electrónico" autofocus autocomplete="false">
          @error('email')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>

        <div class="input-group mb-3">
          <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="Contraseña" autocomplete="false">
          @error('password')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror              
        </div>              
      
        <div class="form-group row">
          {{-- <div class="col-md-6">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
              <label class="form-check-label" for="remember">
                  {{ __('Remember Me') }}
              </label>
            </div>
          </div> --}}
          <div class="col-md-12">
            <button type="submit" class="btn btn-globox btn-block">
              INGRESAR
            </button>
            @if (Route::has('password.request'))
              <p class="small text-right" style="margin: 5px;"><a href="{{ route('password.request') }}">¿Perdiste tu contraseña?</a></p>            
            @endif
          </div>

          <div class="lineSeparator"></div>
          <p class="small text-center">
            ¿No tienes una cuenta aún? <br>Puees crear una haciendo click<a href="{{ route('register') }}"> AQUÍ</a>
          </p>
        </div>

      </form>
    </div>
  </div>
  <div class="rightZone"></div>
@endsection
