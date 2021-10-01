<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\CalendarsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CategoryProdsController;
use App\Http\Controllers\DocTypesController;
use App\Http\Controllers\TypeUsersController;
use App\Http\Controllers\AppUsersController;
use App\Http\Controllers\OrdersController;

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
Route::middleware(['auth:sanctum', 'verified'])->get('/agenda/index',[CalendarsController::class, 'index'])->name('agenda');
Route::middleware(['auth:sanctum', 'verified'])->get('/api/calendar/index2',[CalendarsController::class, 'index2']);
Route::middleware(['auth:sanctum', 'verified'])->post('/api/calendar/registrar',[CalendarsController::class, 'store']);
Route::middleware(['auth:sanctum', 'verified'])->put('/api/calendar/actualizar',[CalendarsController::class, 'update']);
Route::middleware(['auth:sanctum', 'verified'])->post('/api/calendar/eliminar',[CalendarsController::class, 'destroy']);

//Rutas Categoria
Route::middleware(['auth:sanctum', 'verified'])->get('/categoria',[CategoryProdsController::class, 'index'])->name('categoria');
Route::middleware(['auth:sanctum', 'verified'])->get('/api/categoria/index2',[CategoryProdsController::class, 'index2']);
Route::middleware(['auth:sanctum', 'verified'])->post('/api/categoria/registrar',[CategoryProdsController::class, 'store']);
Route::middleware(['auth:sanctum', 'verified'])->put('/api/categoria/actualizar',[CategoryProdsController::class, 'update']);
Route::middleware(['auth:sanctum', 'verified'])->post('/api/categoria/eliminar',[CategoryProdsController::class, 'destroy']);

//Rutas Productos
Route::middleware(['auth:sanctum', 'verified'])->get('/producto',[ProductsController::class, 'index'])->name('producto');

//Rutas Tipo Documentos
Route::middleware(['auth:sanctum', 'verified'])->get('/tipodoc',[DocTypesController::class, 'index'])->name('tipodoc');
Route::middleware(['auth:sanctum', 'verified'])->get('/api/tipodoc/index2',[DocTypesController::class, 'index2']);
Route::middleware(['auth:sanctum', 'verified'])->post('/api/tipodoc/registrar',[DocTypesController::class, 'store']);
Route::middleware(['auth:sanctum', 'verified'])->put('/api/tipodoc/actualizar',[DocTypesController::class, 'update']);
Route::middleware(['auth:sanctum', 'verified'])->post('/api/tipodoc/eliminar',[DocTypesController::class, 'destroy']);

//Rutas Tipo Usuarios
Route::middleware(['auth:sanctum', 'verified'])->get('/tipouser',[TypeUsersController::class, 'index'])->name('tipouser');
Route::middleware(['auth:sanctum', 'verified'])->get('/api/tipouser/index2',[TypeUsersController::class, 'index2']);
Route::middleware(['auth:sanctum', 'verified'])->post('/api/tipouser/registrar',[TypeUsersController::class, 'store']);
Route::middleware(['auth:sanctum', 'verified'])->put('/api/tipouser/actualizar',[TypeUsersController::class, 'update']);
Route::middleware(['auth:sanctum', 'verified'])->post('/api/tipouser/eliminar',[TypeUsersController::class, 'destroy']);

//Rutas Usuarios
Route::middleware(['auth:sanctum', 'verified'])->get('/user',[AppUsersController::class, 'index'])->name('user');

//Rutas Pedidos
Route::middleware(['auth:sanctum', 'verified'])->get('/order',[OrdersController::class, 'index'])->name('order');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');