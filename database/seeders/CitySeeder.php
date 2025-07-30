<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    public function run(): void
    {
        $cities = [
            ['name' => 'Amman', 'delivery_fee' => 2.00, 'free_shipping_min' => 30.00],
            ['name' => 'Zarqa', 'delivery_fee' => 2.50, 'free_shipping_min' => 35.00],
            ['name' => 'Irbid', 'delivery_fee' => 3.00, 'free_shipping_min' => 40.00],
            ['name' => 'Aqaba', 'delivery_fee' => 5.00, 'free_shipping_min' => 50.00],
            ['name' => 'Salt', 'delivery_fee' => 2.50, 'free_shipping_min' => 30.00],
            ['name' => 'Mafraq', 'delivery_fee' => 3.00, 'free_shipping_min' => 35.00],
            ['name' => 'Tafilah', 'delivery_fee' => 4.00, 'free_shipping_min' => 45.00],
            ['name' => 'Karak', 'delivery_fee' => 4.00, 'free_shipping_min' => 45.00],
            ['name' => 'Ma’an', 'delivery_fee' => 4.50, 'free_shipping_min' => 50.00],
            ['name' => 'Jerash', 'delivery_fee' => 2.50, 'free_shipping_min' => 30.00],
            ['name' => 'Ajloun', 'delivery_fee' => 2.50, 'free_shipping_min' => 30.00],
            ['name' => 'Madaba', 'delivery_fee' => 2.00, 'free_shipping_min' => 25.00],
            ['name' => 'Dead Sea', 'delivery_fee' => 6.00, 'free_shipping_min' => 60.00],
            ['name' => 'Other', 'delivery_fee' => 3.00, 'free_shipping_min' => 35.00],
        ];

        foreach ($cities as $city) {
            DB::table('cities')->updateOrInsert(
                ['name' => $city['name']],
                ['delivery_fee' => $city['delivery_fee'], 'free_shipping_min' => $city['free_shipping_min']]
            );
        }
    }
}
