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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->nullable()->default(null);
            $table->datetime('date')->nullable()->default(null);
            $table->foreignId('user_id');
            $table->foreignId('member_id')->nullable()->default(null);
            $table->integer('total_pay')->nullable()->default(null);
            $table->integer('total_profit')->nullable()->default(null);
            $table->foreignId('status_id')->nullable()->default(1);
            $table->foreignId('payment_id')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
