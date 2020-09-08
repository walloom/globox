
<x-loading></x-loading>

<form method="post" id="frmPresentation" autocomplete="off">
    {{ method_field( isset($presentation->id)?'PUT':'POST' ) }}
    <input type="hidden" name="id" value="{{ $presentation->id??'' }}">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{ isset($presentation->id)?'Editar':'Nueva' }} presentación</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group ">
                    <label class="form-control-label">Nombre</label>
                    <input type="text" name="name" value="{{ $presentation->name??'' }}" class="form-control" id="name" placeholder="Nombre">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group ">
                    <label class="form-control-label">Descripción</label>
                    <textarea class="form-control" name="description">{{ $presentation->description??'' }}</textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
</form>