<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email'=> 'admin@gmail.com',
            'password' => Hash::make('secret'),
            'image' => null
         ]);
 
         User::create([
             'name' => 'abdusattorova86',
             'email'=> 'abdusattorova86@gmail.com',
             'password' => Hash::make('12345678'),
             'image' => null
          ]);
    }
}