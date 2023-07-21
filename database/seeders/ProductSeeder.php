<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'user_id' => 1,
            // 'category_id' => 3,
            'title' => 'Gentra',
            'paragraph' => 'chap eshikda pitno bor tez yursa blinmidi ',
            'price' => 16400,
            'rating' => 3,
            'address' => 'sergeli',

            'created_at' => now(),
            'updated_at' => now()
        ]);
        Product::create([
            'user_id' => 1,
            // 'category_id' => 3,
            'title' => 'Jiguli',
            'paragraph' => 'Xolati alo ideal gap bo`lishi mumkinmas ogan odam mazza qladi',
            'price' => 3400,
            'rating' => 4,
            'address' => 'sergeli',

            'created_at' => now(),
            'updated_at' => now()
        ]);

    }
}
