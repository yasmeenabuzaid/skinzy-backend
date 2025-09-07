<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration 
{
    public function up(): void
    {
        Schema::create('payment_proofs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
        
            $table->string('image');
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
            $table->text('note')->nullable();
        
            // إضافات
            $table->string('payment_method')->nullable();
            $table->string('transaction_id')->nullable();
            $table->decimal('paid_amount', 15, 2)->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('account_number')->nullable();
            $table->text('details')->nullable();
        
            $table->foreignId('reviewed_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('reviewed_at')->nullable();
        
            $table->timestamps();
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('payment_proofs');
    }
};
