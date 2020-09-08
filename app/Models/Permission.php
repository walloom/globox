<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model {

    protected $guarded = [];

    public function actions() {
        return $this->belongsToMany(Action::class);
    }

}
