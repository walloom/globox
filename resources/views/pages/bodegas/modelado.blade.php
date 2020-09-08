@extends('layouts.app', ['activePage' => 'bodegas', 'titlePage' => 'Panel administrativo'])

@push('js')
<link rel="stylesheet" href="{{ asset('plugins/slickjs/slick.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/slickjs/slick-theme.css') }}">

<link rel="stylesheet" href="{{ asset('plugins/blocks/css/block.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/gridstack@1.1.2/dist/gridstack.min.css" />


@endpush


@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Modelado Bodega</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('bodegas') }}">Bodegas</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('detalleBodega', $bodega->id) }}">Detalle</a></li>
                    <li class="breadcrumb-item active">Modelado</li>
                </ol>
            </div>
        </div>
    </div>
</div>


<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-4">

                <div class="card">
                    <div class="card-header bg-primary">
                        <h3 class="card-title">Parametrización de la badega</h3>
                    </div>
                    <div class="card-body">
                        <form role="form">
                            <div class="custom-cellar">
                                <div class="item-step-cellar">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <h5 class="text-center text-uppercase">Información base</h5>
                                            </div>
                                        </div>                      
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label># Racks / Estandes </label>
                                                <input type="number" class="form-control" name="racks" id="racks" value="3">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Niveles por Rack</label>
                                                <input type="number" class="form-control" name="levels" id="levels" value="3">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label># Secciones / Módulos</label>
                                                <input type="number" class="form-control" name="sections" id="sections" value="3">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item-step-cellar">your content</div>
                                <div class="item-step-cellar">your content</div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <a class="btn btn-app btn-block btn-prev">
                                        <i class="fas fa-angle-left"></i> Atrás
                                    </a>
                                </div>
                                <div class="col-sm-6">
                                    <a class="btn btn-app btn-block btn-next">
                                        <i class="fas fa-angle-right"></i> Siguiente
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

            <div class="col-sm-8">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h3 class="card-title">Previsualización</h3>
                    </div>
                    <div class="card-body p-0 displayBod" id="displayRender" style="height: 600px"></div>

                    {{-- <div class="card-body p-0">
              <div class="bodega2D">
                <div class="background"></div>
                <div class="scene"></div>                
              </div>
            </div> --}}

        {{-- <div class="card-body p-0">
              <div id="container" style="height: 600px"></div>
            </div> --}}
    </div>
</div>     

</div>
<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <a href="{{ route('detalleBodega', $bodega->id) }}" class="btn bg-secondary">
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

<script src="{{ asset('plugins/blocks/jquery.3.1.0.slim.min.js') }}"></script>
<script src="{{ asset('plugins/blocks/jquery.mousewheel.3.1.13.min.js') }}"></script>
<script src="{{ asset('plugins/blocks/jquery.transit.0.9.12.min.js') }}"></script>
<script src="{{ asset('plugins/blocks/block.js') }}"></script>
<script src="{{ asset('plugins/blocks/block.dirt.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/gridstack@1.1.2/dist/gridstack.all.js"></script>

{{-- <script src="{{ asset('js/pages/model2d.js') }}"></script> --}}

<script src="{{ asset('plugins/slickjs/slick.min.js') }}"></script>
<script src="{{ asset('plugins/sweetalert2/sweetalert.min.js') }}"></script>

<script src="{{ asset('js/pages/modelado.js') }}" type="module"></script>
{{-- <script src="{{ asset('js/pages/modelado2.js') }}" type="module"></script> --}}





<script>
$(document).ready(function () {
    $('.custom-cellar').slick({
        arrows: false,
    });

    $(".btn-next").on("click", function (evt) {
        var racks = $("#racks").val().trim();
        if (racks === "") {
            validateRemove();
        } else {
            $('.custom-cellar').slick('slickNext');
            var levels = $("#levels").val().trim();
            var sections = $("#sections").val().trim();

            make.setRacksModels(racks, levels, sections);
        }

    })

    $(".btn-prev").on("click", function (evt) {
        $('.custom-cellar').slick('slickPrev');
    })
});

function validateRemove() {
    // 
    swal({
        title: "Campos obligatorios",
        text: "Todos los campos son necesarios para poder crear tu modega, por favor ingresa la información real antes de continuar con las siguientes configuraciones",
        icon: "error",
        buttons: true,
        buttons: ["Aceptar"],
    });
}


//2D
var grid = GridStack.init({
   
    float: true,
    cellHeight : '40px',
   
});


</script>



@endpush
