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
        Schema::create('product_reviews', function (Blueprint $table) {
            $table->id();
            $table->string('content'); //bắt buộc
            $table->string('image')->nullable(); // không bắt buộc
            $table->integer('user_id');

            $table->integer('edit_count')->default(0); //chekc chỉnh sửa đánh giá
            $table->boolean('check')->default(0); //check đánh giá

            $table->integer('id_products')->nullable();
            $table->string('slug_products')->nullable();
            $table->integer('publish');  //số sao đánh giá( bắt buộc nhập)
            $table->integer('like_count')->default(0);
            $table->integer('is_liked')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_reviews');
    }
};
