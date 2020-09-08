<?php ?>
<div class="col-sm-12">
    <h5 class="h6">Detalle de la ubicación : <span id="txtPos" class="font-weight-bold">{{ $ubication->code??'' }}</span> </h5>
</div>
<div class="col-sm-7">
    <div class="row">
        <div class="col-6">
            <div class="form-group mb-0">
                <label class="form-control-label">Largo: {{ $ubication->x }} mts</label>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group mb-0">
                <label class="form-control-label">Alto: {{ $ubication->y }} mts</label>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group mb-0">
                <label class="form-control-label">Ancho: {{ $ubication->z }} mts</label>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group mb-0">
                <label class="form-control-label">Capacidad: {{ $ubication->kg }} kg</label>
            </div>
        </div>
        <div class="col-12">
            @if($ubication->available)
            <button type="button" class="btn btn-danger btn-sm" data-click="avalible" data-status="0" data-bodega="{{ $bodega_id }}" data-rack="{{ $rack_id }}" data-id="{{ $ubication->id }}">
                Marcar como Ocupada
            </button>
            @else
            <button type="button" class="btn btn-success btn-sm" data-click="avalible" data-status="1" data-bodega="{{ $bodega_id }}" data-rack="{{ $rack_id }}" data-id="{{ $ubication->id }}">
                Marcar como Disponible
            </button>
            @endif
        </div>
    </div>
</div>