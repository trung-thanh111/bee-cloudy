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
        Schema::create('attributes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->string('slug')->unique();
            $table->unsignedBigInteger('attribute_catalogue_id'); 
            $table->foreign('attribute_catalogue_id')->references('id')->on('attribute_catalogues')->onDelete('cascade');
            $table->tinyInteger('publish')->default(0);
            $table->timestamps();
            $table->softDeletes()->comment('se them truong deleted_at va su dung xoa mem cua laravel');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attributes');
    }
};
