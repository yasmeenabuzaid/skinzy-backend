<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Example: Amman, Irbid, Zarqa...
            $table->timestamps();
        });

        // Insert Jordanian governorates (cities)
        DB::table('cities')->insert([
            ['name' => 'Amman'],
            ['name' => 'Zarqa'],
            ['name' => 'Irbid'],
            ['name' => 'Aqaba'],
            ['name' => 'Salt'],
            ['name' => 'Mafraq'],
            ['name' => 'Tafilah'],
            ['name' => 'Karak'],
            ['name' => 'Ma’an'],
            ['name' => 'Jerash'],
            ['name' => 'Ajloun'],
            ['name' => 'Madaba'],
            ['name' => 'Dead Sea'],
            ['name' => 'Other'], // For manual city input
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('cities');
    }
};
