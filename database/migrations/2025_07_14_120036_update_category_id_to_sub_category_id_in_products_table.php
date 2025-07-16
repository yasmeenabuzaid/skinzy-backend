<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // احذف العلاقة القديمة
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');

            // أضف العلاقة الجديدة
            $table->unsignedBigInteger('sub_category_id')->nullable()->after('quantity');
            $table->foreign('sub_category_id')->references('id')->on('sub_categories')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // ارجع للعلاقة القديمة
            $table->dropForeign(['sub_category_id']);
            $table->dropColumn('sub_category_id');

            $table->unsignedBigInteger('category_id')->after('quantity');
            $table->foreign('category_id')->references('id')->on('sub_categories')->onDelete('cascade');
        });
    }
};
