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
        Schema::table('promotions', function (Blueprint $table) {
            // Thêm các cột hoặc điều chỉnh các cột hiện có nếu cần
            if (!Schema::hasColumn('promotions', 'minimum_amount')) {
                $table->decimal('minimum_amount', 10, 2)->nullable()->after('discount');
            }
            if (!Schema::hasColumn('promotions', 'usage_limit')) {
                $table->integer('usage_limit')->nullable()->after('minimum_amount');
            }
            if (!Schema::hasColumn('promotions', 'apply_for')) {
                $table->enum('apply_for', ['specific_products', 'freeship', 'all'])->default('all')->after('usage_limit');
            }
            if (!Schema::hasColumn('promotions', 'status')) {
                $table->enum('status', ['active', 'inactive'])->default('active')->after('apply_for');
            }
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('updatepromotions');
    }
};
