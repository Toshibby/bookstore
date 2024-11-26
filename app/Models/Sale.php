<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    protected $guarded=['id'];
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function saleType()
    {
        return $this->belongsTo(SaleType::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function details()
    {
        return $this->hasMany(Detail::class);
    }
}
