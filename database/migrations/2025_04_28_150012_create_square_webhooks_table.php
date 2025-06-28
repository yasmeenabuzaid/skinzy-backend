<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('square_webhooks', function (Blueprint $table) {
            $table->id();
            $table->string('event_id');
            $table->string('event_type');
            $table->json('payload');  // لتخزين بيانات الـ Webhook
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('square_webhooks');
    }
};
