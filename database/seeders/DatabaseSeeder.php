<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->createMany(
            [
                // [
                //     'name' => 'thanh trung',
                //     'email' => 'admin@gmail.com',
                //     'password' => Hash::make('thanhtrung'),
                //     'user_catalogue_id' => 2
                // ],
                [
                    'name' => 'bao trung',
                    'email' => 'baotrung@gmail.com',
                    'password' => Hash::make('baotrung'),
                    'user_catalogue_id' => 2
                ],
                [
                    'name' => 'hong thai',
                    'email' => 'hongthai@gmail.com',
                    'password' => Hash::make('hongthai'),
                    'user_catalogue_id' => 2
                ],
                [
                    'name' => 'binh phuoc',
                    'email' => 'binhphuoc@gmail.com',
                    'password' => Hash::make('binhphuoc'),
                    'user_catalogue_id' => 2
                ],
                [
                    'name' => 'ngoc phi',
                    'email' => 'ngocphi@gmail.com',
                    'password' => Hash::make('ngocphi'),
                    'user_catalogue_id' => 2
                ],
            ]
        );
    }
}
