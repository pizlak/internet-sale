<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        return [
            'title' => $this->faker->words(2, true),
            'description' => $this->faker->sentence(),
            'image' => 'images/default.jpg',
            'price' => $this->faker->randomFloat(2, 1, 1000),
            'count' => $this->faker->numberBetween(1,100),
            'user_id' => User::get()->random()->id,
            'category_id' => Category::get()->random()->id,
        ];
    }
}
