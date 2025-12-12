<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ParticipantController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use App\Models\Transaction;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. Halaman Depan (Landing Page)
Route::get('/', function () {
    return view('welcome');
});

// 2. Logic Pengalihan Dashboard (Redirect setelah Login)
Route::get('/dashboard', function () {
    $user = Auth::user();
    
    if (!$user) {
        return redirect('/login');
    }

    if ($user->role === 'admin') return redirect()->route('admin.dashboard');
    if ($user->role === 'eo') return redirect()->route('eo.dashboard');
    
    return redirect()->route('user.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// ====================================================
// GRUP 1: Khusus SUPER ADMIN
// ====================================================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard'); 
    })->name('dashboard');
    
    // Nanti taruh route manajemen user/kategori disini
});


// ====================================================
// GRUP 2: Khusus EO (Event Organizer)
// ====================================================
Route::middleware(['auth', 'role:eo'])->prefix('eo')->name('eo.')->group(function () {
    
    // A. Dashboard EO (Dengan Logika Statistik)
    Route::get('/dashboard', function () {
        $userId = Auth::id();

        // Hitung Total Event buatan sendiri
        $totalEvent = Event::where('user_id', $userId)->count();

        // Hitung Total Peserta
        $totalPeserta = Transaction::whereHas('event', function($q) use ($userId) {
            $q->where('user_id', $userId);
        })->count();

        // Hitung Pendapatan
        $pendapatan = Transaction::whereHas('event', function($q) use ($userId) {
            $q->where('user_id', $userId);
        })->where('status', 'confirmed')
          ->with('event')
          ->get()
          ->sum(function($trx) {
              return $trx->event->price;
          });

        return view('eo.dashboard', compact('totalEvent', 'totalPeserta', 'pendapatan'));
    })->name('dashboard');

    // B. Manajemen Event (CRUD)
    Route::resource('events', EventController::class);

    // C. Manajemen Peserta (Validasi)
    Route::get('/participants', [ParticipantController::class, 'index'])->name('participants.index');
    Route::post('/participants/{id}/approve', [ParticipantController::class, 'approve'])->name('participants.approve');
    Route::post('/participants/{id}/reject', [ParticipantController::class, 'reject'])->name('participants.reject');
});


// ====================================================
// GRUP 3: Khusus PESERTA (User)
// ====================================================
Route::middleware(['auth', 'role:user'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', function () {
        return view('user.dashboard'); 
    })->name('dashboard');
    
    // Nanti taruh route booking tiket disini
});


// ====================================================
// PROFILE ROUTES (Bawaan Laravel Breeze)
// ====================================================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';