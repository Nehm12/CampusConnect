<?php

namespace Database\Factories;

use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startTime = fake()->dateTimeBetween('-15 days', '+30 days');
        $duration = fake()->randomElement([1, 2, 3, 4, 6, 8]); // heures
        $endTime = (clone $startTime)->modify("+{$duration} hours");

        $purposes = [
            'Cours de programmation',
            'TP Bases de données',
            'Examen session normale',
            'Soutenance de projet',
            'Réunion pédagogique',
            'Séminaire étudiant',
            'Atelier pratique',
            'Conférence invitée',
            'Travaux dirigés',
            'Session de révision'
        ];

        return [
            'reference' => 'RES-' . strtoupper(Str::random(8)),
            'user_id' => User::whereIn('role', ['teacher', 'student'])->inRandomOrder()->first()?->id 
                      ?? User::factory()->teacher(),
            'room_id' => fake()->boolean(80) ? Room::inRandomOrder()->first()?->id 
                                             : Room::factory(),
            'start_time' => $startTime,
            'end_time' => $endTime,
            'purpose' => fake()->randomElement($purposes),
            'status' => fake()->randomElement(['pending', 'approved', 'rejected']),
            'admin_id' => fake()->boolean(60) ? User::where('role', 'admin')->inRandomOrder()->first()?->id 
                                              : null,
        ];
    }

    public function pending()
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'pending',
            'admin_id' => null,
        ]);
    }

    public function approved()
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'approved',
            'admin_id' => User::where('role', 'admin')->inRandomOrder()->first()?->id 
                       ?? User::factory()->admin(),
        ]);
    }

    public function rejected()
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'rejected',
            'admin_id' => User::where('role', 'admin')->inRandomOrder()->first()?->id 
                       ?? User::factory()->admin(),
        ]);
    }

    public function upcoming()
    {
        $startTime = fake()->dateTimeBetween('+1 day', '+30 days');
        $duration = fake()->randomElement([1, 2, 3, 4]);
        $endTime = (clone $startTime)->modify("+{$duration} hours");

        return $this->state(fn (array $attributes) => [
            'start_time' => $startTime,
            'end_time' => $endTime,
        ]);
    }

    public function past()
    {
        $startTime = fake()->dateTimeBetween('-30 days', '-1 day');
        $duration = fake()->randomElement([1, 2, 3, 4]);
        $endTime = (clone $startTime)->modify("+{$duration} hours");

        return $this->state(fn (array $attributes) => [
            'start_time' => $startTime,
            'end_time' => $endTime,
        ]);
    }

    public function current()
    {
        $startTime = now()->subHours(1);
        $endTime = now()->addHours(2);

        return $this->state(fn (array $attributes) => [
            'start_time' => $startTime,
            'end_time' => $endTime,
            'status' => 'approved',
        ]);
    }
}