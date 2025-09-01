<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JudulHalamanController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

Route::get('/', [PublicController::class, 'index'])->name('home');

// The error "Route [dashboard] not defined" suggests a view is calling route('dashboard').
// A standard Laravel Breeze/Jetstream installation includes this route.
// We can add it here and redirect to the admin dashboard to fix the error.
Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    // Pengaturan Profil
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update'); // Method diubah ke PATCH
    Route::put('/password', [ProfileController::class, 'updatePassword'])->name('password.update'); // Route disesuaikan
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy'); // Route untuk hapus akun ditambahkan

    Route::resource('links', LinkController::class)->except(['show']);

    // Judul Halaman management
    Route::resource('judul-halaman', JudulHalamanController::class)->except(['show']);
    Route::put('judul-halaman/{judulHalaman}/toggle-status', [JudulHalamanController::class, 'toggleStatus'])
        ->name('judul-halaman.toggle-status');

    // Grouped and cleaned up admin routes
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [dashboardController::class, 'dashboard'])->name('dashboard');
        Route::get('/home', [dashboardController::class, 'dashboard'])->name('home'); // Alias for dashboard
    });
});

// Temporary debug route to check card images
//Route::get('/debug/cards-images', function () {
  //  return DB::table('cards')->select('judul', 'gambar')->get();
//});


require __DIR__.'/auth.php';
