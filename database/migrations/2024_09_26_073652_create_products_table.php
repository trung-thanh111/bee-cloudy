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
            $table->string('image')->nullable();
            $table->text('album')->nullable();
            $table->string('info')->nullable();
            $table->text('description')->nullable();
            $table->foreignId('brand_id')->constrained()->onDelete('cascade');  // vừa tạo field vừa tạo Khóa ngoại đến bảng brands
            $table->tinyInteger('is_hot')->default(0);
            $table->double('price');
            $table->double('del')->default(0);
            $table->integer('instock')->default(0);
            $table->integer('sold_count')->default(0);
            $table->string('sku')->unique();
            $table->text('attributeCatalogue')->nullable();
            $table->text('attribute')->nullable();
            $table->text('variant')->nullable();
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
