<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

class Files {

    public static function route(string $type, $name = null) {

        $company = Auth::user()->company;
        $path='';

        if ($type == 'users' && isset($company->id)) {
            if (is_null($name)) {
                $path = 'img/default.jpg';
            } else {
                $path = 'storage/companies/' . $company->id . '/users/' . $name;
            }
        }
        return asset($path);
    }

}
