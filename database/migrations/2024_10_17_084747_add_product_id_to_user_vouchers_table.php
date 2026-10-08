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
    Schema::table('user_vouchers', function (Blueprint $table) {
        $table->unsignedBigInteger('product_id')->nullable()->after('promotion_product_variant_id'); // Thêm product_id
    });
}

public function down()
{
    Schema::table('user_vouchers', function (Blueprint $table) {
        $table->dropColumn('product_id');
    });
}

};
