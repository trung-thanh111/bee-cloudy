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
    Schema::create('cart_promotions', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('cart_id');
        $table->unsignedBigInteger('promotion_id');
        $table->timestamps();

        // Thêm các khóa ngoại
        $table->foreign('cart_id')->references('id')->on('carts')->onDelete('cascade');
        $table->foreign('promotion_id')->references('id')->on('promotions')->onDelete('cascade');
    });
}

public function down()
{
    Schema::dropIfExists('cart_promotions');
}

};
