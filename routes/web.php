<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| MODULE 2: RÉSERVATIONS - ROUTES FRONTEND
|--------------------------------------------------------------------------
|
| Routes temporaires pour développement frontend
| À intégrer avec les contrôleurs backend plus tard
|
*/

Route::prefix('reservations')->name('reservations.')->group(function () {
    // Dashboard réservations
    Route::get('/', function () {
        return view('reservations.index');
    })->name('index');

    // Créer une réservation
    Route::get('/create', function () {
        return view('reservations.create');
    })->name('create');

    // Consulter les disponibilités
    Route::get('/availability', function () {
        return view('reservations.availability');
    })->name('availability');

    // Mes réservations (historique)
    Route::get('/my-reservations', function () {
        return view('reservations.my-reservations');
    })->name('my-reservations');
});

/*
|--------------------------------------------------------------------------
| ADMIN: VALIDATION DES RÉSERVATIONS
|--------------------------------------------------------------------------
*/

Route::prefix('admin/reservations')->name('admin.reservations.')->group(function () {
    Route::get('/', function () {
        return view('admin.reservations.index');
    })->name('index');
});