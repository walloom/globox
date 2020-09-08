<?php
use App\Helpers\Permission;
?>

@extends('layouts.app', ['activePage' => 'config', 'titlePage' => 'Panel administrativo'])

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Tipos de referencias</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                    <li class="breadcrumb-item active">Tipos de referencias</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8 p-0">
                <a href="#" data-click="create" class="btn btn-app {{ Permission::disabled('empresa/reference-types/create') }}">
                    <i class="fas fa-plus"></i> Crear tipo de referencia
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                @include('pages.partials.messages')
            </div>
        </div>
        <div class="row justify-content-center">

            <div class="col-12 col-lg-8" id="table">
                @include('pages.referenceTypes.table')
            </div>

        </div>
    </div>
</div>

@endsection

@push('js')
<script type="text/javascript" src="{{ asset('js/pages/referenceTypes/index.js') }}"></script>
@endpush
