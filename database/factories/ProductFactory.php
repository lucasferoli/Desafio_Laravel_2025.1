<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'photo' => $this->faker->optional()->imageUrl,
            'name' => $this->faker->word,
            'price' => $this->faker->randomFloat(2, 1, 1000),
            'quantity' => $this->faker->numberBetween(1, 100),
            'description' => $this->faker->sentence,
            'category' => $this->faker->word,
            'advertiser_id' => User::inRandomOrder()->first()->id, 
        ];
    }
}
