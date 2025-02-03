<?php

// database/seeders/CustomerSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    public function run()
    {
        Customer::create([
            'name' => 'John Doe',
            'email' => 'test@example.com', // Changed to a unique email
            'gender' => 'male',
            'address' => '123 Main St',
            'state' => 'California',
            'country' => 'USA',
            'dob' => '1990-01-01',
            'password' => bcrypt('password123'), // Use bcrypt to hash passwords
        ]);


    }
}

