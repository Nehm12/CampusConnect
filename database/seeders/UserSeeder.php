<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Créer des comptes de test spécifiques
        User::create([
            'firstname' => 'Admin',
            'lastname' => 'IFRI',
            'name' => 'Admin IFRI',
            'email' => 'admin@ifri.bj',
            'telephone' => '+229 12 34 56 78',
            'role' => 'admin',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        User::create([
            'firstname' => 'Maryse',
            'lastname' => 'GAHOU',
            'name' => 'Ing. GAHOU Maryse',
            'email' => 'teacher@ifri.bj',
            'telephone' => '+229 98 76 54 32',
            'role' => 'enseignant',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        User::create([
            'firstname' => 'Alice',
            'lastname' => 'AKPOVI',
            'name' => 'Alice AKPOVI',
            'email' => 'student@ifri.bj',
            'telephone' => '+229 67 89 01 23',
            'role' => 'etudiant',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        // Créer des utilisateurs aléatoires
        User::factory()->admin()->count(2)->create();
        User::factory()->teacher()->count(15)->create();
        User::factory()->student()->count(100)->create();

        $this->command->info('✅ ' . User::count() . ' utilisateurs créés');
    }
}