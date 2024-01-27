<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cart>
 */
class CartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $users = User::all()->random()->id;
        $products = Product::all()->random()->id;

        return [
            'user_id' => $users,
            'product_id' => $products,
            'status' => mt_rand(0,1),
            'qyt' => mt_rand(1,10)
        ];
    }
}
