<?php


namespace App\Helpers;
use Illuminate\Support\Facades\Auth;

class CompanyHelper {

    public static function id() {
        return Auth::user()->company->id;
    }

}
