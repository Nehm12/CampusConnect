<?php

namespace Database\Seeders;

use App\Models\Announcement;
use App\Models\AnnouncementCategory;
use App\Models\Material;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->command->info('🌱 Début du seeding...');
        
        // Ordre important : respecter les dépendances
        $this->call([
            UserSeeder::class,
            AnnouncementCategorySeeder::class,
            AnnouncementSeeder::class,
            RoomSeeder::class,
            MaterialSeeder::class,
            ReservationSeeder::class,
        ]);

        $this->command->info('');
        $this->command->info('🎉 Seeding terminé avec succès !');
        $this->command->info('');
        $this->command->info('📧 Comptes de test :');
        $this->command->table(
            ['Email', 'Password', 'Role'],
            [
                ['admin@ifri.bj', 'password', 'Admin'],
                ['teacher@ifri.bj', 'password', 'Enseignant'],
                ['student@ifri.bj', 'password', 'Étudiant'],
            ]
        );
    }
}