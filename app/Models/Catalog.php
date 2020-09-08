<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Catalog extends Model {

    protected $guarded = [];

    public function company() {
        return $this->belongsTo(Company::class);
    }

    public function customer() {
        return $this->belongsTo(Customer::class);
    }

    public function size() {
        return $this->belongsTo(Size::class);
    }

}
