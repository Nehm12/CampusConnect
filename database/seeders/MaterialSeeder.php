<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Material;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $materials = [
            // Ordinateurs portables
            [
                'name' => 'MacBook Pro 14"',
                'code' => 'MBP-001',
                'quantity_total' => 5,
                'location' => 'Magasin Informatique',
                'notes' => 'MacBook Pro 14 pouces avec puce M2, 16GB RAM, 512GB SSD. État excellent.',
            ],
            [
                'name' => 'Dell Latitude 5520',
                'code' => 'DLL-LAT',
                'quantity_total' => 8,
                'location' => 'Magasin Informatique',
                'notes' => 'Dell Latitude 15.6", Intel i7, 16GB RAM, 256GB SSD. Pour projets étudiants.',
            ],
            [
                'name' => 'Lenovo ThinkPad X1 Carbon',
                'code' => 'LNV-X1C',
                'quantity_total' => 6,
                'location' => 'Magasin Informatique',
                'notes' => 'ThinkPad X1 Carbon 14", Intel i7, 16GB RAM, 512GB SSD. Ultra-portable.',
            ],
            [
                'name' => 'HP EliteBook 840',
                'code' => 'HP-EB840',
                'quantity_total' => 10,
                'location' => 'Magasin Informatique',
                'notes' => 'HP EliteBook 14", Intel i5, 8GB RAM, 256GB SSD. Usage général.',
            ],
            
            // Projecteurs
            [
                'name' => 'Projecteur Epson EB-X41',
                'code' => 'PROJ-EPS1',
                'quantity_total' => 3,
                'location' => 'Magasin Audiovisuel',
                'notes' => 'Projecteur XGA 3600 lumens, HDMI, VGA. Portable et fiable.',
            ],
            [
                'name' => 'Projecteur Canon LX-MU500',
                'code' => 'PROJ-CAN1',
                'quantity_total' => 2,
                'location' => 'Salle Conférence C001',
                'notes' => 'Projecteur laser 4K, 5000 lumens. Fixe dans salle de conférence.',
            ],
            [
                'name' => 'Projecteur BenQ MS550',
                'code' => 'PROJ-BNQ1',
                'quantity_total' => 4,
                'location' => 'Magasin Audiovisuel',
                'notes' => 'Projecteur DLP SVGA, 3600 lumens. Pour salles de cours standard.',
            ],
            
            // Équipements audiovisuels
            [
                'name' => 'Caméra Sony FX3',
                'code' => 'CAM-SNY1',
                'quantity_total' => 2,
                'location' => 'Salle Multimédia',
                'notes' => 'Caméra cinéma plein format, 4K120p. Pour projets vidéo avancés.',
            ],
            [
                'name' => 'Micro-cravate Sennheiser AVX',
                'code' => 'MIC-SEN1',
                'quantity_total' => 6,
                'location' => 'Magasin Audiovisuel',
                'notes' => 'Système micro-cravate sans fil numérique. Qualité professionnelle.',
            ],
            [
                'name' => 'Table de mixage Yamaha MG12XU',
                'code' => 'MIX-YMH1',
                'quantity_total' => 1,
                'location' => 'Salle Multimédia',
                'notes' => 'Console de mixage 12 canaux avec effets. Installation fixe.',
            ],
            
            // Tablettes et équipements mobiles
            [
                'name' => 'iPad Pro 12.9" M2',
                'code' => 'IPAD-PRO',
                'quantity_total' => 12,
                'location' => 'Magasin Informatique',
                'notes' => 'iPad Pro 12.9" avec puce M2, 256GB, Apple Pencil inclus. Pour design et présentation.',
            ],
            [
                'name' => 'Surface Pro 9',
                'code' => 'SURF-PRO9',
                'quantity_total' => 8,
                'location' => 'Magasin Informatique',
                'notes' => 'Surface Pro 9, Intel i7, 16GB RAM, Type Cover inclus. Hybride laptop/tablette.',
            ],
            [
                'name' => 'Samsung Galaxy Tab S8',
                'code' => 'TABS8-SAM',
                'quantity_total' => 15,
                'location' => 'Magasin Informatique',
                'notes' => 'Galaxy Tab S8 11", S Pen inclus. Pour prise de notes et lecture.',
            ],
            
            // Équipements réseau et serveur
            [
                'name' => 'Routeur Cisco ISR 4321',
                'code' => 'RTR-CSC1',
                'quantity_total' => 3,
                'location' => 'Laboratoire Réseau B102',
                'notes' => 'Routeur Cisco pour laboratoire réseau. Configuration et formation.',
            ],
            [
                'name' => 'Switch Cisco Catalyst 2960',
                'code' => 'SW-CSC2960',
                'quantity_total' => 5,
                'location' => 'Laboratoire Réseau B102',
                'notes' => 'Switch 24 ports pour laboratoire réseau. Apprentissage configuration VLAN.',
            ],
            [
                'name' => 'Serveur Dell PowerEdge R240',
                'code' => 'SRV-DLL1',
                'quantity_total' => 2,
                'location' => 'Salle Serveur',
                'notes' => 'Serveur rack 1U, Intel Xeon, 16GB RAM. Pour projets infrastructure.',
            ],
            
            // Accessoires informatiques
            [
                'name' => 'Écran portable ASUS 15.6"',
                'code' => 'MON-ASU1',
                'quantity_total' => 20,
                'location' => 'Magasin Informatique',
                'notes' => 'Écran portable 15.6" USB-C, Full HD. Complément pour laptops.',
            ],
            [
                'name' => 'Casque Sony WH-1000XM4',
                'code' => 'HDQ-SNY1',
                'quantity_total' => 15,
                'location' => 'Magasin Audiovisuel',
                'notes' => 'Casque sans fil à réduction de bruit active. Pour travail concentration.',
            ],
            [
                'name' => 'Disque dur externe Seagate 2TB',
                'code' => 'HDD-SEA2T',
                'quantity_total' => 25,
                'location' => 'Magasin Informatique',
                'notes' => 'Disque dur externe portable 2TB USB 3.0. Sauvegarde et transfert.',
            ],
            [
                'name' => 'Clé USB SanDisk 64GB',
                'code' => 'USB-SAN64',
                'quantity_total' => 50,
                'location' => 'Magasin Informatique',
                'notes' => 'Clé USB 3.0 haute vitesse 64GB. Usage général étudiants.',
            ],
            
            // Équipements spécialisés
            [
                'name' => 'Imprimante 3D Prusa i3 MK3S+',
                'code' => '3DP-PRS1',
                'quantity_total' => 2,
                'location' => 'Atelier Fabrication',
                'notes' => 'Imprimante 3D haute précision. Pour prototypage et projets innovation.',
            ],
            [
                'name' => 'Oscilloscope Rigol DS1054Z',
                'code' => 'OSC-RIG1',
                'quantity_total' => 4,
                'location' => 'Laboratoire Électronique',
                'notes' => 'Oscilloscope numérique 4 canaux 50MHz. Pour TP électronique.',
            ],
            [
                'name' => 'Multimètre Fluke 117',
                'code' => 'DMM-FLK1',
                'quantity_total' => 12,
                'location' => 'Laboratoire Électronique',
                'notes' => 'Multimètre True RMS. Mesures électriques précises.',
            ],
        ];

        foreach ($materials as $material) {
            Material::create($material);
        }
    }
}