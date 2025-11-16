<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Salles spécifiques
        $specificRooms = [
            [
                'name' => 'Amphithéâtre A',
                'code' => 'AMPHI-A',
                'capacity' => 200,
                'location' => 'Bâtiment principal, RDC',
                'notes' => 'Vidéoprojecteur fixe, système audio, climatisation',
            ],
            [
                'name' => 'Salle TP Informatique 1',
                'code' => 'TP-INFO-1',
                'capacity' => 30,
                'location' => 'Bâtiment B, 1er étage',
                'notes' => '30 ordinateurs sous Linux, tableau blanc interactif',
            ],
            [
                'name' => 'Salle TP Informatique 2',
                'code' => 'TP-INFO-2',
                'capacity' => 30,
                'location' => 'Bâtiment B, 1er étage',
                'notes' => '30 ordinateurs sous Windows, vidéoprojecteur',
            ],
            [
                'name' => 'Salle de cours C101',
                'code' => 'C-101',
                'capacity' => 50,
                'location' => 'Bâtiment C, 1er étage',
                'notes' => 'Vidéoprojecteur mobile, climatisation',
            ],
            [
                'name' => 'Salle de réunion',
                'code' => 'REUNION-1',
                'capacity' => 15,
                'location' => 'Bâtiment administratif, 2e étage',
                'notes' => 'Écran TV 55 pouces, visioconférence',
            ],
        ];

        foreach ($specificRooms as $room) {
            Room::create($room);
        }

        // Salles aléatoires
        Room::factory()->count(15)->create();

        $this->command->info('✅ ' . Room::count() . ' salles créées');
    }

}