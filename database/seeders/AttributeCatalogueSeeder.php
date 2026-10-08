<?php

namespace Database\Seeders;

use App\Models\AttributeCatalogue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class AttributeCatalogueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AttributeCatalogue::insert([
            [
                'name' => 'Màu Sắc',
                'image' => null,
                'description' => null,
                'slug' => 'mau-sac',
                'user_id' => 2,
                'publish' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kích thước',
                'image' => null,
                'description' => null,
                'slug' => 'kich-thuoc',
                'user_id' => 2,
                'publish' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Vật liệu',
                'image' => null,
                'description' => null,
                'slug' => 'vat-lieu',
                'user_id' => 2,
                'publish' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
