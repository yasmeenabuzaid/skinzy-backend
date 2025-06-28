<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubCategorySeeder extends Seeder
{
    public function run()
    {
        $subCategories = [
            // Chocolates category (category_id = 1)
            ['name' => 'Dark Chocolate', 'category_id' => 1],
            ['name' => 'Milk Chocolate', 'category_id' => 1],
            ['name' => 'White Chocolate', 'category_id' => 1],
            ['name' => 'Hazelnut Chocolate', 'category_id' => 1],

            // Candies category (category_id = 2)
            ['name' => 'Lollipops', 'category_id' => 2],
            ['name' => 'Caramel Candies', 'category_id' => 2],
            ['name' => 'Gummy Candies', 'category_id' => 2],

            // Sweets category (category_id = 3)
            ['name' => 'Cakes', 'category_id' => 3],
            ['name' => 'Pastries', 'category_id' => 3],
            ['name' => 'Donuts', 'category_id' => 3],

            // Chocolate Bars category (category_id = 4)
            ['name' => 'Milk Chocolate Bar', 'category_id' => 4],
            ['name' => 'Dark Chocolate Bar', 'category_id' => 4],
            ['name' => 'White Chocolate Bar', 'category_id' => 4],

            // Gourmet Chocolates category (category_id = 5)
            ['name' => 'Artisan Dark Chocolate', 'category_id' => 5],
            ['name' => 'Gourmet Truffles', 'category_id' => 5],

            // Sugar-Free Chocolates category (category_id = 6)
            ['name' => 'Sugar-Free Dark Chocolate', 'category_id' => 6],
            ['name' => 'Sugar-Free Milk Chocolate', 'category_id' => 6],

            // Artisan Chocolates category (category_id = 7)
            ['name' => 'Handmade Truffles', 'category_id' => 7],
            ['name' => 'Craft Chocolate Bars', 'category_id' => 7],
        ];

        DB::table('sub_categories')->insert($subCategories);
    }
}
