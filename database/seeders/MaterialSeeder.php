<?php

namespace Database\Seeders;

use App\Models\Material;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Matériels spécifiques
        $specificMaterials = [
            [
                'name' => 'Vidéoprojecteur portable',
                'code' => 'VP-001',
                'quantity_total' => 5,
                'location' => 'Bureau technique, Bâtiment A',
                'notes' => 'Résolution 1080p, HDMI + VGA',
            ],
            [
                'name' => 'Ordinateur portable',
                'code' => 'PC-PORT-001',
                'quantity_total' => 3,
                'location' => 'Bureau technique, Bâtiment A',
                'notes' => 'Dell Latitude, Windows 11, Office installé',
            ],
            [
                'name' => 'Microphone sans fil',
                'code' => 'MIC-001',
                'quantity_total' => 4,
                'location' => 'Bureau technique, Bâtiment A',
                'notes' => 'Portée 50m, 2 piles AA',
            ],
            [
                'name' => 'Caméra pour enregistrement',
                'code' => 'CAM-001',
                'quantity_total' => 2,
                'location' => 'Bureau technique, Bâtiment A',
                'notes' => 'Canon EOS, trépied inclus, carte SD 64GB',
            ],
        ];

        foreach ($specificMaterials as $material) {
            Material::create($material);
        }

        // Matériels aléatoires
        Material::factory()->count(20)->create();

        $this->command->info('✅ ' . Material::count() . ' matériels créés');
    }
}