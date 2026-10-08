<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Áo khoác bomber unisex phong cách streetwear',
                'slug' => Str::slug('Áo khoác bomber unisex phong cách streetwear'),
                'brand_id' => 6,
                'short_description' => 'Áo khoác bomber unisex phong cách streetwear phong cách hiện đại.',
                'description' => 'Áo khoác denim thiết kế đơn giản nhưng thời trang, phù hợp cho cả nam và nữ.',
                'sku' => 'LEVENTS-1001',
                'price' => 1000000, 
                
            ],
            
            
        ];

        foreach ($products as $product) {
            $product = DB::table('products')->insertGetId([
                'name' => $product['name'],
                'slug' => $product['slug'],
                'brand' => $product['brand'],
                'short_description' => $product['short_description'],
                'description' => $product['description'],
                'sku' => $product['sku'],
                'price' => $product['price'],
                'created_at' => now(),
                'updated_at' => now()
            ]);

            
        }
    }
}
