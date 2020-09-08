<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="form-group">
    <label>Departamento</label>
    <select name="state_id" class="form-control">
        <option value="">- Seleccionar -</option>

        @if(isset($states))
        @foreach ($states as $state)
        <option value="{{ $state->id }}" {{ old('state_id') && old('state_id')==$state->id?'selected': (isset($customer->state_id) && $customer->state_id === $state->id?'selected':'') }}>
            {{ $state->name }}
        </option>
        @endforeach
        @endif

    </select>
    @error('state_id')
    <div class="text-danger small">{{ $message }}</div>
    @enderror
</div>
