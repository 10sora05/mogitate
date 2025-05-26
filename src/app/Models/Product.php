<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function seasons()
{
    return $this->belongsToMany(Season::class, 'product_season');
}
}
