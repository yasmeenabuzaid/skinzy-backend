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
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('small_description');
            $table->text('description');

            $table->string('name_ar')->nullable();
            $table->string('small_description_ar')->nullable();
            $table->text('description_ar')->nullable();

            $table->float('price');
            $table->float('price_after_discount')->nullable();
            $table->unsignedInteger('quantity');

            $table->boolean('isDelete')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
