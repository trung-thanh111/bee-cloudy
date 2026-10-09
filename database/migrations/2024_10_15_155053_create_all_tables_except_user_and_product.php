<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllTablesExceptUserAndProduct extends Migration
{
    public function up()
    {
        // Create promotions table
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();  
            $table->string('image')->nullable();  
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->decimal('discount', 10, 2);
            $table->decimal('minimum_amount', 10, 2)->nullable();
            $table->integer('usage_limit')->nullable();
            $table->enum('apply_for', ['specific_products', 'freeship', 'all'])->default('all');
            $table->enum('status', ['active', 'inactive'])->default('active');
        
            // Các cột mới thêm vào
            $table->integer('quantity')->default(0);  // Cột "số lượng"
            $table->string('description')->nullable();  // Cột "Mô tả"
            $table->timestamps();
        });

        // Create promotion_product_variants table
        Schema::create('promotion_product_variants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('promotion_id');
            $table->decimal('discount', 10, 2)->nullable();
            $table->unsignedBigInteger('product_id');
            $table->timestamps();

            // Add foreign keys
            $table->foreign('promotion_id')->references('id')->on('promotions')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });

        // Create user_vouchers table
        Schema::create('user_vouchers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('code')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->unsignedBigInteger('promotion_id');
            $table->unsignedBigInteger('promotion_product_variant_id')->nullable()->default(null);
            $table->timestamp('claimed_at')->nullable();
            $table->timestamps();

            // Add foreign keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('promotion_id')->references('id')->on('promotions')->onDelete('cascade');
            $table->foreign('promotion_product_variant_id')->references('id')->on('promotion_product_variants')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_vouchers');
        Schema::dropIfExists('promotion_product_variants');
        Schema::dropIfExists('promotions');
    }
}

