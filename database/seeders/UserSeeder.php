<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            // Administrateurs
            [
                'firstname' => 'Admin',
                'lastname' => 'Principal',
                'email' => 'admin@campusconnect.com',
                'telephone' => '0123456789',
                'role' => 'admin',
                'password' => Hash::make('password123'),
            ],
            [
                'firstname' => 'Marie',
                'lastname' => 'Dubois',
                'email' => 'marie.dubois@campusconnect.com',
                'telephone' => '0123456790',
                'role' => 'admin',
                'password' => Hash::make('password123'),
            ],
            

            // Enseignants
            [
                'firstname' => 'Dr. Jean',
                'lastname' => 'Leclerc',
                'email' => 'jean.leclerc@campusconnect.com',
                'telephone' => '0123456792',
                'role' => 'teacher',
                'password' => Hash::make('password123'), 
            ],
            [
                'firstname' => 'Prof. Sophie',
                'lastname' => 'Bernard',
                'email' => 'sophie.bernard@campusconnect.com',
                'telephone' => '0123456793',
                'role' => 'teacher',
                'password' => Hash::make('password123'),
            ],
           

            // Étudiants
            [
                'firstname' => 'Alexandre',
                'lastname' => 'Durand',
                'email' => 'alexandre.durand@etudiant.campusconnect.com',
                'telephone' => '0123456797',
                'role' => 'student',
                'password' => Hash::make('password123'),
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}