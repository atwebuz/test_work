<?php

namespace Database\Seeders;

use App\Models\Images;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Images::create([
            'product_id' => 1,
            'images' => 'book.jpg'
        ]);
        Images::create([
            'product_id' => 1,
            'images' => 'img2.png'
        ]);

        Images::create([
            'product_id' => 2,
            'images' => 'book.jpg'
        ]);
        Images::create([
            'product_id' => 2,
            'images' => 'img2.png'
        ]);
    }
}
