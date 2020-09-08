<?php

use App\Helpers\Permission;
?>
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-6 col-lg-8 d-flex">
                <h3 class="mb-0 align-self-center d-inline card-title">Clientes</h3>
            </div>
            <div class="col-6 col-lg-4">
                <form method="get" action="{{ url('empresa/customers') }}" autocomplete="off">
                    <div class="form-group row mb-0">
                        <input class="form-control rounded-pill" name="search" type="search" value="{{ $search??'' }}" placeholder="Buscar">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap table-striped">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Identificación</th>
                    <th>Ciudad</th>
                    <th>Dirección</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($customers as $customer)
                <tr>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->identification }}</td>
                    <td>{{ $customer->city->name }} - {{ $customer->state->name }}</td>
                    <td>{{ $customer->address }}</td>
                    <td class="project-actions text-center">

                        @if(Permission::action('empresa/customers/*/catalogs'))
                        <a class="px-2" href="{{ url('empresa/customers/'.$customer->id.'/catalogs') }}">
                            <i class="fas fa-shopping-cart text-dark text-lg"></i>
                        </a>
                        @endif

                        @if(Permission::action('empresa/customers/*/edit'))
                        <a class="px-2" href="{{ url('empresa/customers/'.$customer->id.'/edit') }}">
                            <i class="fas fa-pencil-alt text-dark text-lg"></i>
                        </a>
                        @endif

                        @if(Permission::action('empresa/customers/*/delete'))
                        <a class="px-2" href="#" data-click="delete" data-id="{{ $customer->id }}">
                            <i class="fas fa-trash text-muted text-lg"></i>
                        </a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{ $customers->links() }}
    </div>
</div>