<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rack extends Model {

    protected $guarded = [];

    public function section() {
        return $this->belongsTo(Section::class)
                        ->withTimestamps();
    }
    
    public function ubications() {
        return $this->hasMany(Ubication::class);
    }

}
