<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Routes pour admin

Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('admin.index');
    })->name('admin.dashboard');

    Route::get('/annonces', function () {
        return view('admin.annonces.index');
    })->name('admin.annonces.index');

    Route::post('annonces/create', function () {
        return view('admin.annonces.create');
    })->name('admin.annonces.create');

    Route::post('annonces/update', function () {
        return view('admin.annonces.upate');
    })->name('admin.annonces.update');

    Route::get('annonces/show', function () {
        return view('admin.annonces.show');
    })->name('admin.annonces.show');

    Route::get('/users', function () {
        return view('admin.users.index');
    })->name('admin.users.index');

    Route::post('/users/create', function () {
        return view('admin.users.create');
    })->name('admin.users.create');

    Route::post('/users/update', function () {
        return view('admin.users.edit');
    })->name('admin.users.edit');

    Route::get('/users/show', function () {
        return view('admin.users.show');
    })->name('admin.users.show');
});


//Routes pour enseignants

Route::prefix('enseignant')->group(function () {
    // Page des annonces
    Route::get('/', function () {
        return view('enseignant.announcements.index');
    })->name('enseignant.announcements.index');

    Route::post('/create', function () {
        return view('enseignant.announcements.create');
    })->name('enseignant.announcements.create');

    Route::post('/update', function () {
        return view('enseignant.announcements.edit');
    })->name('enseignant.announcements.edit');

    Route::post('/show', function () {
        return view('enseignant.announcements.show');
    })->name('enseignant.announcements.show');

});

//Routes pour étudiants

Route::prefix('etudiant')->group(function () {
    // Page des annonces
    Route::get('/', function () {
        return view('etudiant.announcements.index');
    })->name('etudiant.announcements.index');

});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
