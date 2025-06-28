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
        Schema::create('product_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->float('weight')->nullable();
            $table->text('ingredients')->nullable();
            $table->string('allergens')->nullable();
            $table->string('origin_country')->nullable();
            $table->boolean('is_organic')->nullable();
            $table->boolean('is_sugar_free')->nullable();
            $table->boolean('is_gluten_free')->nullable(); 
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_details');
    }
};
