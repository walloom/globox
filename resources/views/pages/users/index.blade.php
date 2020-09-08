<?php

use App\Helpers\Files;
use App\Helpers\Permission;
?>

@extends('layouts.app', ['activePage' => 'users', 'titlePage' => 'Panel administrativo'])

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Mis usuarios</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Usuarios</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 p-0">
                <a href="{{ url('empresa/users/create') }}" class="btn btn-app {{ Permission::disabled('empresa/users/create') }}">
                    <i class="fas fa-plus"></i> Crear Usuario
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                @include('pages.partials.messages')
            </div>
        </div>
        <div class="row">

            @foreach($users as $user)

            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch mb-3">
                <div class="card bg-light w-100">
                    <div class="card-header text-muted border-bottom-0">
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-9">
                                <h2 class="lead"><b>{{ $user->name }} {{ $user->last_name }}</b></h2>
                                <p class="text-muted text-sm"><b>Email: </b> {{ $user->email }} </p>
                                <ul class="ml-4 mb-0 fa-ul text-muted">
                                    <li class="">
                                        <span class="fa-li"><i class="fas fa-lg fa-user-lock mr-2"></i></span> <strong>Perfil:</strong> {{ $user->role->name }}
                                    </li>
                                </ul>
                            </div>
                            <div class="col-3 text-center">
                                <img src="{{ Files::route('users', $user->picture) }}" alt="" class="img-circle img-fluid avatar-sm">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="text-right">

                            <a href="{{ url('empresa/users/'.$user->id.'/edit') }}" class="btn btn-sm btn-primary {{ Permission::disabled('empresa/users/*/edit') }}">
                                <i class="fas fa-user mr-2"></i> Editar
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            @endforeach

        </div>
    </div>
</div>

@endsection

@push('js')

@endpush
