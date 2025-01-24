<?php

use App\Http\Controllers\Admin\PerfumeController as AdminPerfumeController;
use App\Http\Controllers\Guest\PerfumeController as GuestPerfumeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [GuestPerfumeController::class, 'index'])->name('home');

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('perfumes', AdminPerfumeController::class)->parameters([
        'perfumes' => 'id',
    ]);

    Route::get('/dashboard', function () {
        return view('admin.perfumes.index');
    })->name('dashboard');
});

require __DIR__ . '/auth.php';
