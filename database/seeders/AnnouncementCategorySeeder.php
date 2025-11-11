<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AnnouncementCategory;

class AnnouncementCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Informations Générales',
                'slug' => 'informations-generales',
            ],
            [
                'name' => 'Événements',
                'slug' => 'evenements',
            ],
            [
                'name' => 'Cours et Formations',
                'slug' => 'cours-formations',
            ],
            [
                'name' => 'Examens',
                'slug' => 'examens',
            ],
            [
                'name' => 'Urgences',
                'slug' => 'urgences',
            ],
            [
                'name' => 'Vie Étudiante',
                'slug' => 'vie-etudiante',
            ],
            [
                'name' => 'Maintenance',
                'slug' => 'maintenance',
            ],
            [
                'name' => 'Inscriptions',
                'slug' => 'inscriptions',
            ],
            [
                'name' => 'Bourses et Aides',
                'slug' => 'bourses-aides',
            ],
            [
                'name' => 'Stages et Emplois',
                'slug' => 'stages-emplois',
            ],
            [
                'name' => 'Ressources Numériques',
                'slug' => 'ressources-numeriques',
            ],
            [
                'name' => 'Transport',
                'slug' => 'transport',
            ],
            [
                'name' => 'Santé et Sécurité',
                'slug' => 'sante-securite',
            ],
            [
                'name' => 'Associations',
                'slug' => 'associations',
            ],
            [
                'name' => 'Bibliothèque',
                'slug' => 'bibliotheque',
            ],
        ];

        foreach ($categories as $category) {
            AnnouncementCategory::create($category);
        }
    }
}