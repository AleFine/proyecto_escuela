<?php


use App\Http\Controllers\Controladores\PadreController;
use App\Http\Controllers\Controladores\ProfeController; //son para ,os crud


use App\Http\Controllers\Controladores\CursoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Roles\AdminController;
use App\Http\Controllers\Roles\ProfesorController;
use App\Http\Controllers\Roles\PadreFamiliaController; //son para los roles
use App\Http\Controllers\Controladores\AlumnoController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Controladores\NivelController;
use App\Http\Controllers\Controladores\SeccionController;
use App\Http\Controllers\Controladores\GradoController;
use App\Http\Controllers\Controladores\AreaAcademicaController;
use App\Http\Controllers\Controladores\PeriodoController;
use App\Models\User;

use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Storage;
use Google\Cloud\Storage\StorageClient;
use App\Http\Controllers\Controladores\MatriculasController;
use App\Http\Controllers\Controladores\ReporteController;

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

Route::get('/profesor_alumnos/', [ProfesorController::class, 'show'])->name('profesor.show');

//PARA LAS VOSTAS Y CREACION DE LOS CRUDS PADRE Y PROFEE JEJEJE:

Route::resource('padres', PadreController::class);
Route::get('/padre_create', [PadreController::class, 'create'])->name('padres.create');
Route::get('/asignar_hijo/{padre}', [PadreController::class, 'asignar'])->name('padres.asignar');
Route::get('/padre_visualizar/{padre}', [PadreController::class, 'visualizar'])->name('padres.visualizar');
Route::get('/padre_buscar', [PadreController::class, 'search'])->name('padres.search');
Route::post('/asignar_relacion', [PadreController::class,'asignar_relacion'])->name('padres.asignar_relacion');
Route::delete('/eliminar_relacion/{padre}/{estudiante}', [PadreController::class,'eliminar_relacion'])->name('padres.eliminar_relacion');



Route::resource('profes', ProfeController::class);
Route::get('/profe_create', [ProfeController::class, 'create'])->name('profes.create');
Route::get('/profe_visualizar/{profesor}', [ProfeController::class, 'visualizar'])->name('profes.visualizar');
Route::get('/profe_buscar', [ProfeController::class, 'search'])->name('profes.search');
Route::get('/asignar_profesor_primaria/{profesor}', [ProfeController::class, 'asignar_primaria'])->name('profes.asignar_primaria');
Route::get('/asignar_profesor_secundaria/{profesor}', [ProfeController::class, 'asignar_secundaria'])->name('profes.asignar_secundaria');

Route::post('/asignar_seccion_primaria', [ProfeController::class, 'asignar_seccion_primaria'])->name('profes.asignar_seccion_primaria');

Route::post('/asignar_seccion_secundaria', [ProfeController::class, 'asignar_seccion_secundaria'])->name('profes.asignar_seccion_secundaria');

Route::get('/mostrar_cursos_primaria/{profesor}/{seccion}', [ProfeController::class, 'mostrar_cursos_primaria'])->name('profes.mostrar_cursos_primaria');

Route::get('/asignar_curso_secundaria/{profesor}/{seccion}', [ProfeController::class, 'asignar_curso_secundaria'])->name('profes.asignar_curso_secundaria');

Route::post('/registrar_curso_secundaria', [ProfeController::class, 'registrar_curso_secundaria'])->name('profes.registrar_curso_secundaria');

//ELIMINAR SECCION ASIGNADA A UN PROFESOR DE PRIMARIA
Route::delete('/profes/eliminar-asignacion-primaria/{profesor}/{seccion}', [ProfeController::class, 'eliminar_asignacion_primaria'])
    ->name('profes.eliminar_asignacion_primaria');

//ELIMINAR SECCION ASIGNADA A UN PROFESOR DE SECUNDARIA
Route::delete('/profes/{profesor}/eliminar-asignacion-secundaria/{seccion}', [ProfeController::class, 'eliminar_asignacion_secundaria'])
    ->name('profes.eliminar_asignacion_secundaria');


Route::get('/profe/get_grados/{nivelId}', [ProfeController::class, 'getGrados'])->name('profes.getGrados');
Route::get('/profe/get_secciones/{gradoId}', [ProfeController::class, 'getSecciones'])->name('profes.getSecciones');
Route::middleware('auth')->prefix(prefix: 'periodos')->group(function () {
    Route::get('/', [PeriodoController::class, 'index'])->name('periodos.index');
    Route::get('/create', [PeriodoController::class, 'create'])->name('periodos.create');
    Route::post('/', [PeriodoController::class, 'store'])->name('periodos.store');
    Route::get('/{periodo}', [PeriodoController::class, 'show'])->name('periodos.show');
    Route::get('/{periodo}/edit', [PeriodoController::class, 'edit'])->name('periodos.edit');
    Route::put('/{periodo}', [PeriodoController::class, 'update'])->name('periodos.update');
    Route::delete('/{periodo}', [PeriodoController::class, 'destroy'])->name('periodos.destroy');
});

Route::resource('matriculas', MatriculasController::class);

Route::get('/matricula/get_grados/{nivelId}', [MatriculasController::class, 'getGrados'])->name('matriculas.getGrados');
Route::get('/matricula/get_secciones/{gradoId}', [MatriculasController::class, 'getSecciones'])->name('matriculas.getSecciones');

Route::get('/profesor/calificacion/{curso}/{estudiante}', [ProfesorController::class, 'asignar_calificacion'])->name('profesor.asignar_calificacion');
Route::post('/profesor_assing/calificar', [ProfesorController::class, 'calificar_curso'])->name('profesor.calificar_curso');

Route::get('alumno/{id_alumno}/reporte-notas', [ReporteController::class, 'generarReporteNotas'])
    ->name('reporte.notas');    
































Route::get('/padre_familia/notas/{id_curso}/{id_alumno}', [PadreFamiliaController::class, 'verNotas'])
->name('padre_familia.ver_notas');

require __DIR__.'/auth.php';
