<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\{
    DashboardController,
    AdminDashboardController,
    TeacherDashboardController,
    StudentDashboardController
};
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\AnnouncementCategoryController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\ReservationController; 
use App\Http\Middleware\RedirectIfAuthenticated;

/*
|--------------------------------------------------------------------------
| Routes publiques (Guest) - Redirige si connecté
|--------------------------------------------------------------------------
*/

// Page d'accueil - redirige vers dashboard si connecté
Route::middleware(['guest'])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('welcome');

    // Page À propos
    Route::get('/about', function () {
        return view('about');
    })->name('about');

    // Page Contact
    Route::get('/contact', function () {
        return view('contact');
    })->name('contact');
});

/*
|--------------------------------------------------------------------------
| Routes d'authentification (Laravel Breeze)
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| Routes protégées (Authentification requise)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {
    
    // Redirection depuis /dashboard vers le dashboard approprié selon le rôle
    Route::get('/dashboard', function () {
        $user = \Illuminate\Support\Facades\Auth::user();
        
        return match($user->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'teacher' => redirect()->route('enseignant.dashboard'),
            'student' => redirect()->route('etudiant.dashboard'),
            default => redirect()->route('welcome'),
        };
    })->name('dashboard');
    
    /*
    |--------------------------------------------------------------------------
    | Routes Étudiant
    |--------------------------------------------------------------------------
    */
    Route::prefix('etudiant')->name('etudiant.')->middleware('role:student')->group(function () {
        // Dashboard étudiant avec données
        Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('dashboard');
        
        // Annonces pour étudiants
        Route::get('/announcements', [StudentDashboardController::class, 'announcements'])->name('announcements');
        Route::get('/annonces', [StudentDashboardController::class, 'announcements'])->name('annonces'); // Alias français
        
        Route::get('/announcements/{id}', function($id) {
            return view('dashboard.etudiant.announcements-detail', compact('id'));
        })->name('announcements.show');
        
        Route::get('/annonces/{id}', function($id) {
            return view('dashboard.etudiant.annonces-detail', compact('id'));
        })->name('annonces.show'); // Alias français
        
        // Salles et matériels pour étudiants
        Route::get('/rooms', [StudentDashboardController::class, 'rooms'])->name('rooms');
        Route::get('/salles', [StudentDashboardController::class, 'rooms'])->name('salles'); // Alias français
        
        // Profil étudiant
        Route::get('/profil', [StudentDashboardController::class, 'profil'])->name('profil');
        Route::get('/profil/edit', [StudentDashboardController::class, 'editProfil'])->name('profil.edit');
        Route::put('/profil', [StudentDashboardController::class, 'updateProfil'])->name('profil.update');
        Route::put('/profil/password', [StudentDashboardController::class, 'updatePassword'])->name('profil.password');
    });
          /*
    |--------------------------------------------------------------------------
    | Routes Enseignant
    |--------------------------------------------------------------------------
    */
    Route::prefix('enseignant')->name('enseignant.')->middleware('role:teacher')->group(function () {
        // Dashboard enseignant avec données
        Route::get('/dashboard', [TeacherDashboardController::class, 'index'])->name('dashboard');
        
        // Salles et matériels pour enseignants avec réservation
        Route::get('/rooms', [TeacherDashboardController::class, 'rooms'])->name('rooms');
        Route::get('/salles', [TeacherDashboardController::class, 'rooms'])->name('salles'); // Alias français
        
        // Annonces enseignant - CRUD complet
        Route::get('/announcements', [TeacherDashboardController::class, 'announcements'])->name('announcements');
        Route::post('/announcements', [TeacherDashboardController::class, 'storeAnnouncement'])->name('announcements.store');
        Route::put('/announcements/{id}', [TeacherDashboardController::class, 'updateAnnouncement'])->name('announcements.update');
        Route::delete('/announcements/{id}', [TeacherDashboardController::class, 'destroyAnnouncement'])->name('announcements.destroy');
        Route::get('/annonces', [TeacherDashboardController::class, 'announcements'])->name('annonces'); // Alias français
        
        // Réservations enseignant - CRUD complet
        Route::get('/reservations', [TeacherDashboardController::class, 'reservations'])->name('reservations');
        Route::post('/reservations', [TeacherDashboardController::class, 'storeReservation'])->name('reservations.store');
        Route::put('/reservations/{id}', [TeacherDashboardController::class, 'updateReservation'])->name('reservations.update');
        Route::delete('/reservations/{id}', [TeacherDashboardController::class, 'destroyReservation'])->name('reservations.destroy');
        
        // Routes spécifiques pour les réservations
        Route::post('/reservations/room/{room}', [TeacherDashboardController::class, 'reserveRoom'])->name('reservations.room');
        Route::post('/reservations/material/{material}', [TeacherDashboardController::class, 'reserveMaterial'])->name('reservations.material');
        Route::get('/reservations/{id}/cancel', [TeacherDashboardController::class, 'cancelReservation'])->name('reservations.cancel');
        
        // Vérification de disponibilité (AJAX)
        Route::get('/check-availability', [TeacherDashboardController::class, 'checkAvailability'])->name('check.availability');
        
        // Profil enseignant
        Route::get('/profil', [TeacherDashboardController::class, 'profil'])->name('profil');
        Route::get('/profil/edit', [TeacherDashboardController::class, 'editProfil'])->name('profil.edit');
        Route::put('/profil', [TeacherDashboardController::class, 'updateProfil'])->name('profil.update');
        Route::put('/profil/password', [TeacherDashboardController::class, 'updatePassword'])->name('profil.password');
    });
    
    /*
    |--------------------------------------------------------------------------
    | Routes Admin
    |--------------------------------------------------------------------------
    */
    Route::prefix('admin')->name('admin.')->middleware('role:admin')->group(function () {
        // Dashboard admin avec données
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        
        // Gestion des utilisateurs
        Route::get('/users', function() {
            return view('dashboard.admin.users.index');
        })->name('users.index');
        
        Route::get('/users/create', function() {
            return view('dashboard.admin.users.create');
        })->name('users.create');
        
        Route::get('/users/{id}/edit', function($id) {
            return view('dashboard.admin.users.edit', compact('id'));
        })->name('users.edit');
        
        // Validation des réservations
        Route::get('/reservations', function() {
            return view('dashboard.admin.reservations');
        })->name('reservations');
        
        // Gestion des annonces
        Route::get('/announcements', function() {
            return view('dashboard.admin.announcements');
        })->name('announcements');
        
        Route::get('/annonces', function() {
            return view('dashboard.admin.annonces');
        })->name('annonces'); // Alias français
        
        // Gestion des ressources
        Route::get('/resources', function() {
            return view('dashboard.admin.resources');
        })->name('resources');
        
        Route::get('/ressources', function() {
            return view('dashboard.admin.ressources');
        })->name('ressources'); // Alias français
        
        // Statistiques
        Route::get('/stats', function() {
            return view('dashboard.admin.stats');
        })->name('stats');
    });
    
    // Routes générales de ressources (avec contrôleurs appropriés selon le rôle)
    Route::resource('announcements', AnnouncementController::class);
    Route::resource('announcement-categories', AnnouncementCategoryController::class)->middleware('role:admin');
    Route::resource('rooms', RoomController::class);
    Route::resource('materials', MaterialController::class);
    Route::resource('reservations', ReservationController::class);
});