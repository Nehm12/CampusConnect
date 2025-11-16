<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $buildings = ['A', 'B', 'C'];
        $types = ['Amphi', 'Salle TP', 'Salle de cours', 'Salle de réunion', 'Laboratoire'];
        
        $building = fake()->randomElement($buildings);
        $type = fake()->randomElement($types);
        $number = fake()->numberBetween(1, 20);
        
        $name = $type . ' ' . $number;
        $code = strtoupper($building . '-' . str_pad($number, 3, '0', STR_PAD_LEFT));

        $equipments = [
            'Vidéoprojecteur fixe',
            'Tableau blanc interactif',
            'Climatisation',
            'Système audio',
            'Ordinateurs',
            'Prises électriques multiples'
        ];

        return [
            'name' => $name,
            'code' => $code,
            'capacity' => fake()->randomElement([15, 30, 50, 100, 200]),
            'location' => 'Bâtiment ' . $building . ', ' . fake()->randomElement(['RDC', '1er étage', '2e étage']),
            'notes' => implode(', ', fake()->randomElements($equipments, rand(2, 4))),
        ];
    }

    public function large()
    {
        return $this->state(fn (array $attributes) => [
            'capacity' => fake()->numberBetween(100, 300),
        ]);
    }

    public function small()
    {
        return $this->state(fn (array $attributes) => [
            'capacity' => fake()->numberBetween(10, 30),
        ]);
    }
}