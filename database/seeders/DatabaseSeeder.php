<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Rizky',
            'email' => 'rizky@mail.com',
            'password' => 'rizky'
        ]);

        $categories = ['Kemeja', 'Kaos', 'Celana Panjang', 'Celana Pendek', 'Sepatu', 'Jaket'];

        foreach ($categories as $category) {
            Category::factory()->create([
                'title' => $category,
                'user_id' => 1
            ]);
        }
    }
}
