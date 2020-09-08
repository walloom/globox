<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model {

    protected $guarded = [];

    public function rack() {
        return $this->hasOne(Rack::class);
    }

}
