<?php

namespace Database\Seeders;

use App\Models\UserCatalogue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserCatalogueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserCatalogue::insert([
            [
                'name' => 'Khách Hàng',
                'image' => null,
                'description' => null,
                'keyword' => 'khach-hang',
                'acronym' => 'KH',
                'publish' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Quản trị viên',
                'image' => null,
                'description' => null,
                'keyword' => 'quan-tri-vien',
                'acronym' => 'AD',
                'publish' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
