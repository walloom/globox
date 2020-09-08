<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Rack;
use App\Models\Ubication;

class TestController extends Controller {

    public function index() {

        $rack = Rack::find(1);
        
    }

}
