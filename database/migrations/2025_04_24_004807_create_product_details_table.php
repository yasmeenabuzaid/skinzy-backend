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
    $table->string('brand')->nullable();
    $table->string('shade')->nullable();
    $table->enum('finish', ['matte', 'glossy', 'satin', 'shimmer'])->nullable();
    $table->enum('skin_type', ['oily', 'dry', 'combination', 'sensitive'])->nullable();
    $table->text('ingredients')->nullable();
    $table->string('volume')->nullable();
    $table->text('usage_instructions')->nullable();

    $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
      $table->timestamps();
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
