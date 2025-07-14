<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // تحديث العمود order_status ليشمل 'cart'
        Schema::table('orders', function (Blueprint $table) {
            $table->enum('order_status', [
                'cart', // الحالة الجديدة
                'pending_payment',
                'processing',
                'ready_for_pickup',
                'shipped',
                'completed',
                'cancelled',
            ])->default('cart')->change();  // يمكن تغيير القيمة الافتراضية حسب الحاجة
        });
    }

    public function down(): void
    {
        // إعادة العمود للحالة السابقة بدون 'cart'
        Schema::table('orders', function (Blueprint $table) {
            $table->enum('order_status', [
                'pending_payment',
                'processing',
                'ready_for_pickup',
                'shipped',
                'completed',
                'cancelled',
            ])->default('pending_payment')->change();
        });
    }
};
