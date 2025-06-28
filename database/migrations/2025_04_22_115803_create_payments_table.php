<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('order_id')->nullable();
            $table->foreign('order_id')
                  ->references('id')
                  ->on('orders')
                  ->onDelete('set null');

            $table->string('payment_id')->unique();
            $table->string('status');
            $table->integer('amount');
            $table->string('currency')->default('USD');

            $table->string('payment_method')->nullable();
            $table->string('card_brand')->nullable();
            $table->string('card_last_4')->nullable();

            $table->uuid('idempotency_key')->nullable();
            $table->json('response_data')->nullable();

            $table->timestamps();

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
