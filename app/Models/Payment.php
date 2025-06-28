<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'user_id',
        'payment_id',
        'status',
        'amount',
        'currency',
        'payment_method',
        'card_brand',
        'card_last_4',
        'idempotency_key',
        'response_data',
        'order_id',
    ];

    protected $casts = [
        'response_data' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function order()
{
    return $this->belongsTo(Order::class);
}

}
