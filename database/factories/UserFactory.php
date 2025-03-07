<?php
// filepath: c:\Users\User\Desktop\Desafio Laravel - 2025.1\Desafio_Laravel_2025.1-1\database\factories\UserFactory.php
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
            'nome' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'), // or use Hash::make('password')
            'endereco' => $this->faker->address,
            'telefone' => $this->faker->phoneNumber,
            'data_nascimento' => $this->faker->date,
            'cpf' => $this->faker->cpf,
            'foto' => $this->faker->imageUrl,
            'saldo' => $this->faker->randomFloat(2, 0, 10000),
            'remember_token' => Str::random(10),
        ];
    }
}