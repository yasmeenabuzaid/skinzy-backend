<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $guarded  = [];

    public function subCategory()
    {
         return $this->belongsTo(SubCategory::class, 'subCategory_id');
    }

    public function product_images()
    {
        return $this->hasMany(ProductImage::class);
    }
    public function feedbacks()
    {
        return $this->hasMany(Feedback::class, 'product_id');
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
    public function productDetails()
    {
        return $this->hasOne(ProductDetail::class);
    }



public function parent()
{
    return $this->belongsTo(Product::class, 'parent_product_id');
}

public function variations()
{
    return $this->hasMany(Product::class, 'parent_product_id');
}



}
