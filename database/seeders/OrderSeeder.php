<?php

// database/seeders/OrderSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;

class OrderSeeder extends Seeder
{
    public function run()
    {
        Order::create([
            'customer_id' => 1, // Assuming customer ID 1 exists
            'product_name' => 'Product A',
            'quantity' => 2,
            'total_price' => 39.99,
        ]);

        Order::create([
            'customer_id' => 2, // Assuming customer ID 2 exists
            'product_name' => 'Product B',
            'quantity' => 1,
            'total_price' => 19.99,
        ]);

        // Add more orders as needed
    }
}

