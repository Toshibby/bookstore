<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded=['id'];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Un producto puede tener muchos pedidos
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // Un producto puede aparecer en muchos detalles de venta
    public function details()
    {
        return $this->hasMany(Detail::class);
    }
    public function baskets()
    {
        return $this->hasMany(Basket::class);
    }
}
