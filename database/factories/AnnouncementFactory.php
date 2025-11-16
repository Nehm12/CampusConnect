<?php

namespace Database\Factories;

use App\Models\AnnouncementCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Announcement>
 */
class AnnouncementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $titles = [
            'Examen de Framework Laravel - Session Normale',
            'Soutenances des projets de fin d\'année',
            'Inscription aux cours optionnels',
            'Conférence sur l\'Intelligence Artificielle',
            'Stage en entreprise - Offre disponible',
            'Résultats du semestre 1',
            'Hackathon IFRI 2026',
            'Remise de diplômes',
            'Journée portes ouvertes',
            'Séminaire sur la Cybersécurité'
        ];

        return [
            'title' => fake()->randomElement($titles),
            'category_id' => AnnouncementCategory::inRandomOrder()->first()?->id 
                          ?? AnnouncementCategory::factory(),
            'description' => fake()->paragraphs(3, true),
            'user_id' => User::whereIn('role', ['teacher', 'admin'])->inRandomOrder()->first()?->id 
                      ?? User::factory()->teacher(),
            'published_at' => fake()->boolean(80) ? fake()->dateTimeBetween('-30 days', 'now') : null,
            'is_pinned' => fake()->boolean(15),
        ];
    }

    public function published()
    {
        return $this->state(fn (array $attributes) => [
            'published_at' => fake()->dateTimeBetween('-10 days', 'now'),
        ]);
    }

    public function draft()
    {
        return $this->state(fn (array $attributes) => [
            'published_at' => null,
        ]);
    }

    public function pinned()
    {
        return $this->state(fn (array $attributes) => [
            'is_pinned' => true,
            'published_at' => fake()->dateTimeBetween('-5 days', 'now'),
        ]);
    }
}