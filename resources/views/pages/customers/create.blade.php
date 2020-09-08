@extends('layouts.app', ['activePage' => 'customers', 'titlePage' => 'Panel administrativo'])

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Crear cliente</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('home') }}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('empresa/customers') }}">Customers</a></li>
                    <li class="breadcrumb-item active">Nuevo</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
               
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Información del cliente</h3>
                    </div>
                    <div class="card-body">
                         @include('pages.customers.form')
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <a href="{{ url('empresa/customers') }}" class="btn bg-secondary">
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

@endpush

