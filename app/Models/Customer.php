<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model {

    protected $guarded = [];

    public function country() {
        return $this->belongsTo(Country::class);
    }

    public function state() {
        return $this->belongsTo(State::class);
    }

    public function city() {
        return $this->belongsTo(City::class);
    }
    
     public function documentType() {
        return $this->belongsTo(DocumentType::class);
    }

}
