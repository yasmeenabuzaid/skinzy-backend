<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\NotDeletedScope;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'small_description',
        'description',
        'name_ar',
        'small_description_ar',
        'description_ar',
        'code',
        'quantity',
        'sold_count',
        'price',
        'price_after_discount',
        'isDelete',
        'brand_id',
        'sub_category_id',
        'created_at',
        'updated_at',
    ];

    protected static function booted()
    {
        static::addGlobalScope(new NotDeletedScope);
    }


    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function firstImage()
    {
        return $this->hasOne(ProductImage::class)->orderBy('id');
    }


    // public function feedbacks()
    // {
    //     return $this->hasMany(Feedback::class, 'product_id');
    // }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    // Product.php
    public function specifications()
    {
        return $this->hasMany(Specification::class);
    }
    
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }


    public function variations()
    {
        return $this->hasMany(ProductVariation::class, 'product_id');
    }

}
