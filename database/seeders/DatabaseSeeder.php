<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Admin;
use App\Models\Product;
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
        $imagePath = 'C:/Users/User/Desktop/Desafio Laravel - 2025.1/Desafio_Laravel_2025.1-1/resources/assets/dava.jpeg';

        User::factory(6)->create()->each(function ($user) use ($imagePath) {
            $user->update([
                'name' => $this->faker->name,
                'email' => $this->faker->unique()->safeEmail,
                'password' => bcrypt('password'),
                'address' => $this->faker->address,
                'telephone' => $this->faker->phoneNumber,
                'birth_date' => $this->faker->date,
                'cpf' => $this->faker->numerify('#########'),
                'balance' => $this->faker->randomFloat(2, 0, 10000),
                'photo' => $imagePath,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        });

        Admin::factory(1)->create()->each(function ($admin, $index) use ($imagePath) {
            $admin->update([
                'name' => $index === 0 ? 'Lucas' : 'Admin Name',
                'email' => $index === 0 ? 'lucas@gmail.com' : $this->faker->unique()->safeEmail,
                'password' => $index === 0 ? bcrypt('lucas1234') : bcrypt('adminpassword'),
                'address' => $this->faker->address,
                'telephone' => $this->faker->phoneNumber,
                'birthday_date' => $this->faker->date,
                'cpf' => $this->faker->numerify('#########'),
                'photo' => $imagePath,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        });

        Product::factory(6)->create()->each(function ($product) use ($imagePath) {
            $product->update([
                'photo' => $imagePath,
                'name' => $this->faker->word,
                'price' => $this->faker->randomFloat(2, 1, 1000),
                'quantity' => $this->faker->numberBetween(1, 100),
                'description' => $this->faker->sentence,
                'category' => $this->faker->word,
                'advertiser_id' => User::inRandomOrder()->first()->id, 
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        });
    }
}