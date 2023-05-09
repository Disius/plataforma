<?php

use App\Http\Controllers\AcademicosController;
use App\Http\Controllers\CoordinacionController;
use App\Http\Controllers\DocentesController;
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

Route::prefix('desarrollo')->middleware(['auth', 'role:Coordinacion de FD y AP'])->group(function (){
    Route::get('/coordinacion/deteccion', [CoordinacionController::class, 'index'])->name('index.necesidad');
    Route::put('/coordinacion/observaciones/{id}', [CoordinacionController::class, 'update'])->name('update.observacion');
    Route::put('/coordinacion/aceptado/{id}', [CoordinacionController::class, 'store'])->name('update.aceptado');

    Route::get('/coordinacion/cursos', [CoordinacionController::class, 'indexCursos']);
    Route::post('/coordinacion/guardado', [CoordinacionController::class, 'storeCursos']);
});



Route::prefix('academicos')->middleware(['auth', 'role:Jefes Academicos'])->group(function (){
    Route::get('/docentes', [AcademicosController::class, 'indexDocente']);


    Route::get('/detecciones', [AcademicosController::class, 'index'])->name('index.necesity');
    Route::get('/crear-deteccion', [AcademicosController::class, 'create'])->name('create.necesity');
    Route::post('/save-deteccion', [AcademicosController::class, 'store'])->name('storage.necesity');
    Route::get('/edit-deteccion/{id}', [AcademicosController::class, 'edit'])->name('edit.necesity');
    Route::put('/edited-deteccion/{id}', [AcademicosController::class, 'update'])->name('update.necesity');

    Route::get('/cursos', [AcademicosController::class, 'cursoIndex']);
});



Route::prefix('docentes')->middleware(['auth', 'role:Docentes'])->group(function (){
    Route::get('/cursos', [DocentesController::class, 'index'])->name('index.docente');

    Route::get('/mis-datos', [DocentesController::class, 'indexMyInfo'])->name('index.docenteInfo');
    Route::post('/guardar', [DocentesController::class, 'store'])->name('store.docente');
    Route::post('/guardar/{id}', [DocentesController::class, 'update'])->name('update.info');
});
//Route::middleware('auth')->group(function () {
//    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
//});

require __DIR__.'/auth.php';
