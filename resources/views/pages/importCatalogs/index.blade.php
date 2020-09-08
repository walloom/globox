<?php

use App\Helpers\Files;
?>

@extends('layouts.app', ['activePage' => 'customers', 'titlePage' => 'Panel administrativo'])

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Importar catálogo</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                    <li class="breadcrumb-item active">Importar catálogo</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <!--<div class="row">
            <div class="col-sm-12 p-0">
                <a href="{{ url('empresa/customers/create') }}" class="btn btn-app">
                    <i class="fas fa-plus"></i> Crear cliente
                </a>
            </div>
        </div>-->
        
        <div class="row">
            
        </div>
    </div>
</div>

@endsection

