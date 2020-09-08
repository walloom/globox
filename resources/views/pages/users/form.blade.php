<?php

$action = isset($user->id) ? 'empresa/users/' . $user->id : 'empresa/users';
$bodegasArray = isset($user->id) ? $user->bodegas->pluck('id')->toArray() : [];

?>

<form action="{{ url($action) }}" class="" method="POST" enctype="multipart/form-data" autocomplete="off">
    {!! csrf_field() !!}
    {{ method_field( isset($user->id)?'PUT':'POST' ) }}
    <input type="hidden" name="id" value="{{ $user->id??'' }}">

    <div class="row">

        <div class="col-12 col-md-4">
            <x-image-upload :image="$user->picture??null"></x-image-upload>
        </div>

        <div class="col-12 col-md-8">

            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" name="name" value="{{ old('name')?? ($user->name??'') }}" class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>Apellido</label>
                        <input type="text" name="last_name" value="{{ old('last_name')?? ($user->last_name??'') }}" class="form-control @error('last_name') is-invalid @enderror">
                        @error('last_name')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-6">
                    <div class="form-group">
                        <label>Dirección</label>
                        <input type="text" name="address" value="{{ old('address')?? ($user->address??'') }}" class="form-control @error('address') is-invalid @enderror">
                        @error('address')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-6">
                    <div class="form-group">
                        <label>Teléfono</label>
                        <input type="text" name="phone" value="{{ old('phone')?? ($user->phone??'') }}" class="form-control @error('phone') is-invalid @enderror">
                        @error('phone')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" value="{{ old('email')?? ($user->email??'') }}" class="form-control  @error('email') is-invalid @enderror">
                        @error('email')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label>Contraseña</label>
                        <input name="password" type="password" class="form-control">
                        @error('password')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror

                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label>Perfil</label>
                        <select name="role_id" class="form-control">
                            <option value="">- Seleccionar -</option>
                            @foreach ($roles as $role)
                            <option value="{{ $role->id }}" {{ old('role_id') && old('role_id')==$role->id?'selected': (isset($user->role_id) && $user->role_id === $role->id?'selected':'') }}>
                                {{ $role->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('role_id')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-12">

                    <label>Bodegas</label>

                    @foreach($bodegas as $key=>$bodega)

                    <div class="icheck-primary d-block">
                        <input name="bodegas[]" type="checkbox" {{ ( in_array($bodega->id, $bodegasArray)?'checked':'' ) }}  id="cbxBod{{$bodega->id}}" value="{{ $bodega->id }}">
                        <label for="cbxBod{{$bodega->id}}" class="font-weight-normal mb-2">
                            {{ $bodega->name }}
                        </label>
                    </div>

                    @endforeach



                </div>


            </div>

        </div>

    </div>  

    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <button type="submit" class="btn bg-primary float-right">
                    <i class="fas fa-save"></i>
                    GUARDAR
                </button>
            </div>
        </div>
    </div>

</form>

@push('css')
<link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@endpush
