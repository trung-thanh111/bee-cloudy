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

        User::factory()->createMany([
                [
                    'name' => 'thanh trung',
                    'email' => 'admin@gmail.com',
                    'password' => Hash::make('thanhtrung'),
                ],
                [
                    'name' => 'bao trung',
                    'email' => 'baotrung@gmail.com',
                    'password' => Hash::make('baotrung'),
                ],
                [
                    'name' => 'hong thai',
                    'email' => 'hongthai@gmail.com',
                    'password' => Hash::make('hongthai'),
                ],
                [
                    'name' => 'binh phuoc',
                    'email' => 'binhphuoc@gmail.com',
                    'password' => Hash::make('binhphuoc'),
                ],
                [
                    'name' => 'ngoc phi',
                    'email' => 'ngocphi@gmail.com',
                    'password' => Hash::make('ngocphi'),
                ],
            ]
        );
    }
}
