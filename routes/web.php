<?php

use App\Http\Controllers\AnnouncementCategoryController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReservationValidationController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Routes nécessitant l'authentification
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile (par Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // MODULE 1 : ANNONCES
    
    
    // Annonces (tous peuvent voir)
    Route::get('/announcements', [AnnouncementController::class, 'index'])->name('announcements.index');
    Route::get('/announcements/{announcement}', [AnnouncementController::class, 'show'])->name('announcements.show');
    
    // Gestion des annonces (Enseignants + Admins)
    Route::middleware('role:teacher,admin')->group(function () {
        Route::get('/announcements/create', [AnnouncementController::class, 'create'])->name('announcements.create');
        Route::post('/announcements', [AnnouncementController::class, 'store'])->name('announcements.store');
        Route::get('/announcements/{announcement}/edit', [AnnouncementController::class, 'edit'])->name('announcements.edit');
        Route::put('/announcements/{announcement}', [AnnouncementController::class, 'update'])->name('announcements.update');
        Route::delete('/announcements/{announcement}', [AnnouncementController::class, 'destroy'])->name('announcements.destroy');
    });

    // Catégories d'annonces (Admin uniquement)
    Route::middleware('role:admin')->prefix('admin')->group(function () {
        Route::resource('categories', AnnouncementCategoryController::class);
    });

    // MODULE 2 : RÉSERVATIONS
    
    // Réservations (tous les utilisateurs authentifiés)
    Route::resource('reservations', ReservationController::class)->except(['edit', 'update']);
    
    // Validation des réservations (Admin uniquement)
    Route::middleware('role:admin')->prefix('admin')->group(function () {
        Route::get('/reservations/pending', [ReservationValidationController::class, 'index'])
            ->name('reservations.pending');
        Route::post('/reservations/{reservation}/approve', [ReservationValidationController::class, 'approve'])
            ->name('reservations.approve');
        Route::post('/reservations/{reservation}/reject', [ReservationValidationController::class, 'reject'])
            ->name('reservations.reject');
    });

    // Salles (consultation pour tous)
    Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');
    Route::get('/rooms/{room}', [RoomController::class, 'show'])->name('rooms.show');
    
    // Gestion des salles (Admin uniquement)
    Route::middleware('role:admin')->group(function () {
        Route::get('/rooms/create', [RoomController::class, 'create'])->name('rooms.create');
        Route::post('/rooms', [RoomController::class, 'store'])->name('rooms.store');
        Route::get('/rooms/{room}/edit', [RoomController::class, 'edit'])->name('rooms.edit');
        Route::put('/rooms/{room}', [RoomController::class, 'update'])->name('rooms.update');
        Route::delete('/rooms/{room}', [RoomController::class, 'destroy'])->name('rooms.destroy');
    });

    // Matériels (consultation pour tous)
    Route::get('/materials', [MaterialController::class, 'index'])->name('materials.index');
    Route::get('/materials/{material}', [MaterialController::class, 'show'])->name('materials.show');
    
    // Gestion des matériels (Admin uniquement)
    Route::middleware('role:admin')->group(function () {
        Route::get('/materials/create', [MaterialController::class, 'create'])->name('materials.create');
        Route::post('/materials', [MaterialController::class, 'store'])->name('materials.store');
        Route::get('/materials/{material}/edit', [MaterialController::class, 'edit'])->name('materials.edit');
        Route::put('/materials/{material}', [MaterialController::class, 'update'])->name('materials.update');
        Route::delete('/materials/{material}', [MaterialController::class, 'destroy'])->name('materials.destroy');
    });
});