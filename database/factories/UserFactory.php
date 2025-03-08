<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'), 
            'address' => $this->faker->address,
            'telephone' => $this->faker->phoneNumber,
            'birth_date' => $this->faker->date,
            'cpf' => $this->generateCpf(),
            'photo' => $this->faker->imageUrl,
            'balance' => $this->faker->randomFloat(2, 0, 10000),
        ];
    }

    private function generateCpf()
    {
        $cpf = '';
        for ($i = 0; $i < 9; $i++) {
            $cpf .= $this->faker->numberBetween(0, 9);
        }
        return $cpf;
    }
}

