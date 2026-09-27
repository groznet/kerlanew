<?php

namespace Database\Factories;

use App\Models\Consent;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Consent>
 */
class ConsentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'type' => 'terms',
            'document_version' => '1.0',
            'fields' => null,
            'ip' => fake()->ipv4(),
            'user_agent' => fake()->userAgent(),
            'given_at' => now(),
            'withdrawn_at' => null,
        ];
    }
}
