<?php

use App\Helpers\Permission;
?>
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-7 d-flex">
                <h3 class="mb-0 align-self-center d-inline card-title">Unidades de Medida</h3>
            </div>
            <div class="col-5">
                <form method="get" action="{{ url('empresa/units') }}" autocomplete="off">
                    <div class="form-group row mb-0">
                        <input class="form-control rounded-pill" name="search" type="search" value="{{ $search??'' }}" placeholder="Buscar">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="card-body p-0">

        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Descripción</th>
                        <th class="text-center">Opciones</th>
                    </tr>
                </thead> 
                <tbody>
                    @foreach($units as $unit)
                    <tr>
                        <td>{{ $unit->code }}</td>
                        <td>{{ $unit->description }}</td>
                        <td class="project-actions text-center">
                            @if(Permission::action('empresa/units/*/edit'))
                            <a class="btn px-2 border-0 btn-sm" href="#" data-click="edit" data-id="{{ $unit->id }}">
                                <i class="fas fa-pencil-alt text-success"></i>
                            </a>
                            @endif
                            @if(Permission::action('empresa/units/*/delete'))
                            <a class="btn px-2 border-0 btn-sm" href="#" data-click="delete" data-id="{{ $unit->id }}">
                                <i class="fas fa-trash text-dark"></i>
                            </a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

    <div class="card-footer pt-4 py-2">
        {{ $units->links() }}
    </div>

</div>