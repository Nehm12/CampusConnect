<?php

namespace Database\Seeders;

use App\Models\Announcement;
use App\Models\AnnouncementCategory;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnnouncementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teacher = User::where('email', 'teacher@ifri.bj')->first();
        $admin = User::where('email', 'admin@ifri.bj')->first();
        
        $examCategory = AnnouncementCategory::where('slug', 'examen')->first();
        $soutenanceCategory = AnnouncementCategory::where('slug', 'soutenance')->first();

        // Annonces spécifiques
        Announcement::create([
            'title' => 'Examen Framework Laravel - Session Normale',
            'category_id' => $examCategory?->id,
            'description' => "L'examen de Framework Laravel pour la classe de GL3 aura lieu le 15 décembre 2025 à 8h00 dans l'Amphithéâtre A.\n\nDurée : 3 heures\nDocuments autorisés : Aucun\nMatériel : Ordinateur portable obligatoire",
            'user_id' => $teacher?->id ?? User::factory()->teacher(),
            'published_at' => now()->subDays(2),
            'is_pinned' => true,
        ]);

        Announcement::create([
            'title' => 'Soutenances Projets GL3 - Calendrier',
            'category_id' => $soutenanceCategory?->id,
            'description' => "Les soutenances des projets de fin d'année pour GL3 se dérouleront du 20 au 22 décembre 2025.\n\nChaque groupe disposera de 30 minutes (20 min présentation + 10 min questions).\n\nLe planning détaillé sera communiqué la semaine prochaine.",
            'user_id' => $admin?->id ?? User::factory()->admin(),
            'published_at' => now()->subDays(5),
            'is_pinned' => true,
        ]);

        // Annonces aléatoires
        Announcement::factory()->published()->count(25)->create();
        Announcement::factory()->pinned()->count(3)->create();
        Announcement::factory()->draft()->count(5)->create();

        $this->command->info('✅ ' . Announcement::count() . ' annonces créées');
    }
}