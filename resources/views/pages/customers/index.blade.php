<?php

use App\Helpers\Files;
use App\Helpers\Permission;
?>

@extends('layouts.app', ['activePage' => 'customers', 'titlePage' => 'Panel administrativo'])

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Mis Clientes</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Clientes</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 p-0">
                <a href="{{ url('empresa/customers/create') }}" class="btn btn-app {{ Permission::disabled('empresa/customers/create') }}">
                    <i class="fas fa-plus"></i> Crear cliente
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
                @include('pages.customers.table')
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
<script src="{{ asset('js/pages/customers/index.js') }}"></script>
@endpush
