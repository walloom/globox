@extends('layouts.app', ['activePage' => 'bodegas', 'titlePage' => 'Panel administrativo'])

@push('css')
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
            <div class="col-sm-12">
                <div class="card mb-5">
                    <div class="card-header bg-primary">
                        <h3 class="card-title">Modelado 2D</h3>
                    </div>
                    <div class="card-body ">
                        <div class="row mb-4">
                            <div class="col-12 border-bottom pb-3">
                                <div class="newWidget grid-stack-item d-inline-block" data-bodega="{{ $bodega->id }}" data-type="rack" style="width: 12.5%" data-gs-width="2">
                                    <div class="grid-stack-item-content bg-success" style="min-height: 40px">
                                        <span data-rack="alias">Agregar Rack</span>
                                        <small data-rack="name"></small>
                                    </div>
                                </div>

                                <div class="newWidget grid-stack-item d-inline-block" data-bodega="{{ $bodega->id }}" data-type="separator" style="width: 12.5%" data-gs-width="2">
                                    <div class="grid-stack-item-content" style="min-height: 40px">
                                        <span data-rack="alias">Agregar pasillo</span>
                                        <small data-rack="name"></small>
                                    </div>
                                </div>

                                <div class="newWidget grid-stack-item d-inline-block" data-bodega="{{ $bodega->id }}" data-type="door" style="width: 12.5%" data-gs-width="2">
                                    <div class="grid-stack-item-content" style="min-height: 40px">
                                        <span data-rack="alias">Puerta</span>
                                        <small data-rack="name"></small>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="grid-stack-widget" id="sectionWidget">
                            @include('pages.sections._sub.sections')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('jsbefore')

@endpush

@push('js')
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/gridstack@1.1.2/dist/gridstack.all.js"></script>
<script type="text/javascript" src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/pages/sections/index.js?v='.config('app.version')) }}"></script>
<script type="text/javascript" src="{{ asset('js/pages/racks/index.js?v='.config('app.version')) }}"></script>
@endpush
