
<x-loading></x-loading>

<form method="post" id="frmRack" autocomplete="off">
    {{ method_field( isset($rack->id)?'PUT':'POST' ) }}
    <input type="hidden" name="id" value="{{ $rack->id??'' }}">
    <input type="hidden" name="bodega_id" value="{{ $bodega_id??'' }}">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{ isset($rack->id)?'Editar':'Nuevo' }} rack {{ $rack->alias }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="row">

            <div class="col-sm-8" id="containerRackPreview">
                @include('pages.racks._sub.preview')
            </div>
            <div class="col-sm-4">
                <div class="form-group ">
                    <label class="form-control-label">Nombre</label>
                    <input type="text" name="name" value="{{ $rack->name??'' }}" class="form-control" placeholder="Nombre">
                </div>
                <div class="form-group ">
                    <label class="form-control-label">Módulos</label>
                    <input type="number" name="modules" value="{{ $rack->modules??'' }}" class="form-control" placeholder="Módulos">
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group ">
                            <label class="form-control-label">Niveles</label>
                            <input type="text" name="levels" value="{{ $rack->levels??'' }}" class="form-control" placeholder="Niveles">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group ">
                            <label class="form-control-label">Toneladas</label>
                            <input type="text" name="tons" value="{{ $rack->tons??'' }}" class="form-control" placeholder="Toneladas">
                        </div>
                    </div>
                </div>
            </div>
            <div id="containerUbication" class="w-100"></div> 
        </div>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
</form>