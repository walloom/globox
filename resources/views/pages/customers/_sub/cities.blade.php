<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="form-group">
    <label>Ciudad</label>
    <select name="city_id" class="form-control">
        <option value="">- Seleccionar -</option>

        @if(isset($cities))
        @foreach ($cities as $city)
        <option value="{{ $city->id }}" {{ old('city_id') && old('city_id')==$city->id?'selected': (isset($customer->city_id) && $customer->city_id === $city->id?'selected':'') }}>
            {{ $city->name }}
        </option>
        @endforeach
        @endif

    </select>
    @error('city_id')
    <div class="text-danger small">{{ $message }}</div>
    @enderror
</div>
