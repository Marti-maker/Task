<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryDetail extends Model
{
   public function delivery(){
       return $this->belongsTo(Delivery::class);
   }
}
