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
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('name');  // Tên của voucher
            $table->dateTime('start_date');  // Ngày bắt đầu áp dụng
            $table->dateTime('end_date');  // Ngày kết thúc
            $table->decimal('discount_value', 10, 2);  // Giá trị chiết khấu
            $table->decimal('minimum_amount', 10, 2)->nullable();  // Số tiền tối thiểu để sử dụng voucher
            $table->integer('usage_limit')->nullable();  // Giới hạn số lần sử dụng
            $table->enum('apply_for', ['specific_products', 'new_accounts', 'all'])->default('all');  // Áp dụng cho
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};
