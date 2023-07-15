<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    protected $hidden=['created_at','updated_at'];
  public function details(){
      return $this->hasMany(DeliveryDetail::class);
  }
}
