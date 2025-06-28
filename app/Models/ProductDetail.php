<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    use HasFactory;

    protected $table = 'product_details';

    protected $fillable = [
        'product_id',
        'weight',
        'ingredients',
        'allergens',
        'origin_country',
        'is_organic',
        'is_sugar_free',
        'is_gluten_free',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
