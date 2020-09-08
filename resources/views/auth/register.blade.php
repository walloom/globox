@extends('layouts.app')

@section('content')
  <!-- Modal -->
  <div class="modal fade modal-globox" id="cuponModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="cuponModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="cuponModalLabel">GLOBOX</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <br><br>
          <p class="login-logo">GLOBOX</p>
          <br>
          <p class="text-center">Siempre será chévere verte feliz. Si tienes un código promocional, úsalo a continuación</p>
          <div class="inputCode">
            <input type="text">
            <div class="remove"><i class="fas fa-times"></i></div>
          </div>
          <div class="text-center">
            <button type="button" class="btn btn-danger">VALIDAR</button>
          </div>
          <br><br><br>
        </div>
        <div class="modal-footer">
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-8">
                Conoce los maravillos planes que tenemos para ti.
              </div>
              <div class="col-sm-4">
                <a href="#" class="linkGray">VER PLANES</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="leftZone">
    <div class="displayLogReg">
      <div class="text-center">
        <p class="login-logo">GLOBOX</p>
        <p>
          ¡ crea tu cuenta gratis !
        </p>
        <strong>Prueba todo nuestro sistema por 30 días</strong>
        <br>
      </div>
      
      <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="input-group mb-3">
          <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Ingresa tu correo" required autocomplete="email" autofocus>
          @error('email')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
        </div>

        <div class="input-group mb-3">
          <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Crea tu clave" name="password" required autocomplete="new-password">
          <div class="icoPass" data-target="password"><i class="fas fa-eye"></i></div>
          @error('password')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>

        <div class="input-group mb-3">
          <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirmar tu clave" required autocomplete="new-password">
          <div class="icoPass" data-target="password-confirm"><i class="fas fa-eye"></i></div>
        </div>

        <div class="input-group mb-3">
          <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Nombre de tu negocio" required autocomplete="name">
          @error('name')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
        <div class="input-group mb-3">
          <select required autocomplete="off" name="country" class="form-control select2 @error('country') is-invalid @enderror" style="width: 100%;">
            <option selected value="">-Seleccionar-</option>
            @foreach ($countries as $country)
              <option value="{{ $country->id }}">{{ $country->name }}</option>
            @endforeach
          </select>
          @error('country')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
        
        
        <strong class="light link" data-toggle="modal" data-target="#cuponModal">¿Tienes un código promocional?</strong>
        <br>
        <div class="input-group mb-3">
          <button type="submit" class="btn btn-globox btn-block">
            CREAR TU CUENTA
          </button>
        </div>
        <p class="small">
          Al crear tu cuenta aceptas nuestros <strong>Términos y condiciones</strong> y 
          <strong>Politica de Tratamiento de Datos</strong>
        </p>
        <div class="lineSeparator"></div>
        <p class="small text-center">
          ¿Ya tienes una cuenta? <a href="{{ route('login') }}">INGRESAR</a>
        </p>
      </form>
    </div>
  </div>
  <div class="rightZone"></div>
  
@endsection


@push('js')

  <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
  <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>


  <script>
    $(document).ready(function(evt){
      $('.select2').select2();

      $(".icoPass").on("click", function(evt){
        let t = $(this).data("target")
        let field = $("#" + t);
        let type = field.attr("type");
        if (type === "password"){
          field.attr("type", "text");
        }else{
          field.attr("type", "password");
        }
      })

      $(".inputCode input").on("keyup", function(evt){
        $val = $(this).val();
        if ( $val.trim() !== ""){
          $(".inputCode .remove").css({"display": "block", "opacity": "1"});
        }else{
          $(".inputCode .remove").css({"display": "none", "opacity": "0"});
        }
      });
      $(".inputCode .remove").on("click", function(evt){
        $(".inputCode input").val("");
        $(".inputCode .remove").css({"display": "none", "opacity": "0"});
      })

    });
  </script>
  
@endpush

