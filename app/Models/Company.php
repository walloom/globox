<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model {

    protected $table = 'companies';
    protected $fillable = [
        'name',
        'sector',
        'telephone',
        'responsibility',
        'settings',
        'primary',
        'secondary',
        'primary_text',
        'secondary_text',
        'notes'
    ];

    public function units() {
        return $this->hasMany(Unit::class);
    }

    public function presentations() {
        return $this->hasMany(Presentation::class);
    }

    public function sizes() {
        return $this->hasMany(Size::class);
    }

    public function referenceTypes() {
        return $this->hasMany(ReferenceType::class);
    }

}
