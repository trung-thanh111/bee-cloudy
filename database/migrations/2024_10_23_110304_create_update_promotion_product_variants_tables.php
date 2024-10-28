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
        Schema::table('promotion_product_variants', function (Blueprint $table) {
            // Thêm các cột hoặc điều chỉnh các cột hiện có nếu cần
            if (!Schema::hasColumn('promotion_product_variants', 'discount')) {
                $table->decimal('discount', 5, 2)->nullable()->after('product_id'); // Thêm cột giảm giá
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('update_promotion_product_variants_tables');
    }
};
