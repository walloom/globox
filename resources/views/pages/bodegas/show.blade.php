@extends('layouts.app', ['activePage' => 'bodegas', 'titlePage' => 'Panel administrativo'])

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Detalle Bodega</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('bodegas') }}">Bodegas</a></li>
                    <li class="breadcrumb-item active">Detalle</li>
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
                <form action="{{ route('updateBodega', $bodega->id ) }}" class="" method="POST" enctype="multipart/form-data">
                    {!! csrf_field() !!}

                    <div class="card">

                        <div class="card-header">
                            <h3 class="card-title">Información de la bodega</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            <div class="float-right"><span class="badge bg-{{ $className }}">{{ $bodega->occupation }}%</span></div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <a class="zone-picture zone-photo" style="background-image: url('{{ asset('storage/companies/'.$bodega->company_id.'/bodegas/'.$bodega->photo) }}')" href="{{ asset('storage/companies/'.$bodega->company_id.'/bodegas/'.$bodega->photo) }}" data-fancybox="gallery"></a>
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
                                            <option value="{{ $departamento->id }}" {{ $departamento->id==$bodega->state_id?'selected':'' }} >{{ $departamento->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Ciudad</label>
                                        <select required class="form-control select2 {{ $errors->has('city') ? ' is-invalid' : '' }}" name="city_id" id="citySelect">
                                            <option selected value="">- Seleccionar -</option>
                                            @foreach ($cities as $city)
                                            <option value="{{ $city->id }}" {{ $city->id==$bodega->city_id?'selected':'' }}>
                                                {{ $city->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Dirección</label>
                                        <input type="text" required name="address" value="{{ $bodega->address }}" class="form-control {{ $errors->has('address') ? ' is-invalid' : '' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Nombre</label>
                                        <input type="text" required autocomplete="off" name="name" value="{{ $bodega->name }}" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Ocupación</label>
                                        <input type="number" step="0.1" required autocomplete="off" name="occupation" value="{{ $bodega->occupation }}" class="form-control {{ $errors->has('occupation') ? ' is-invalid' : '' }}">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Teléfono</label>
                                        <input type="number" required autocomplete="off" name="telephone" value="{{ $bodega->telephone }}" class="form-control {{ $errors->has('telephone') ? ' is-invalid' : '' }}">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Responsable / Contacto</label>
                                        <input type="text" required autocomplete="off" name="responsable" value="{{ $bodega->responsable }}" class="form-control {{ $errors->has('responsable') ? ' is-invalid' : '' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Notas</label>
                                        <textarea class="form-control  {{ $errors->has('notes') ? ' is-invalid' : '' }}" required rows="3" name="notes">{{ $bodega->notes }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <a href="{{ route('destroyBodega', $bodega->id) }}" class="btn bg-danger btn-confirm">
                                <i class="fas fa-trash"></i>
                                ELIMINAR BODEGA
                            </a>
                            <button type="submit" class="btn bg-primary">
                                <i class="fas fa-sync-alt"></i>
                                ACTUALIZAR BODEGA
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Modelado de la bodega</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <a href="{{ asset('img/bodegas/model.png') }}" data-fancybox="gallery">
                            <img src="{{ asset('img/bodegas/model.png') }}" class="img-fluid">
                        </a>
                    </div>
                    <div class="card-footer text-center">
                        <div class="row">
                            <div class="col-6">
                                <a class="btn bg-primary" href="{{ route('modeladoBodega', $bodega->id) }}">EDITAR EL MODELADO >></a>
                            </div>
                            <div class="col-6">
                                <a class="btn bg-primary" href="{{ url('empresa/bodegas/'.$bodega->id.'/sections') }}">EDITAR MODELADO 2D >></a>
                            </div>
                        </div> 
                    </div>
                </div>

            </div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Productos recientemente ingresados</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <ul class="products-list product-list-in-card pl-2 pr-2">
                            <li class="item">
                                <div class="product-img">
                                    <img src="{{ asset('img/default-150x150.png') }}" alt="Product Image" class="img-size-50">
                                </div>
                                <div class="product-info">
                                    <a href="javascript:void(0)" class="product-title">Samsung TV
                                        <span class="badge badge-warning float-right">$1800</span></a>
                                    <span class="product-description">
                                        Samsung 32" 1080p 60Hz LED Smart HDTV.
                                    </span>
                                </div>
                            </li>
                            <li class="item">
                                <div class="product-img">
                                    <img src="{{ asset('img/default-150x150.png') }}" alt="Product Image" class="img-size-50">
                                </div>
                                <div class="product-info">
                                    <a href="javascript:void(0)" class="product-title">Bicycle
                                        <span class="badge badge-info float-right">$700</span></a>
                                    <span class="product-description">
                                        26" Mongoose Dolomite Men's 7-speed, Navy Blue.
                                    </span>
                                </div>
                            </li>
                            <li class="item">
                                <div class="product-img">
                                    <img src="{{ asset('img/default-150x150.png') }}" alt="Product Image" class="img-size-50">
                                </div>
                                <div class="product-info">
                                    <a href="javascript:void(0)" class="product-title">
                                        Xbox One <span class="badge badge-danger float-right">
                                            $350
                                        </span>
                                    </a>
                                    <span class="product-description">
                                        Xbox One Console Bundle with Halo Master Chief Collection.
                                    </span>
                                </div>
                            </li>
                            <li class="item">
                                <div class="product-img">
                                    <img src="{{ asset('img/default-150x150.png') }}" alt="Product Image" class="img-size-50">
                                </div>
                                <div class="product-info">
                                    <a href="javascript:void(0)" class="product-title">PlayStation 4
                                        <span class="badge badge-success float-right">$399</span></a>
                                    <span class="product-description">
                                        PlayStation 4 500GB Console (PS4)
                                    </span>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="card-footer text-center">
                        <a class="btn bg-primary" href="javascript:void(0)" class="uppercase">VER TODOS LOS PRODUCTOS >></a>
                    </div>
                </div>
                <div class="info-box mb-3 bg-warning">
                    <span class="info-box-icon"><i class="fas fa-tag"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Inventario en tiempo real</span>
                        <span class="info-box-number">{{ $bodega->occupation }}%</span>
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
<link rel="stylesheet" href="{{ asset('plugins/fancybox/jquery.fancybox.min.css') }}" />
<script src="{{ asset('plugins/fancybox/jquery.fancybox.min.js') }}"></script>

<script src="{{ asset('plugins/sweetalert2/sweetalert.min.js') }}"></script>

<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

<script>
var pathRemove = "";

$(function () {
    $('.select2').select2()
    let state = $("#stateSelect").val();
    let city = $("#preloadCity").val();
    /*make.preloadCity(state, city);*/

    $(".btn-confirm").on("click", function (evt) {
        evt.preventDefault();
        pathRemove = $(this).attr("href");
        validateRemove();
    });
})

function validateRemove() {
    // 
    swal({
        title: "Eliminar Bodega",
        text: "Estas a punto de ELIMINAR una bodega completa, este proceso es irreversible ¿estas seguro de realizar esta acción?",
        icon: "error",
        buttons: true,
        dangerMode: true,
        buttons: ["No, Cancelar", "Si, Eliminar!"],

    })
            .then((willDelete) => {
                if (willDelete) {
                    window.location.href = pathRemove;
                } else {
                }
            });

    // Swal.fire({
    //   title: '<strong>Eliminar Bodega</strong>',
    //   icon: 'error',
    //   html: 'Estas a punto de <b>ELIMINAR</b> una bodega completa, este proceso es irreversible ¿estas seguro de realizar esta acción?',
    //   showCloseButton: true,
    //   showCancelButton: true,
    //   focusConfirm: false,
    //   confirmButtonText: '<i class="fa fa-trash"></i> Si, Eliminar',
    //   confirmButtonAriaLabel: 'Thumbs up, great!',
    //   cancelButtonText: '<i class="fa fa-times-circle"></i> No, Cancelar!',
    //   cancelButtonAriaLabel: 'Thumbs down',
    //   confirmButtonColor: '#d33',
    //   cancelButtonColor: '#545b62',
    // });
}

</script>
@endpush
