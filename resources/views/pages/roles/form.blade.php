<?php

use App\Helpers\Form;

$action = isset($role->id) ? 'empresa/roles/' . $role->id : 'empresa/roles';
?>

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-127 d-flex">
                <h3 class="mb-0 align-self-center d-inline card-title">{{ isset($role->id)?'Editar':'Nuevo' }} pérfil</h3>
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        <form method="post" id="frmRole" action="{{ url($action) }}" autocomplete="off">
            {!! csrf_field() !!}
            {{ method_field( isset($role->id)?'PUT':'POST' ) }}

            <input type="hidden" name="id" value="{{ $role->id??'' }}">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group ">
                            <label class="form-control-label">Nombre</label>
                            <input type="text" name="name" value="{{ $role->name??'' }}" class="form-control @error('name') is-invalid @enderror" placeholder="Nombre">
                            @error('name')
                            <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">

                        <h4 class="mt-3">Administrar Permisos</h4>

                        <div class="row">
                            @foreach($groupPermissions as $groupPermission)

                            <div class="col-4 mb-3">
                                <h5>{{ $groupPermission->name }}</h5>

                                @foreach($groupPermission->permissions as $permission)
                                
                                <div class="icheck-primary d-block">
                                    <input name="permisions[]" type="checkbox" {{ $permission->is_default?'disabled':'' }} {{ Form::isChecked('permisions', $permission, $role->permissions??null )?'checked':'' }} id="cbxBod{{ $permission->name }}" value="{{ $permission->id }}">
                                    <label for="cbxBod{{ $permission->name }}" readonly class="font-weight-normal mb-2">
                                        {{ $permission->name }}
                                    </label>
                                </div>
                                @endforeach
                            </div>

                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>

</div>

@push('css')
<link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@endpush