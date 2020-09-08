<?php

use App\Helpers\Files;
?>
<div class="image-upload btnUploadImage">
    <div class="empty {{ $image?'d-none':'' }}">
        <i class="far fa-image"></i>
        <span>Cargar imagen</span>
    </div>
    <div class="with-image {{ !$image?'d-none':'' }}">
        <img id="previewImg" src="{{ Files::route('users', $image) }}" />
    </div>
</div>

<input type="hidden" name="image_base_64" value="">
<input class="form-control d-none" type="file" name="image" id="inputUploadImage" />

@push('css')
<link rel="stylesheet" href="{{ asset('plugins/image-upload/style.css') }}">
@endpush

@push('js')
<script type="text/javascript" src="{{ asset('plugins/image-upload/script.js') }}"></script>
@endpush