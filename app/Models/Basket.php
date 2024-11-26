<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    protected $guarded = ['id'];

    // Una canasta tiene un producto
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
