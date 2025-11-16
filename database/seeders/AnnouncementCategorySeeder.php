<?php

namespace Database\Seeders;

use App\Models\AnnouncementCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AnnouncementCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Examen',
            'Soutenance',
            'Activité',
            'Appel à candidature',
            'Stage',
            'Séminaire',
            'Information générale',
            'Inscription',
        ];

        foreach ($categories as $category) {
            AnnouncementCategory::create([
                'name' => $category,
                'slug' => Str::slug($category),
            ]);
        }

        $this->command->info('✅ ' . count($categories) . ' catégories créées');
    }
}