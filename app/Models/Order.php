<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $guarded  = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }


    protected static function booted()
    {
      static::deleting(function ($order) {
          foreach ($order->orderDetails as $orderDetail) {
              $orderDetail->delete(); 
          }
  
          if ($order->isForceDeleting()) {
              $order->subCategories()->forceDelete();
          }
      });
    }
    
}
