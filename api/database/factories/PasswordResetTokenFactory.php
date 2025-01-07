<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PasswordResetToken>
 */
class PasswordResetTokenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'token'      => Str::random(100),
            'created_at' => now(),
            'expires_at' => now()->addMinutes(config('PASSWORD_RESET_TOKEN_EXPIRATION_TIME', 60))->toDateTime(),
        ];
    }
}
