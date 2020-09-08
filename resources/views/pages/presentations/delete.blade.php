
<x-loading></x-loading>

<form method="post" id="frmPresentationDelete" autocomplete="off">
    {{ method_field( isset($presentation->id)?'DELETE':'' ) }}
    <input type="hidden" name="id" value="{{ $presentation->id??'' }}">
    <div class="modal-header">
        <h5 class="modal-title">Eliminar presentación</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <h2 class="card-title text-center p-4">
                    ¿Está seguro que desea eliminar la presentación <strong>{{ $presentation->name }}</strong>?
                </h2>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-danger">Eliminar</button>
    </div>
</form>