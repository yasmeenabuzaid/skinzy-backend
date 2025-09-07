<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    // 👇 أضف هذا السطر لحل المشكلة
    protected $table = 'cart';

    protected $fillable = [
        'user_id', 'product_id', 'quantity','order_id',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

}
