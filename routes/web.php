<?php

use App\Http\Controllers\Controladores\CursoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Roles\AdminController;
use App\Http\Controllers\Roles\ProfesorController;
use App\Http\Controllers\Roles\PadreFamiliaController;
use App\Http\Controllers\Controladores\AlumnoController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Controladores\NivelController;
use App\Http\Controllers\Controladores\SeccionController;
use App\Http\Controllers\Controladores\GradoController;
use App\Http\Controllers\Controladores\AreaAcademicaController;
use App\Models\User;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Storage;
use Google\Cloud\Storage\StorageClient;
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
    Route::get('/profesor/dashboard/{gmail}', [ProfesorController::class, 'index'])
        ->name('profesor.dashboard')
        ->middleware('role:' . User::ROLES[1]);

    // Ruta para el dashboard del padre de familia
    Route::get('/padre_familia/dashboard/{gmail}', [PadreFamiliaController::class, 'index'])
        ->name('padre_familia.dashboard')
        ->middleware('role:' . User::ROLES[2]);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('alumnos')->group(function () {
    Route::get('/', [AlumnoController::class, 'index'])->name('alumnos.index');
    Route::get('/create', [AlumnoController::class, 'create'])->name('alumnos.create');
    Route::post('/', [AlumnoController::class, 'store'])->name('alumnos.store');
    Route::get('/{id}', [AlumnoController::class, 'show'])->name('alumnos.show');
    Route::get('/{id}/edit', [AlumnoController::class, 'edit'])->name('alumnos.edit');
    Route::put('/{id}', [AlumnoController::class, 'update'])->name('alumnos.update');
    Route::get('/{id}/confirmar', [AlumnoController::class, 'confirmar'])->name('alumnos.confirmar');
    Route::delete('/{id}', [AlumnoController::class, 'destroy'])->name('alumnos.destroy');
});

Route::prefix('nivels')->group(function () {
    Route::get('/', [NivelController::class, 'index'])->name('nivels.index');
    Route::get('/create', [NivelController::class, 'create'])->name('nivels.create');
    Route::post('/', [NivelController::class, 'store'])->name('nivels.store');
    Route::get('/{nivel}', [NivelController::class, 'show'])->name('nivels.show');
    Route::get('/{nivel}/edit', [NivelController::class, 'edit'])->name('nivels.edit');
    Route::put('/{nivel}', [NivelController::class, 'update'])->name('nivels.update');
    Route::delete('/{nivel}', [NivelController::class, 'destroy'])->name('nivels.destroy');
});

Route::prefix('secciones')->group(function () {
    Route::get('/', [SeccionController::class, 'index'])->name('secciones.index');
    Route::get('/create', [SeccionController::class, 'create'])->name('secciones.create');
    Route::post('/', [SeccionController::class, 'store'])->name('secciones.store');
    Route::get('/{id_seccion}', [SeccionController::class, 'show'])->name('secciones.show');
    Route::get('/{id_seccion}/edit', [SeccionController::class, 'edit'])->name('secciones.edit');
    Route::put('/{id_seccion}', [SeccionController::class, 'update'])->name('secciones.update');
    Route::delete('/{id_seccion}', [SeccionController::class, 'destroy'])->name('secciones.destroy');
    Route::get('/grado/{id_grado}', [SeccionController::class, 'getSeccionesByGrado'])->name('secciones.by.grado');
});

Route::prefix('grados')->group(function () {
    Route::get('/', [GradoController::class, 'index'])->name('grados.index');
    Route::get('/create', [GradoController::class, 'create'])->name('grados.create');
    Route::post('/', [GradoController::class, 'store'])->name('grados.store');
    Route::get('/{grado}', [GradoController::class, 'show'])->name('grados.show');
    Route::get('/{grado}/edit', [GradoController::class, 'edit'])->name('grados.edit');
    Route::put('/{grado}', [GradoController::class, 'update'])->name('grados.update');
    Route::delete('/{grado}', [GradoController::class, 'destroy'])->name('grados.destroy');
});

Route::prefix('areas')->group(function () {
    Route::get('/', [AreaAcademicaController::class, 'index'])->name('areas.index');
    Route::get('/create', [AreaAcademicaController::class, 'create'])->name('areas.create');
    Route::post('/', [AreaAcademicaController::class, 'store'])->name('areas.store');
    Route::get('/{id_area_academica}/edit', [AreaAcademicaController::class, 'edit'])->name('areas.edit');
    Route::put('/{id_area_academica}', [AreaAcademicaController::class, 'update'])->name('areas.update');
    Route::get('/{id_area_academica}/confirmar', [AreaAcademicaController::class, 'confirmar'])->name('areas.confirmar');
    Route::delete('/{id_area_academica}', [AreaAcademicaController::class, 'destroy'])->name('areas.destroy');
});

Route::get('/get-ciudades', [AlumnoController::class, 'getCiudades'])->name('alumnos.get-ciudades');
Route::get('/get-distritos', [AlumnoController::class, 'getDistritos'])->name('alumnos.get-distritos');

Route::get('/hijos/{id_alumno}', [PadreFamiliaController::class, 'show'])->name('padre_familia.show');

Route::resource('cursos', CursoController::class);
Route::get('/cursos_index/{nivel}', [CursoController::class, 'index'])->name('cursos.index');
Route::get('/cursos_create/{nivel}', [CursoController::class, 'create'])->name('cursos.create');
Route::get('/cursos_edit/{curso}', [CursoController::class, 'edit'])->name('cursos.edit');

Route::get('/profesor_alumnos/{curso}', [ProfesorController::class, 'show'])->name('profesor.show');


require __DIR__.'/auth.php';
