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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('short_desc')->nullable();
            $table->text('description')->nullable();
            $table->text('info')->nullable();
            $table->foreignId('brand_id')->constrained()->onDelete('cascade');  // vừa tạo field vừa tạo Khóa ngoại đến bảng brands
            $table->foreignId('user_id')->constrained()->onDelete('cascade');  // vừa tạo field vừa tạo Khóa ngoại đến bảng brands
            $table->tinyInteger('is_hot')->default(0);
            $table->float('price');
            $table->tinyInteger('publish')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
