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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('code', 20);
            $table->string('full_name');
            $table->string('phone', 20);
            $table->string('address');
            $table->string('note');
            $table->double('total_amount');
            $table->integer('total_items')->default(1);
            $table->enum('status', ['pending', 'processing', 'confirmed', 'delivered', 'cancelled', 'returned'])->default('pending');
            $table->enum('payment_method', ['unpaid', 'paid']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
