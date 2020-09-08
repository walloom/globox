<?php
$action = isset($catalog->id) ? 'empresa/customers/' . $customer_id . '/catalogs/' . $catalog->id : 'empresa/customers/' . $customer_id . '/catalogs';
?>

<form action="{{ url($action) }}" class="" method="POST" enctype="multipart/form-data" autocomplete="off">
    {!! csrf_field() !!}
    {{ method_field( isset($catalog->id)?'PUT':'POST' ) }}
    <input type="hidden" name="id" value="{{ $catalog->id??'' }}">

    <div class="row border-bottom mb-4 pb-4">

        <!--<div class="col-12">
            <h5>Información</h5>
        </div>-->

        <div class="col-12 col-md-6">
            <div class="form-group">
                <label>Nombre</label>
                <input type="text" name="name" value="{{ old('name')?? ($catalog->name??'') }}" class="form-control @error('name') is-invalid @enderror">
                @error('name')
                <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-12 col-md-3">
            <div class="form-group">
                <label>Ean</label>
                <input type="text" name="ean" value="{{ old('ean')?? ($catalog->ean??'') }}" class="form-control @error('ean') is-invalid @enderror">
                @error('ean')
                <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-12 col-md-3">
            <div class="form-group">
                <label>PLU</label>
                <select name="plu" class="form-control">
                    <option value="">Seleccionar</option>
                </select>
                @error('plu')
                <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-12 col-md-3">
            <div class="form-group">
                <label>Talla</label>
                <select name="size_id" class="form-control">
                    <option value="">- Seleccionar -</option>
                    @foreach ($sizes as $size)
                    <option value="{{ $size->id }}" {{ old('size_id') && old('size_id')==$size->id?'selected': (isset($catalog->size_id) && $catalog->size_id == $size->id?'selected':'') }}>
                        {{ $size->code }} - {{ $size->description }}
                    </option>
                    @endforeach
                </select>
                @error('size_id')
                <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-12 col-md-3">
            <div class="form-group">
                <label>Presentación</label>
                <select name="presentation_id" class="form-control">
                    <option value="">Seleccionar</option>
                </select>
                @error('presentation_id')
                <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-12 col-md-3">
            <div class="form-group">
                <label>Color</label>
                <select name="color_id" class="form-control">
                    <option value="">Seleccionar</option>
                </select>
                @error('color_id')
                <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-12 col-md-3">
            <div class="form-group">
                <label>Dimensión</label>
                <input type="text" name="dimension" value="{{ old('dimension')?? ($catalog->dimension??'') }}" class="form-control @error('dimension') is-invalid @enderror">
                @error('dimension')
                <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-12 col-md-3">
            <div class="form-group">
                <label>Clasificación del artículo</label>
                <select name="reference_type_id" class="form-control">
                    <option value="">Seleccionar</option>
                    @foreach($referenceTypes as $referenceType)
                    <option value="{{ $referenceType->id }}" {{ old('reference_type_id') && old('reference_type_id')==$referenceType->id?'selected': (isset($catalog->reference_type_id) && $catalog->reference_type_id == $referenceType->id?'selected':'') }} >
                        {{ $referenceType->code }} - {{ $referenceType->description }}
                    </option>
                    @endforeach
                </select>
                @error('reference_type_id')
                <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-12 col-md-3">
            <div class="form-group">
                <label>Activo</label>
                <select name="active" class="form-control">
                    <option value="1" {{ old('active') && old('active')=='1'?'selected': ( isset($catalog->state) && $catalog->state=='1'?'selected':'' ) }}>Si</option>
                    <option value="0" {{ old('active') && old('active')=='0'?'selected': ( isset($catalog->state) && $catalog->state=='0'?'selected':'' ) }}>No</option>
                </select>
                @error('active')
                <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>
        </div>


    </div> 


    <div class="row border-bottom mb-4 pb-4">

        <!--<div class="col-12">
            <h5>Categorías</h5>
        </div>-->

        <div class="col-12 col-md-3">
            <div class="form-group">
                <label>Categoría</label>
                <select name="catalog_category_id" class="form-control">
                    <option value="">Seleccionar</option>
                </select>
                @error('color_id')
                <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-12 col-md-3">
            <div class="form-group">
                <label>Clase</label>
                <select name="catalog_class_id" class="form-control">
                    <option value="">Seleccionar</option>
                </select>
                @error('color_id')
                <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-12 col-md-3">
            <div class="form-group">
                <label>Tipo</label>
                <select name="catalog_type_id" class="form-control">
                    <option value="">Seleccionar</option>
                </select>
                @error('color_id')
                <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-12 col-md-3">
            <div class="form-group">
                <label>Estandar</label>
                <input type="text" name="standar" value="{{ old('standar')?? ($catalog->standar??'') }}" class="form-control @error('standar') is-invalid @enderror">
                @error('standar')
                <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-12 col-md-3">
            <div class="form-group">
                <label>Costo Estandar</label>
                <input type="text" name="standard_cost" value="{{ old('standard_cost')?? ($catalog->standard_cost??'') }}" class="form-control @error('standard_cost') is-invalid @enderror">
                @error('standard_cost')
                <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-12 col-md-3">
            <div class="form-group">
                <label>Costo última compra</label>
                <input type="text" name="last_cost" value="{{ old('last_cost')?? ($catalog->last_cost??'') }}" class="form-control @error('last_cost') is-invalid @enderror">
                @error('last_cost')
                <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-12 col-md-3">
            <div class="form-group">
                <label>Costo promedio ajustado</label>
                <input type="text" name="average_cost" value="{{ old('average_cost')?? ($catalog->average_cost??'') }}" class="form-control @error('average_cost') is-invalid @enderror">
                @error('average_cost')
                <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-12 col-md-3">
            <div class="form-group">
                <label>Fecha de Apertura</label>
                <input type="text" name="opening_date" value="{{ old('opening_date')?? ($catalog->opening_date??'') }}" class="form-control @error('opening_date') is-invalid @enderror">
                @error('opening_date')
                <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>
        </div>

    </div> 

    <div class="row">

        <!--<div class="col-12">
            <h5>Unidades</h5>
        </div>-->

        <div class="col-12 col-md-3">
            <div class="form-group">
                <label>Unidad de medida uno</label>
                <select name="unit_one_id" class="form-control">
                    <option value="">Seleccionar</option>
                    @foreach($units as $unit)
                    <option value="{{ $unit->id }}" {{ old('unit_one_id') && old('unit_one_id') == $unit->id?'selected': ( isset( $catalog->unit_one_id ) && $catalog->unit_one_id == $unit->id?'selected':'' )  }}>
                        {{ $unit->code }} - {{ $unit->description }}
                    </option>
                    @endforeach
                </select>
                @error('unit_one_id')
                <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-12 col-md-3">
            <div class="form-group">
                <label>Cantidad empaque uno</label>
                <input type="text" name="quantity_unit_one" value="{{ old('quantity_unit_one')?? ($catalog->quantity_unit_one??'') }}" class="form-control @error('quantity_unit_one') is-invalid @enderror">
                @error('quantity_unit_one')
                <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-12 col-md-3">
            <div class="form-group">
                <label>Unidad de medida dos</label>
                <select name="unit_two_id" class="form-control">
                    <option value="">Seleccionar</option>
                    @foreach($units as $unit)
                    <option value="{{ $unit->id }}" {{ old('unit_two_id') && old('unit_two_id') == $unit->id?'selected': ( isset( $catalog->unit_two_id ) && $catalog->unit_two_id == $unit->id?'selected':'' )  }}>
                        {{ $unit->code }} - {{ $unit->description }}
                    </option>
                    @endforeach
                </select>
                @error('unit_two_id')
                <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-12 col-md-3">
            <div class="form-group">
                <label>Cantidad empaque dos</label>
                <input type="text" name="quantity_unit_two" value="{{ old('quantity_unit_two')?? ($catalog->quantity_unit_two??'') }}" class="form-control @error('quantity_unit_two') is-invalid @enderror">
                @error('quantity_unit_two')
                <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-12 col-md-3">
            <div class="form-group">
                <label>Prioridad</label>
                <select name="priority" class="form-control">
                    <option value="">Seleccionar</option>
                    <option value="1" {{ old('priority') && old('priority')=='1' ? 'selected': ( isset($catalog->priority) && $catalog->priority=='1'?'selected':'' ) }}>1</option>
                    <option value="2" {{ old('priority') && old('priority')=='2' ? 'selected': ( isset($catalog->priority) && $catalog->priority=='2'?'selected':'' ) }}>2</option>
                    <option value="3" {{ old('priority') && old('priority')=='3' ? 'selected': ( isset($catalog->priority) && $catalog->priority=='3'?'selected':'' ) }}>3</option>
                </select>
                @error('priority')
                <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-12 col-md-3">
            <div class="form-group">
                <label>Peso</label>
                <input type="text" name="weight" value="{{ old('weight')?? ($catalog->weight??'') }}" class="form-control @error('weight') is-invalid @enderror">
                @error('weight')
                <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-12 col-md-3">
            <div class="form-group">
                <label>Volumen</label>
                <input type="text" name="volume" value="{{ old('volume')?? ($catalog->volume??'') }}" class="form-control @error('volume') is-invalid @enderror">
                @error('volume')
                <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-12 col-md-3">
            <div class="form-group">
                <label>Stock min</label>
                <input type="text" name="stock_min" value="{{ old('stock_min')?? ($catalog->stock_min??'') }}" class="form-control @error('stock_min') is-invalid @enderror">
                @error('stock_min')
                <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-12 col-md-3">
            <div class="form-group">
                <label>Stock max</label>
                <input type="text" name="stock_max" value="{{ old('stock_max')?? ($catalog->stock_max??'') }}" class="form-control @error('stock_max') is-invalid @enderror">
                @error('stock_max')
                <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>
        </div>


    </div>


    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <button type="submit" class="btn bg-primary float-right">
                    <i class="fas fa-save"></i>
                    GUARDAR
                </button>
            </div>
        </div>
    </div>
</form>

@push('css')
<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush

@push('js')
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('js/pages/customers/form.js') }}"></script>
@endpush
