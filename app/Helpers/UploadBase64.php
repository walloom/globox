<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class UploadBase64 {

    public static function image($image_base_64, $folder=null) {

        if ($image_base_64) {

            $company = Auth::user()->company;
            $ubicationImage = 'companies/' . $company->id . '/users/';

            $base64_image = $image_base_64;
            @list($type, $file_data) = explode(';', $base64_image);
            @list(, $file_data) = explode(',', $file_data);
            $imageName = Str::random(20) . '.' . 'jpg';

            Storage::disk('public')->put($ubicationImage . '/' . $imageName, base64_decode($file_data));
            return $imageName;
        }

        return null;
    }

}
