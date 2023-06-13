<?php

use App\Http\Controllers\AcademicosController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\CoordinacionController;
use App\Http\Controllers\DesarrolloController;
use App\Http\Controllers\DocentesController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
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

Route::get('/', function () {
    return Inertia::render('Inicio');
})->name('home');


Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::prefix('desarrollo')->middleware(['auth', 'role:Jefe del Departamento de Desarrollo Academico|Coordinacion de FD y AP'])->group(function (){


    Route::get('/parametros', [DesarrolloController::class, 'parametros'])->middleware(['auth', 'role:Jefe del Departamento de Desarrollo Academico'])->name('parametros');
    Route::put('/carrera-editada/{id}', [DesarrolloController::class, 'update'])->middleware(['auth', 'role:Jefe del Departamento de Desarrollo Academico']);



    Route::get('/coordinacion/deteccion', [CoordinacionController::class, 'index'])->name('index.necesidad');
    Route::put('/coordinacion/observaciones/{id}', [CoordinacionController::class, 'update'])->name('update.observacion');
    Route::get('/coordinacion/registros', [CoordinacionController::class, 'allRegistros'])->name('todos.registros');

    Route::get('/coordinacion/cursos', [CoordinacionController::class, 'indexCursos']);
    Route::post('/coordinacion/guardado/{id}', [CoordinacionController::class, 'store']);
});



Route::prefix('academicos')->middleware(['auth', 'role:Jefes Academicos'])->group(function (){
    Route::get('/docentes', [AcademicosController::class, 'indexDocente']);


    Route::get('/detecciones', [AcademicosController::class, 'index'])->name('index.necesity');
    Route::get('/crear-deteccion', [AcademicosController::class, 'create'])->name('create.necesity');
    Route::post('/save-deteccion', [AcademicosController::class, 'store'])->name('storage.necesity');
    Route::get('/edit-deteccion/{id}', [AcademicosController::class, 'edit'])->name('edit.necesity');
    Route::put('/edited-deteccion/{id}', [AcademicosController::class, 'update'])->name('update.necesity');
    Route::get('/detecciones/todas', [AcademicosController::class, 'show']);
    Route::get('/cursos', [AcademicosController::class, 'cursoIndex']);

});



Route::prefix('docentes')->middleware(['auth', 'role:Jefe del Departamento de Desarrollo Academico|Coordinacion de FD y AP|Docentes|Jefes Academicos'])->group(function (){
    Route::get('/cursos', [DocentesController::class, 'index'])->name('index.docente');

    Route::get('/mis-datos', [DocentesController::class, 'indexMyInfo'])->name('index.docenteInfo');
    Route::post('/guardar', [DocentesController::class, 'store'])->name('store.docente');
    Route::put('/editar/{id}', [DocentesController::class, 'update']);
});


Route::prefix('pdf')->middleware('auth')->group(function (){
   Route::get('/deteccion', [PDFController::class, 'deteccion_pdf']);
});
Route::get('/tectuxtla-logo', [ConfigController::class, 'image']);
Route::get('/tecnm-logo', [ConfigController::class, 'imageTecnm']);

require __DIR__.'/auth.php';
