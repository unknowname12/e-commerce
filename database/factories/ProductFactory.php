<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = Category::all()->random()->id;
        $users = User::all()->random()->id;
        $title = fake()->text(40);
        $slug = Str::slug($title . '-slug');

        return [
            'images' => fake()->imageUrl(200, 200),
            'title' => $title,
            'user_id' => $users,
            'slug' => $slug,
            'price' => fake()->numberBetween(100000, 10000000),
            'category_id' => $categories
        ];
    }
}
