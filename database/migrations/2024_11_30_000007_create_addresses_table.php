<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
   Schema::create('addresses', function (Blueprint $table) {
    $table->id();

    $table->foreignId('user_id')->constrained()->onDelete('cascade');

    $table->string('title')->nullable(); // مثل "المنزل"
    $table->string('full_address');

    $table->foreignId('city_id')->constrained('cities')->onDelete('restrict'); // المدينة من جدول المحافظات

    $table->string('state')->nullable();
    $table->string('postal_code')->nullable();
    $table->string('country')->default('Jordan');

    $table->decimal('latitude', 10, 7)->nullable();
    $table->decimal('longitude', 10, 7)->nullable();

    $table->timestamps();
});


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
