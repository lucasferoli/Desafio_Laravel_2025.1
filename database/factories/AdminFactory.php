<?php

namespace Database\Factories;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AdminFactory extends Factory
{
    protected $model = Admin::class;

    public function definition()
    {
        return [
            'nome' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'senha' => bcrypt('password'), // or use Hash::make('password')
            'endereco' => $this->faker->address,
            'telefone' => $this->faker->phoneNumber,
            'data_nascimento' => $this->faker->date,
            'cpf' => $this->faker->numerify('###########'), // Generates a random 11-digit number
            'foto' => $this->faker->optional()->imageUrl,
        ];
    }
}
