<?php

namespace Database\Seeders;

use App\Models\Material;
use App\Models\Reservation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Réservations en attente
        $pendingReservations = Reservation::factory()->pending()->upcoming()->count(10)->create();

        // Réservations approuvées (à venir)
        $approvedReservations = Reservation::factory()->approved()->upcoming()->count(20)->create();

        // Réservations passées
        Reservation::factory()->approved()->past()->count(30)->create();

        // Réservations en cours
        Reservation::factory()->current()->count(3)->create();

        // Réservations rejetées
        Reservation::factory()->rejected()->count(5)->create();

        // Attacher des matériels aléatoires à certaines réservations
        $reservations = Reservation::where('status', 'approved')->take(20)->get();
        $materials = Material::all();

        foreach ($reservations as $reservation) {
            // 70% de chances d'avoir du matériel
            if (rand(1, 100) <= 70) {
                $numberOfMaterials = rand(1, 3);
                $selectedMaterials = $materials->random(min($numberOfMaterials, $materials->count()));
                
                foreach ($selectedMaterials as $material) {
                    $quantity = rand(1, min(3, $material->quantity_total));
                    $reservation->materials()->attach($material->id, ['quantity' => $quantity]);
                }
            }
        }

        $this->command->info('✅ ' . Reservation::count() . ' réservations créées');
    }
}