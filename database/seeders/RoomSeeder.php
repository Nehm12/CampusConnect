<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Room;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rooms = [
            // Bâtiment A - Salles de cours classiques
            [
                'name' => 'Salle A101',
                'code' => 'A101',
                'capacity' => 30,
                'location' => 'Bâtiment A, RDC',
                'notes' => 'Salle de cours équipée d\'un tableau blanc et d\'un projecteur. Idéale pour les cours magistraux.',
            ],
            [
                'name' => 'Salle A102',
                'code' => 'A102',
                'capacity' => 25,
                'location' => 'Bâtiment A, RDC',
                'notes' => 'Salle de cours avec disposition en U. Parfaite pour les séminaires et discussions.',
            ],
            [
                'name' => 'Salle A201',
                'code' => 'A201',
                'capacity' => 40,
                'location' => 'Bâtiment A, 1er étage',
                'notes' => 'Grande salle de cours avec amphithéâtre. Salle avec enregistrement possible.',
            ],
            [
                'name' => 'Salle A202',
                'code' => 'A202',
                'capacity' => 35,
                'location' => 'Bâtiment A, 1er étage',
                'notes' => 'Salle modulable avec tables mobiles. Configuration flexible pour travaux de groupe.',
            ],
            
            // Bâtiment B - Salles informatiques
            [
                'name' => 'Laboratoire Informatique B101',
                'code' => 'LAB-B101',
                'capacity' => 20,
                'location' => 'Bâtiment B, RDC',
                'notes' => 'Laboratoire informatique avec 20 postes. Réservé aux cours de programmation.',
            ],
            [
                'name' => 'Laboratoire Réseau B102',
                'code' => 'LAB-B102',
                'capacity' => 25,
                'location' => 'Bâtiment B, RDC',
                'notes' => 'Laboratoire réseau et systèmes. Équipé pour les cours réseaux avec switches et routeurs.',
            ],
            [
                'name' => 'Laboratoire Développement B201',
                'code' => 'LAB-B201',
                'capacity' => 15,
                'location' => 'Bâtiment B, 1er étage',
                'notes' => 'Laboratoire de développement avancé. Pour projets et développement avec PC haute performance.',
            ],
            
            // Bâtiment C - Salles spécialisées
            [
                'name' => 'Salle de Conférence Principale',
                'code' => 'CONF-C001',
                'capacity' => 100,
                'location' => 'Bâtiment C, RDC',
                'notes' => 'Grande salle de conférence avec scène. Pour événements et conférences importantes.',
            ],
            [
                'name' => 'Salle de Réunion C101',
                'code' => 'MEET-C101',
                'capacity' => 12,
                'location' => 'Bâtiment C, 1er étage',
                'notes' => 'Salle de réunion avec table ovale et visioconférence. Idéale pour réunions et soutenances.',
            ],
            [
                'name' => 'Salle Créative C102',
                'code' => 'CREA-C102',
                'capacity' => 18,
                'location' => 'Bâtiment C, 1er étage',
                'notes' => 'Espace créatif avec murs blancs et matériel de brainstorming. Pour workshops créatifs.',
            ],
            
            // Salles spéciales
            [
                'name' => 'Amphithéâtre Principal',
                'code' => 'AMPHI-MAIN',
                'capacity' => 200,
                'location' => 'Bâtiment Principal',
                'notes' => 'Grand amphithéâtre principal du campus. Système son complet et éclairage scène.',
            ],
            [
                'name' => 'Salle Multimédia',
                'code' => 'MEDIA-001',
                'capacity' => 28,
                'location' => 'Bâtiment Multimédia',
                'notes' => 'Salle équipée pour production audiovisuelle avec caméras HD et table de mixage.',
            ],
            [
                'name' => 'Espace Coworking',
                'code' => 'COWRK-001',
                'capacity' => 24,
                'location' => 'Espace Innovation',
                'notes' => 'Espace de travail collaboratif moderne. WiFi haute vitesse et mobilier modulable.',
            ],
            [
                'name' => 'Salle d\'Examen E001',
                'code' => 'EXAM-E001',
                'capacity' => 50,
                'location' => 'Bâtiment Examens',
                'notes' => 'Salle spécialement aménagée pour examens. Configuration anti-triche, silence requis.',
            ],
            [
                'name' => 'Salle de TP Physique',
                'code' => 'TP-PHYS',
                'capacity' => 16,
                'location' => 'Bâtiment Sciences',
                'notes' => 'Laboratoire de travaux pratiques en physique. Équipements de mesure disponibles.',
            ],
        ];

        foreach ($rooms as $room) {
            Room::create($room);
        }
    }
}