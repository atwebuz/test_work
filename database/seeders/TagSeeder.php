<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $tags = [
        ['name' => 'super mazali'],
        ['name' => 'mega mazali'],
        ['name' => 'gipe mazali'],
      
       ];

       Tag::insert($tags);
    }
}
