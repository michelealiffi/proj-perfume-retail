<?php

use App\Http\Controllers\Admin\PerfumeController as AdminPerfumeController;
use App\Http\Controllers\Guest\PerfumeController as GuestPerfumeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::prefix('admin')->middleware('auth', 'admin')->group(function () {
    Route::resource('perfumes', AdminPerfumeController::class)->parameters([
        'perfumes' => 'slug',
    ]);

    Route::get('/admin/perfumes', function () {
        return view('admin.perfumes.index');
    })->middleware('admin');
});

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

require __DIR__ . '/auth.php';
