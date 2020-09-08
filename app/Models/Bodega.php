<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bodega extends Model {

    protected $table = 'bodegas';
    protected $guarded = [];

    public function racks() {
        return $this->hasMany(Rack::class);
    }

    public function sections() {
        return $this->hasMany(Section::class);
    }

}
