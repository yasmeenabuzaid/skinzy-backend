<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('cities', function (Blueprint $table) {
            $table->decimal('delivery_fee', 8, 2)->default(0);
            $table->decimal('free_shipping_min', 10, 2)->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('cities', function (Blueprint $table) {
            $table->dropColumn(['delivery_fee', 'free_shipping_min']);
        });
    }
};

