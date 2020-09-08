@extends('layouts.app', ['activePage' => 'bodegas', 'titlePage' => 'Panel administrativo'])

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Crear Bodega</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('bodegas') }}">Bodegas</a></li>
                    <li class="breadcrumb-item active">Nueva</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @include('pages.partials.messages')
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Información base bodega</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('empresa/bodegas/guardar') }}" class="" method="POST" id="formSaveReferral" enctype="multipart/form-data">
                            {!! csrf_field() !!}
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="zone-picture zone-photo"></div>
                                        <div class="custom-file">
                                            <input type="file" class="fileEvt custom-file-input" accept="image/x-png,image/gif,image/jpeg" name="photo" class="form-control">
                                            <label class="custom-file-label" for="customFile">Foto de la bodega</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Departamento</label>
                                        <select required class="form-control select2 {{ $errors->has('state') ? ' is-invalid' : '' }}" name="state_id" id="stateSelect">
                                            <option selected>- Seleccionar -</option>
                                            @foreach ($departamentos as $departamento)
                                            <option value="{{ $departamento->id }}">{{ $departamento->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Ciudad</label>
                                        <select required class="form-control select2 {{ $errors->has('city') ? ' is-invalid' : '' }}" name="city_id" id="citySelect">
                                            <option selected value="">- Seleccionar -</option>
                                            @foreach ($cities as $city)
                                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Dirección</label>
                                        <input type="text" required autocomplete="off" name="address" value="{{ old('address') }}" class="form-control {{ $errors->has('address') ? ' is-invalid' : '' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Nombre</label>
                                        <input type="text" required autocomplete="off" name="name" value="{{ old('name') }}" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Ocupación</label>
                                        <input type="number" step="0.1" required autocomplete="off" name="occupation" value="{{ old('occupation') }}" class="form-control {{ $errors->has('occupation') ? ' is-invalid' : '' }}">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Teléfono</label>
                                        <input type="number" required autocomplete="off" name="telephone" value="{{ old('telephone') }}" class="form-control {{ $errors->has('telephone') ? ' is-invalid' : '' }}">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Responsable / Contacto</label>
                                        <input type="text" required autocomplete="off" name="responsable" value="{{ old('responsable') }}" class="form-control {{ $errors->has('responsable') ? ' is-invalid' : '' }}">
                                    </div>
                                </div>
                            </div>                
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Notas</label>
                                        <textarea class="form-control  {{ $errors->has('notes') ? ' is-invalid' : '' }}" required rows="3" name="notes">{{ old('notes') }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn bg-primary float-right">
                                            <i class="fas fa-save"></i>
                                            AGREGAR BODEGA
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <a href="{{ route('bodegas') }}" class="btn bg-secondary">
                        <i class="fas fa-angle-left"></i>
                        REGRESAR
                    </a>
                </div>          
            </div>
        </div>
    </div>
</div>

@endsection


@push('js')
<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

<script>
$(function () {
    $('.select2').select2();
    $(".fileEvt").change(function () {
        readURL(this);
    });
});


function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = (e) => {
            $zBase = $(".zone-photo");
            $zBase.css("background-image", 'url(' + e.target.result + ')');
            $zBase.addClass("active");
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush

