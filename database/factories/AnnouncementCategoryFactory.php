<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AnnouncementCategory>
 */
class AnnouncementCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->unique()->randomElement([
            'Examen',
            'Soutenance',
            'Activité',
            'Appel à candidature',
            'Stage',
            'Séminaire',
            'Conférence',
            'Information générale',
            'Inscription',
            'Résultats'
        ]);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
        ];
    }
}