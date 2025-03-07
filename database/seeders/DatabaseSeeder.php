<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    protected $faker;

    public function __construct()
    {
        $this->faker = Faker::create();
    }

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(6)->create([
            'nome' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'),
            'endereco' => $this->faker->address,
            'telefone' => $this->faker->phoneNumber,
            'data_nascimento' => $this->faker->date,
            'cpf' => $this->faker->cpf,
            'saldo' => $this->faker->randomFloat(2, 0, 10000),
            'foto' => $this->faker->imageUrl,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}