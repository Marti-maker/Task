<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $hidden = ['created_at', 'updated_at'];

    public function supplies()
    {
        return $this->hasMany(Supply::class);
    }
}
