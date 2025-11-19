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
        
       
        
         // ✅ Ajoutez cette ligne
        Route::get('/announcements/{id}', [StudentDashboardController::class, 'showAnnouncement'])->name('announcements.show');
    
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
 // Routes Enseignant - Réservations (CORRIGÉES)
Route::middleware(['auth', 'role:teacher'])->prefix('enseignant')->name('enseignant.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [TeacherDashboardController::class, 'index'])->name('dashboard');
    
    // Salles et matériels
    Route::get('/rooms', [TeacherDashboardController::class, 'rooms'])->name('rooms');
    Route::get('/salles', [TeacherDashboardController::class, 'rooms'])->name('salles');
    
    // Réservations - CRUD complet
    Route::get('/reservations', [TeacherDashboardController::class, 'reservations'])->name('reservations');
    Route::post('/reservations', [TeacherDashboardController::class, 'storeReservation'])->name('reservations.store');
    Route::get('/reservations/{id}', [TeacherDashboardController::class, 'showReservation'])->name('reservations.show');
    Route::get('/reservations/{id}/edit', [TeacherDashboardController::class, 'editReservation'])->name('reservations.edit');
    Route::put('/reservations/{id}', [TeacherDashboardController::class, 'updateReservation'])->name('reservations.update');
    Route::patch('/reservations/{id}/cancel', [TeacherDashboardController::class, 'cancelReservation'])->name('reservations.cancel');
    Route::delete('/reservations/{id}', [TeacherDashboardController::class, 'destroyReservation'])->name('reservations.destroy');
    
    // Annonces
    Route::get('/announcements', [TeacherDashboardController::class, 'announcements'])->name('announcements');
    Route::post('/announcements', [TeacherDashboardController::class, 'storeAnnouncement'])->name('announcements.store');
    Route::put('/announcements/{id}', [TeacherDashboardController::class, 'updateAnnouncement'])->name('announcements.update');
    Route::delete('/announcements/{id}', [TeacherDashboardController::class, 'destroyAnnouncement'])->name('announcements.destroy');
    Route::get('/annonces', [TeacherDashboardController::class, 'announcements'])->name('annonces');
    
    // Profil
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


Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    // Profil
    Route::get('/profil', [AdminDashboardController::class, 'profil'])->name('profil');
    Route::put('/profil', [AdminDashboardController::class, 'updateProfil'])->name('profil.update');
    
    // Utilisateurs - TOUT dans un seul fichier
    Route::get('/users', [AdminDashboardController::class, 'users'])->name('users.index');
    Route::post('/users/store', [AdminDashboardController::class, 'storeUser'])->name('users.store');
    Route::put('/users/{id}', [AdminDashboardController::class, 'updateUser'])->name('users.update');
    Route::delete('/users/{id}', [AdminDashboardController::class, 'destroyUser'])->name('users.destroy');
    
     // Gestion des annonces
     Route::get('/announcements', [AdminDashboardController::class, 'announcements'])->name('announcements');
     Route::post('/announcements', [AdminDashboardController::class, 'storeAnnouncement'])->name('announcements.store');
     Route::put('/announcements/{id}', [AdminDashboardController::class, 'updateAnnouncement'])->name('announcements.update');
     Route::delete('/announcements/{id}', [AdminDashboardController::class, 'destroyAnnouncement'])->name('announcements.destroy');
 
     // Réservations
     Route::get('/reservations', [AdminDashboardController::class, 'reservations'])->name('reservations');
     Route::put('/reservations/{id}/approve', [AdminDashboardController::class, 'approveReservation'])->name('reservations.approve');
     Route::put('/reservations/{id}/reject', [AdminDashboardController::class, 'rejectReservation'])->name('reservations.reject');
     Route::delete('/reservations/{id}', [AdminDashboardController::class, 'destroyReservation'])->name('reservations.destroy');
     
     // Ressources
     Route::get('/ressources', [AdminDashboardController::class, 'ressources'])->name('ressources');
     
     // Salles
     Route::post('/rooms', [AdminDashboardController::class, 'storeRoom'])->name('rooms.store');
     Route::put('/rooms/{id}', [AdminDashboardController::class, 'updateRoom'])->name('rooms.update');
     Route::delete('/rooms/{id}', [AdminDashboardController::class, 'destroyRoom'])->name('rooms.destroy');
     
     // Matériels
     Route::post('/materials', [AdminDashboardController::class, 'storeMaterial'])->name('materials.store');
     Route::put('/materials/{id}', [AdminDashboardController::class, 'updateMaterial'])->name('materials.update');
     Route::delete('/materials/{id}', [AdminDashboardController::class, 'destroyMaterial'])->name('materials.destroy');
 
     /////
    // Ressources (Salles & Matériels) - TOUT dans un seul fichier
    Route::get('/ressources', [AdminDashboardController::class, 'ressources'])->name('ressources.index');
    Route::post('/rooms/store', [AdminDashboardController::class, 'storeRoom'])->name('rooms.store');
    Route::put('/rooms/{id}', [AdminDashboardController::class, 'updateRoom'])->name('rooms.update');
    Route::delete('/rooms/{id}', [AdminDashboardController::class, 'destroyRoom'])->name('rooms.destroy');
    Route::post('/materials/store', [AdminDashboardController::class, 'storeMaterial'])->name('materials.store');
    Route::put('/materials/{id}', [AdminDashboardController::class, 'updateMaterial'])->name('materials.update');
    Route::delete('/materials/{id}', [AdminDashboardController::class, 'destroyMaterial'])->name('materials.destroy');
    // Statistiques
    Route::get('/stats', [AdminDashboardController::class, 'stats'])->name('stats.index');
    ////
});
    
    // Routes générales de ressources (avec contrôleurs appropriés selon le rôle)
    Route::resource('announcements', AnnouncementController::class);
    Route::resource('announcement-categories', AnnouncementCategoryController::class)->middleware('role:admin');
    Route::resource('rooms', RoomController::class);
    Route::resource('materials', MaterialController::class);
    Route::resource('reservations', ReservationController::class);
});