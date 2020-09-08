<div class="modal fade modal-globox" id="profileModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="cuponModalLabel" aria-hidden="true">
  <a href="{{ route('chat') }}" class="icoChat">
    <img src="{{ asset('img/chat@3x.png') }}">
  </a>
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-2">
              <h5 class="modal-title" id="cuponModalLabel">GLOBOX</h5>
            </div>
            <div class="col-sm-10">
              <p class="clear m-top text-center"><strong>¡Hola {{ Auth::user()->name }},</strong> te damos la bienvenida !</p>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-body">
        <div class="form-group row">
          <label for="profesion" class="col-sm-4 col-form-label text-right">A qué te dedicas:</label>
          <div class="col-sm-6">
            <input name="profesion" type="text" class="form-control">
          </div>
        </div>
        <div class="form-group row">
          <label for="profesion" class="col-sm-4 col-form-label text-right">Sector:</label>
          <div class="col-sm-6">
            <input name="profesion" type="text" class="form-control">
          </div>
        </div>
        <div class="form-group row">
          <label for="profesion" class="col-sm-4 col-form-label text-right">Municipio:</label>
          <div class="col-sm-6">
            <input name="profesion" type="text" class="form-control">
          </div>
        </div>
        <div class="form-group row">
          <label for="profesion" class="col-sm-4 col-form-label text-right">Teléfono:</label>
          <div class="col-sm-6">
            <input name="profesion" type="text" class="form-control">
          </div>
        </div>
        <div class="form-group row">
          <label for="profesion" class="col-sm-4 col-form-label text-right">Responsabilidad:</label>
          <div class="col-sm-6">
            <input name="profesion" type="text" class="form-control">
          </div>
        </div>
        <br>
      </div>
      <div class="modal-footer">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-8">
              Puedes actualizar los datos de tu empresa en cualquier momento
            </div>
            <div class="col-sm-4">
              <div class="float-right-abs">
                <button type="button" style="margin-top: -8px;" class="btn btn-danger">SIGUIENTE</button>
              </div>              
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>