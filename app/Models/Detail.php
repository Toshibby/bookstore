<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;
    protected $guarded=['id'];

    public function sale()
    {
        return $this->belongsTo(Sale::class );
    }


    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
