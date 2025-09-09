<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    // 👇 أضف هذا السطر لحل المشكلة
    protected $table = 'cart';

    protected $fillable = [
        'id',
        'product_id',
        'user_id',
        'order_id',
        'status',
        'quantity',
        'ordered_at',
        'created_at',
        'updated_at',
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
