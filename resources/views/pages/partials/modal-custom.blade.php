<div class="divPrev"></div>
<div class="modal fade modal-globox" id="designModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="cuponModalLabel" aria-hidden="true">

  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <div class="container-fluid">
          @if (Auth::user()->company)
            <div class="row">
              <div class="col-sm-12">
                <img class="logo-modal" src="{{  asset('storage/companies/') }}/{{ Auth::user()->company->id }}/{{ Auth::user()->company->logo }}" alt="">
              </div>
            </div>
          @else
            <div class="row">
              <div class="col-sm-2">
                <h5 class="modal-title" id="cuponModalLabel">GLOBOX</h5>
              </div>
              <div class="col-sm-10">
                <p class="clear m-top text-center">
                  <strong>¡Hola {{ Auth::user()->name }},</strong> te damos la bienvenida !
                  <input type="hidden" id="settingCompany" value="{{ Auth::user()->company->id ?? "" }}">
                </p>
              </div>
            </div>          
          @endif
        </div>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-12">
            <p class="clear m-top text-center">Puedes <strong>personilizar tu marca</strong> ahora mismo y disfrutar de todas las funcionalidades que tenemos para ti, <br>o puedes omitir este paso haciendo clic en el botón "MAS TARDE".</p>
            <br><br>
          </div>
        </div>
        <form action="" id="formCustom">
          <div class="row">
            <div class="col-sm-4">
              <input type="hidden" id="pathSettings" value="{{ route('saveSetting') }}">
              <div class="zone-picture small zone-photo">
                  <input type="hidden" class="base64File" name="image" value="">
                @if (Auth::user()->company)
                  <img class="logo-modal" src="{{  asset('storage/companies/') }}/{{ Auth::user()->company->id }}/{{ Auth::user()->company->logo }}" alt="">
                @else
                  <p class="triggerFile" data-file=".fileEvt">Logo de la empresa</p>
                @endif
              </div>
              <div class="custom-file">
                <input type="file" class="fileEvt custom-file-input" accept="image/x-png,image/jpeg" name="photo" class="form-control">
                <label class="custom-file-label" for="customFile">Logo de la empresa</label>
              </div>            
            </div>    
            <div class="col-md-8">
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Empresa:</label>
                    <input type="text" required name="name" id="name" value="{{ Auth::user()->company->name ?? Auth::user()->name }}" class="form-control">
                  </div>                  
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Sector:</label>
                    <input type="text" required name="sector" id="sector" value="{{ Auth::user()->company->sector ?? "" }}" class="form-control">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Representante:</label>
                    <input type="text" required name="responsibility" value="{{ Auth::user()->company->responsibility ?? "" }}" id="responsibility" class="form-control">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Teléfono:</label>
                    <input type="number" required name="telephone" value="{{ Auth::user()->company->telephone ?? "" }}" id="telephone" class="form-control">
                  </div>
                </div>
              </div>
            </div>        
          </div>
          <div class="row">
            <div class="col-sm-3">
              <div class="form-group">
                <label>Principal:</label>
                <div class="input-group primary-color">
                  <input type="text" name="primary" id="primary" value="{{ Auth::user()->company->primary ?? "" }}" class="form-control">
                  <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-square"></i></span>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group">
                <label>Texto principal:</label>
                <div class="input-group primary-color-text">
                  <input type="text" name="primary_text" id="primary_text" value="{{ Auth::user()->company->primary_text ?? "" }}" class="form-control">
                  <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-square"></i></span>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group">
                <label>Secundario:</label>
                <div class="input-group secondary-color">
                  <input type="text" name="secondary" id="secondary" value="{{ Auth::user()->company->secondary ?? "" }}" class="form-control">
                  <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-square"></i></span>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group">
                <label>Texto secundario:</label>
                <div class="input-group secondary-color-text">
                  <input type="text" name="secondary_text" id="secondary_text" value="{{ Auth::user()->company->secondary_text ?? "" }}" class="form-control">
                  <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-square"></i></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label>Notas:</label>
                <textarea class="form-control" id="notes" name="notes" required>{{ Auth::user()->company->notes ?? "" }}</textarea>
              </div>
            </div>
          </div>
        </form>
        <div class="row">
          <div class="col-md-12 text-center">
            <br>
            <button type="button" id="btnPrevCustom" class="btn bg-primary">PREVISUALIZAR</button>
            <button type="button" id="btnSaveSetting" class="btn btn-danger">GUARDAR</button>
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
                <button type="button" data-dismiss="modal" aria-label="Close" style="margin-top: -8px;" class="btn btn-danger">MAS TARDE</button>
              </div>              
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
