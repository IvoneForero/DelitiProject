<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\CalendarsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CategoryProdsController;
use App\Http\Controllers\DocTypesController;
use App\Http\Controllers\TypeUsersController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

//Rutas Agenda
Route::middleware(['auth:sanctum', 'verified'])->get('/agenda',[CalendarsController::class, 'index'])->name('agenda');

//Rutas Categoria
Route::middleware(['auth:sanctum', 'verified'])->get('/categoria',[CategoryProdsController::class, 'index'])->name('categoria');

//Rutas Productos
Route::middleware(['auth:sanctum', 'verified'])->get('/producto',[ProductsController::class, 'index'])->name('producto');

//Rutas Tipo Documentos
Route::middleware(['auth:sanctum', 'verified'])->get('/tipodoc',[DocTypesController::class, 'index'])->name('tipodoc');

//Rutas Tipo Usuarios
Route::middleware(['auth:sanctum', 'verified'])->get('/tipouser',[TypeUsersController::class, 'index'])->name('tipouser');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');