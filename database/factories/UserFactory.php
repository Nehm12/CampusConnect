<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $firstname = fake()->firstName();
        $lastname = fake()->lastName();

        return [
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => fake()->unique()->safeEmail(),
            'telephone' => fake()->phoneNumber(),
            'role' => fake()->randomElement(['etudiant', 'enseignant', 'admin']),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * État pour un étudiant
     */
    public function student()
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'etudiant',
        ]);
    }

    /**
     * État pour un enseignant
     */
    public function teacher()
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'enseignant',
        ]);
    }

    /**
     * État pour un admin
     */
    public function admin()
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'admin',
        ]);
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}