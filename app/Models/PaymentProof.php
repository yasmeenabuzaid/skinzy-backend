<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentProof extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'order_id',
        'image',
        'status',
        'note',
        'payment_method',
        'transaction_id',
        'paid_amount',
        'paid_at',
        'bank_name',
        'account_number',
        'details',
        'reviewed_by',
        'reviewed_at',
        'created_at',
        'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }
}
