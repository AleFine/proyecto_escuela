<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Roles\AdminController;
use App\Http\Controllers\Roles\ProfesorController;
use App\Http\Controllers\Roles\PadreFamiliaController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Models\User;

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

Route::get('/', [AuthenticatedSessionController::class, 'dashboard']);
Route::get('dashboard', [AuthenticatedSessionController::class, 'dashboard'])->name('dashboard');   

Route::middleware(['auth', 'verified'])->group(function () {

    // Ruta para el dashboard del administrador
    Route::get('/admin/dashboard', [AdminController::class, 'index'])
        ->name('admin.dashboard')
        ->middleware('role:' . User::ROLES[0]); 
    
    // Ruta para el dashboard del profesor
    Route::get('/profesor/dashboard', [ProfesorController::class, 'index'])
        ->name('profesor.dashboard')
        ->middleware('role:' . User::ROLES[1]); 

    // Ruta para el dashboard del padre de familia
    Route::get('/padre_familia/dashboard', [PadreFamiliaController::class, 'index'])
        ->name('padre_familia.dashboard')
        ->middleware('role:' . User::ROLES[2]); 

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';