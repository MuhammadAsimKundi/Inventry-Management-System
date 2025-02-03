<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::create([
            'name' => 'Sample Product',
            'category' => 'Category 1',
            'quantity' => 4, // Low stock
            'stock_price' => 50,
            'retail_price' => 100,
            'description' => 'This is a sample product.',
        ]);
    }
}
