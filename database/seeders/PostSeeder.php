<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      

        Post::create([
            'user_id' => 1,
            'category_id' => 1,
            'title' => 'Tort',
            'paragraph' => 'Biskvitlit tort shirin tvarogiyam bor',
            'price' => 14,
            'rating' => 3,
            "address" => "Sergeli",
            'created_at' => now(),
            'updated_at' => now()
        ]);
      

    }
}
