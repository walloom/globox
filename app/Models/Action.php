<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Action extends Model {

    protected $guarded = [];

    public function permissions() {
        return $this->belongsToMany(Permission::class)
                ->withTimestamps();
    }

}
