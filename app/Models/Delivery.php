<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    protected $hidden=['created_at','updated_at'];
  public function details(){
      return $this->hasMany(DeliveryDetail::class);
  }
  public function pendings(){
      return $this->hasMany(PendingDelivery::class);
  }
}
