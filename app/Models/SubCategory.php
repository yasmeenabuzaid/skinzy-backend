<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $guarded  = [];

    public function category()
    {
         return $this->belongsTo(Category::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'subCategory_id', 'id');
    }

    protected static function booted()
    {
        static::deleting(function ($subCategory) {
            \Log::info('Deleting SubCategory ID: ' . $subCategory->id);
            \Log::info('Related Products Count: ' . $subCategory->products()->count());

            if ($subCategory->isForceDeleting()) {
                \Log::info('Force deleting related products...');
                $subCategory->products()->forceDelete();
            } else {
                \Log::info('Soft deleting related products...');
                $subCategory->products()->delete();
            }
        });
    }

}
