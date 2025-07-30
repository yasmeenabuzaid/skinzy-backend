<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $dates = ['deleted_at'];

    protected $guarded  = [];


public function subCategory()
{
    return $this->belongsTo(SubCategory::class);
}




public function images()
{
    return $this->hasMany(ProductImage::class);
}


public function mainProduct()
{
    return $this->belongsTo(Product::class, 'main_product_id');
}


    // public function feedbacks()
    // {
    //     return $this->hasMany(Feedback::class, 'product_id');
    // }
public function parentProduct()
{
    return $this->belongsTo(Product::class, 'parent_product_id');
}

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
  // Product.php
 public function details()
    {
        return $this->hasOne(ProductDetail::class, 'product_id');
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
