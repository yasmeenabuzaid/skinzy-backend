<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'name_ar',
        'image',
        'isDelete',
        'created_at',
        'updated_at',
    ];
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
    
    public function subcategories()
    {
        return $this->hasMany(SubCategory::class);
    }


}
