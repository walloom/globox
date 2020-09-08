<?php
$action = isset($customer->id) ? 'empresa/customers/' . $customer->id : 'empresa/customers';
?>

<form action="{{ url($action) }}" class="" method="POST" enctype="multipart/form-data" autocomplete="off">
    {!! csrf_field() !!}
    {{ method_field( isset($customer->id)?'PUT':'POST' ) }}
    <input type="hidden" name="id" value="{{ $customer->id??'' }}">

    <div class="row">
        <div class="col-12 col-md-4">
            <x-image-upload :image="$customer->picture??null"></x-image-upload>
        </div>
        <div class="col-12 col-md-8">
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" name="name" value="{{ old('name')?? ($customer->name??'') }}" class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-12 col-lg-5">
                    <div class="form-group">
                        <label>Tipo de documento</label>
                        <select name="document_type_id" class="form-control">
                            <option value="">- Seleccionar -</option>
                            @foreach ($documentTypes as $documentType)
                            <option value="{{ $documentType->id }}" {{ old('document_type_id') && old('document_type_id')==$documentType->id?'selected': (isset($customer->document_type_id) && $customer->document_type_id === $documentType->id?'selected':'') }}>
                                {{ $documentType->code }} - {{ $documentType->description }}
                            </option>
                            @endforeach
                        </select>
                        @error('document_type_id')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-12 col-lg-7">
                    <div class="form-group">
                        <label>Número de documento</label>
                        <input type="text" name="identification" value="{{ old('identification')?? ($customer->identification??'') }}" class="form-control @error('identification') is-invalid @enderror">
                        @error('identification')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label>País</label>
                        <select name="country_id" class="form-control">
                            <option value="">- Seleccionar -</option>
                            @foreach ($countries as $country)
                            <option value="{{ $country->id }}" {{ old('country_id') && old('country_id')==$country->id?'selected': (isset($customer->country_id) && $customer->country_id === $country->id?'selected':'') }}>
                                {{ $country->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('country_id')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-12 col-md-4" id="colStates">
                    @include('pages.customers._sub.states')
                </div>
                <div class="col-12 col-md-4" id="colCities">
                    @include('pages.customers._sub.cities')
                </div>
                <div class="col-12 col-lg-4">
                    <div class="form-group">
                        <label>Zona</label>
                        <input type="text" name="zone" value="{{ old('zone')?? ($customer->zone??'') }}" class="form-control @error('zone') is-invalid @enderror">
                        @error('zone')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="form-group">
                        <label>Celular</label>
                        <input type="text" name="cell_number" value="{{ old('cell_number')?? ($customer->cell_number??'') }}" class="form-control @error('cell_number') is-invalid @enderror">
                        @error('cell_number')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="form-group">
                        <label>Teléfono</label>
                        <input type="text" name="phone_number" value="{{ old('phone_number')?? ($customer->phone_number??'') }}" class="form-control @error('phone_number') is-invalid @enderror">
                        @error('phone_number')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-12 col-lg-12">
                    <div class="form-group">
                        <label>Dirección</label>
                        <input type="text" name="address" value="{{ old('address')?? ($customer->address??'') }}" class="form-control @error('address') is-invalid @enderror">
                        @error('address')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label>Actividad económica</label>
                        <select name="economic_activity_id" class="form-control">
                            <option value="">- Seleccionar -</option>
                            @foreach ($economicActivities as $economicActivity)
                            <option value="{{ $economicActivity->id }}" {{ old('economic_activity_id') && old('economic_activity_id')==$economicActivity->id?'selected': (isset($customer->economic_activity_id) && $customer->economic_activity_id === $economicActivity->id?'selected':'') }}>
                                {{ $economicActivity->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('economic_activity_id')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label>Moneda</label>
                        <select name="currency_id" class="form-control">
                            <option value="">- Seleccionar -</option>
                            @foreach ($currencies as $currency)
                            <option value="{{ $currency->id }}" {{ old('currency_id') && old('currency_id')==$currency->id?'selected': (isset($customer->currency_id) && $customer->currency_id === $currency->id?'selected':'') }}>
                                {{ $currency->code }} - {{ $currency->name }} 
                            </option>
                            @endforeach
                        </select>
                        @error('currency_id')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
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
<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush

@push('js')
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('js/pages/customers/form.js') }}"></script>
@endpush
