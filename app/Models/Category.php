<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $guarded  = [];

    public function subCategories()
    {
        return $this->hasMany(SubCategory::class);
    }

    protected static function booted()
  {
    static::deleting(function ($category) {
        foreach ($category->subCategories as $subCategory) {
            $subCategory->delete();
        }

        if ($category->isForceDeleting()) {
            $category->subCategories()->forceDelete();
        }
    });
  }
}
