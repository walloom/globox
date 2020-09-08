
<x-loading></x-loading>

<form method="post" id="frmUnit" autocomplete="off">
    {{ method_field( isset($unit->id)?'PUT':'POST' ) }}
    <input type="hidden" name="id" value="{{ $unit->id??'' }}">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{ isset($unit->id)?'Editar':'Nueva' }} unidad de medida</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group ">
                    <label class="form-control-label">Código</label>
                    <input type="text" name="code" value="{{ $unit->code??'' }}" class="form-control" id="name" placeholder="Código">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group ">
                    <label class="form-control-label">Descripción</label>
                    <textarea class="form-control" name="description">{{ $unit->description??'' }}</textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
</form>