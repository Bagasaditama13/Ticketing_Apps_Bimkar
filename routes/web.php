<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\TiketController;
use App\Http\Controllers\Admin\HistoriesController;

// Default welcome route
Route::get('/', function () {
    return view('welcome');
});

// Protected routes for authenticated users only
Route::middleware('auth')->group(function () {
    // User profile management routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin routes with 'admin' middleware and 'admin' prefix
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');   

        // Routes for managing categories in admin panel
        Route::resource('categories', CategoryController::class);

        // Routes for managing events in admin panel
        Route::resource('events', EventController::class);

        // Routes for managing tickets in admin panel 
        Route::resource('tickets', TiketController::class);

        // Routes for viewing order histories in admin panel 
        Route::get('/histories', [HistoriesController::class, 'index'])->name('histories.index');
        Route::get('/histories/{id}', [HistoriesController::class, 'show'])->name('histories.show');
    });

});

require __DIR__.'/auth.php';


//Langkah 1: User melihat daftar event
// phpRoute::get('/events', [EventController::class, 'index'])->name('events.index');
// Ketika user mengakses /events, Laravel akan mengarahkan request ke method index() di EventController.
// Controller ini akan mengambil semua event dari database dan menampilkannya di view.

// Langkah 2: User memilih event dan melihat detail
// phpRoute::get('/events/{id}', [EventController::class, 'show'])->name('events.show');
// Ketika user klik event tertentu, Laravel menangkap parameter {id} dari URL dan mengirimnya ke method show().
// Controller akan mengambil data event beserta tiket-tiketnya yang masih available.

// Langkah 3: User melakukan pembelian
// phpRoute::post('/orders', [OrderController::class, 'store'])->name('orders.store');
// Ketika user submit form pembelian, Laravel menangani POST request ini. 
// Route mengarahkan ke method store() di OrderController yang akan:
// Validasi input (tiket yang dipilih, jumlah, dll)
// Cek ketersediaan stok tiket
// Simpan data order ke database
// Kurangi stok tiket
// Redirect ke halaman konfirmasi"