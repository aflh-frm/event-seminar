<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
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





Route::get('/', function () {
    return view('welcome'); // Halaman depan (Landing Page)
});

// Jalur PENGALIHAN setelah login
Route::get('/dashboard', function () {
    // Gunakan Auth::user() yang lebih stabil
    $user = Auth::user(); 
    
    // Cek jaga-jaga (opsional), memastikan user benar-benar ada
    if (!$user) {
        return redirect('/login');
    }

    $role = $user->role;

    if ($role === 'admin') return redirect()->route('admin.dashboard');
    if ($role === 'eo') return redirect()->route('eo.dashboard');
    
    // Default ke user dashboard
    return redirect()->route('user.dashboard');
    
})->middleware(['auth', 'verified'])->name('dashboard');


// GRUP 1: Khusus SUPER ADMIN
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard'); // File view belum dibuat
    })->name('dashboard');
    
    // Nanti taruh route manajemen user/kategori disini
});

// GRUP 2: Khusus EO (Event Organizer)
Route::middleware(['auth', 'role:eo'])->prefix('eo')->name('eo.')->group(function () {
    Route::get('/dashboard', function () {
        return view('eo.dashboard'); 
    })->name('dashboard');

    // Nanti taruh route CRUD Event disini
});

// GRUP 3: Khusus PESERTA (User)
Route::middleware(['auth', 'role:user'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', function () {
        return view('user.dashboard'); 
    })->name('dashboard');
    
    // Nanti taruh route booking tiket disini
});

// GRUP 2: Khusus EO (Event Organizer)
Route::middleware(['auth', 'role:eo'])->prefix('eo')->name('eo.')->group(function () {
    
    Route::get('/dashboard', function () {
        return view('eo.dashboard'); 
    })->name('dashboard');

    // --- TAMBAHKAN BARIS INI ---
    Route::resource('events', \App\Http\Controllers\EventController::class);
    // ----------------------------

});

require __DIR__.'/auth.php';
