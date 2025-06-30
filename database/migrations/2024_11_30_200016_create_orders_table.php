<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();


            $table->string('mobile', 13);
            $table->string('email')->nullable();
            $table->string('note')->nullable();

            $table->decimal('total_price', 10, 2);

            $table->enum('payment_method', ['cash_on_delivery', 'stripe'])->default('cash_on_delivery');
$table->foreignId('address_id')->nullable()->constrained()->onDelete('set null');

            $table->enum('shipping_method', ['home_delivery', 'pickup'])->default('home_delivery')->nullable();

            $table->enum('order_status', [
                'pending_payment',
                'processing',
                'ready_for_pickup',
                'shipped',
                'completed',
                'cancelled',
            ])->default('pending_payment');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
