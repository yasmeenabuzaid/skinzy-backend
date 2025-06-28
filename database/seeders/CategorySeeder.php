<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'Chocolates'],
            ['name' => 'Candies'],
            ['name' => 'Sweets'],
            ['name' => 'Chocolate Bars'],
            ['name' => 'Gourmet Chocolates'],
            ['name' => 'Sugar-Free Chocolates'],
            ['name' => 'Artisan Chocolates'],
        ];

        DB::table('categories')->insert($categories);
    }
}
