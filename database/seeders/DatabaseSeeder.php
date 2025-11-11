<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoomSeeder::class,
            MaterialSeeder::class,
            UserSeeder::class,
            AnnouncementCategorySeeder::class,    // Catégories d'annonces
        ]);
    }
}