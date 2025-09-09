<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;


    protected $fillable = [
        'id',
        'user_id',
        'title',
        'full_address',
        'city_id',
        'state',
        'postal_code',
        'country',
        'latitude',
        'longitude',
        'created_at',
        'updated_at',
    ];
    
    public function city()
    {
        return $this->belongsTo(City::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
