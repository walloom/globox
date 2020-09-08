<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
  use Notifiable;

  protected $fillable = [
    'name', 'email', 'country', 'password',
  ];

  protected $hidden = [
    'password', 'remember_token',
  ];

  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  public function message(){
    return $this->hasMany(Message::class);
  }

  public function role(){
    return $this->belongsTo(Role::class);
  }

  public function company(){
    return $this->belongsTo(Company::class);
  }

  public function hasRoles(array $roles){
      
    foreach ($roles as $role) {
      if ($this->role->key === $role){
        return true;
      }
    }
    return false;
  }
  
  public function bodegas(){
    return $this->belongsToMany(Bodega::class)->withTimestamps();
  }

}
