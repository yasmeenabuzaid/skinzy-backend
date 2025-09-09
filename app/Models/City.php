<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'delivery_fee',
        'free_shipping_min',
        'created_at',
        'updated_at',
    ];

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

}
