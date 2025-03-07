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
        User::factory(6)->create()->each(function ($user) {
            $user->update([
                'name' => $this->faker->name,
                'email' => $this->faker->unique()->safeEmail,
                'password' => bcrypt('password'),
                'address' => $this->faker->address,
                'telephone' => $this->faker->phoneNumber,
                'birth_date' => $this->faker->date,
                'cpf' => $this->faker->numerify('#########'),
                'balance' => $this->faker->randomFloat(2, 0, 10000),
                'photo' => $this->faker->imageUrl,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        });
    }
}