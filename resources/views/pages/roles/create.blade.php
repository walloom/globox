<?php ?>

@extends('layouts.app', ['activePage' => 'config', 'titlePage' => 'Panel administrativo'])

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Pérfiles</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Incio</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('empresa/roles') }}">Pérfiles</a></li>
                    <li class="breadcrumb-item active">Crear</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8" id="table">
                @include('pages.roles.form')
            </div>
        </div>
        
    </div>
</div>

@endsection


