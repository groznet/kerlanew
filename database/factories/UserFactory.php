<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'phone' => fake()->unique()->numerify('+79#########'),
            'phone_verified_at' => now(),
            'name' => fake()->firstName(),
            'city_id' => null,
            'show_phone' => false,
            'role' => 'user',
            'status' => 'active',
            'last_login_at' => null,
        ];
    }
}
