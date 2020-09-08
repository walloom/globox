<?php

use App\Helpers\Files;
?>

@extends('layouts.app', ['activePage' => 'customers', 'titlePage' => 'Panel administrativo'])

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Catálogo</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('home') }}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('empresa/customers') }}">Clientes</a></li>
                    <li class="breadcrumb-item active">Catálogos</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6 p-0">
                <a href="{{ url('empresa/customers/'.$customer_id.'/catalogs/create') }}" class="btn btn-app">
                    <i class="fas fa-plus"></i> Crear articulo
                </a>
                <a href="{{ url('empresa/customers/'.$customer_id.'/catalogs/import') }}" class="btn btn-app">
                    <i class="far fa-file-excel "></i> Importar catálogo
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                @include('pages.partials.messages')
            </div>
        </div>
        <div class="row">
            <div class="col-12" id="table">
                @include('pages.catalogs.table')
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
<script src="{{ asset('js/pages/catalogs/index.js') }}"></script>
@endpush
