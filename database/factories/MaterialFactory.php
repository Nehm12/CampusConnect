<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Material>
 */
class MaterialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $materials = [
            ['name' => 'Vidéoprojecteur', 'prefix' => 'VP', 'qty' => [3, 10]],
            ['name' => 'Ordinateur portable', 'prefix' => 'PC', 'qty' => [2, 8]],
            ['name' => 'Microphone sans fil', 'prefix' => 'MIC', 'qty' => [2, 6]],
            ['name' => 'Caméra', 'prefix' => 'CAM', 'qty' => [1, 4]],
            ['name' => 'Tableau blanc mobile', 'prefix' => 'TB', 'qty' => [2, 5]],
            ['name' => 'Rallonge électrique', 'prefix' => 'ELEC', 'qty' => [5, 15]],
            ['name' => 'Pointeur laser', 'prefix' => 'PTR', 'qty' => [3, 8]],
            ['name' => 'Adaptateur HDMI', 'prefix' => 'HDMI', 'qty' => [5, 12]],
        ];

        $material = fake()->randomElement($materials);
        $number = fake()->unique()->numberBetween(1, 999);

        return [
            'name' => $material['name'],
            'code' => $material['prefix'] . '-' . str_pad($number, 3, '0', STR_PAD_LEFT),
            'quantity_total' => fake()->numberBetween($material['qty'][0], $material['qty'][1]),
            'location' => fake()->randomElement([
                'Bureau technique, Bâtiment A',
                'Salle de stockage, Bâtiment B',
                'Bureau administratif',
                'Labo informatique'
            ]),
            'notes' => fake()->optional()->sentence(),
        ];
    }

    public function inStock()
    {
        return $this->state(fn (array $attributes) => [
            'quantity_total' => fake()->numberBetween(3, 15),
        ]);
    }

    public function limited()
    {
        return $this->state(fn (array $attributes) => [
            'quantity_total' => fake()->numberBetween(1, 2),
        ]);
    }
}