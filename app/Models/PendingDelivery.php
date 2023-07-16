<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PendingDelivery extends Model
{
    protected $hidden = ['created_at', 'updated_at'];

    public function delivery()
    {
        return $this->belongsTo(Delivery::class);
    }
}
