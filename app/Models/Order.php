<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id',
        'mobile',
        'email',
        'note',
        'total_price',
        'final_price',
        'payment_method',
        'address_id',
        'shipping_method',
        'order_status',
        'user_id',
        'created_at',
        'updated_at',
    ];


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
