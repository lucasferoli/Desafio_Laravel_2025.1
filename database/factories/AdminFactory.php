<?php

namespace Database\Factories;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdminFactory extends Factory
{
    protected $model = Admin::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'), // or use Hash::make('password')
            'address' => $this->faker->address,
            'telephone' => $this->faker->phoneNumber,
            'birthday_date' => $this->faker->date,
            'cpf' => $this->faker->numerify('###########'), // Generates a random 11-digit number
            'photo' => $this->faker->optional()->imageUrl,
        ];
    }
}
