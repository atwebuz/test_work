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
            'post_id' => 1,
            'images' => 'tort.jpg'
        ]);
        Images::create([
            'post_id' => 2,
            'images' => 'smuzi.jpg'
        ]);
        Images::create([
            'post_id' => 3,
            'images' => 'avganski.jpg'
        ]);
      
        }
}
