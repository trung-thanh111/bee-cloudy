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
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->string('name'); 
            $table->string('code')->comment('mã của thuộc tính')->nullable(); 
            $table->integer('quantity')->default(0); 
            $table->string('sku')->unique()->nullable();
            $table->float('price')->default(0); 
            $table->text('album')->nullable();
            $table->float('rating', 2, 1)->default(0);
            $table->integer('sold_count')->default(0);
            $table->integer('rating_count')->default(0);
            $table->integer('favorite_count')->default(0);
            $table->string('file_name')->nullable(); 
            $table->string('file_url')->nullable(); 
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->tinyInteger('publish')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variants');
    }
};
