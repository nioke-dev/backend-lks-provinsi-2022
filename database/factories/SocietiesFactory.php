<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Societies>
 */
class SocietiesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id_card_number' => mt_rand(100, 999),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'name' => $this->faker->name(),
            'born_date' => $this->faker->date(),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'address' => $this->faker->address(),
            'regional_id' => mt_rand(1, 10),
            'login_tokens' => Str::random(30),
        ];
    }
}
