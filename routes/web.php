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
use App\Http\Controllers\OrdDetailsController;


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
Route::middleware(['auth:sanctum', 'verified'])->get('/api/calendar/getdata',[CalendarsController::class, 'getdata']);

//Rutas Categoria
Route::middleware(['auth:sanctum', 'verified'])->get('/categoria',[CategoryProdsController::class, 'index'])->name('categoria');
Route::middleware(['auth:sanctum', 'verified'])->get('/api/categoria/index2',[CategoryProdsController::class, 'index2']);
Route::middleware(['auth:sanctum', 'verified'])->post('/api/categoria/registrar',[CategoryProdsController::class, 'store']);
Route::middleware(['auth:sanctum', 'verified'])->put('/api/categoria/actualizar',[CategoryProdsController::class, 'update']);
Route::middleware(['auth:sanctum', 'verified'])->post('/api/categoria/eliminar',[CategoryProdsController::class, 'destroy']);
Route::middleware(['auth:sanctum', 'verified'])->get('/api/categoria/getdata',[CategoryProdsController::class, 'getdata']);

//Rutas Productos
Route::middleware(['auth:sanctum', 'verified'])->get('/producto',[ProductsController::class, 'index'])->name('producto');
Route::middleware(['auth:sanctum', 'verified'])->get('/api/producto/index2',[ProductsController::class, 'index2']);
Route::middleware(['auth:sanctum', 'verified'])->post('/api/producto/registrar',[ProductsController::class, 'store']);
Route::middleware(['auth:sanctum', 'verified'])->put('/api/producto/actualizar',[ProductsController::class, 'update']);
Route::middleware(['auth:sanctum', 'verified'])->post('/api/producto/eliminar',[ProductsController::class, 'destroy']);
Route::middleware(['auth:sanctum', 'verified'])->get('/api/producto/getdata',[ProductsController::class, 'getdata']);

//Rutas Tipo Documentos
Route::middleware(['auth:sanctum', 'verified'])->get('/tipodoc',[DocTypesController::class, 'index'])->name('tipodoc');
Route::middleware(['auth:sanctum', 'verified'])->get('/api/tipodoc/index2',[DocTypesController::class, 'index2']);
Route::middleware(['auth:sanctum', 'verified'])->post('/api/tipodoc/registrar',[DocTypesController::class, 'store']);
Route::middleware(['auth:sanctum', 'verified'])->put('/api/tipodoc/actualizar',[DocTypesController::class, 'update']);
Route::middleware(['auth:sanctum', 'verified'])->post('/api/tipodoc/eliminar',[DocTypesController::class, 'destroy']);
Route::middleware(['auth:sanctum', 'verified'])->get('/api/tipodoc/getdata',[DocTypesController::class, 'getdata']);

//Rutas Tipo Usuarios
Route::middleware(['auth:sanctum', 'verified'])->get('/tipouser',[TypeUsersController::class, 'index'])->name('tipouser');
Route::middleware(['auth:sanctum', 'verified'])->get('/api/tipouser/index2',[TypeUsersController::class, 'index2']);
Route::middleware(['auth:sanctum', 'verified'])->post('/api/tipouser/registrar',[TypeUsersController::class, 'store']);
Route::middleware(['auth:sanctum', 'verified'])->put('/api/tipouser/actualizar',[TypeUsersController::class, 'update']);
Route::middleware(['auth:sanctum', 'verified'])->post('/api/tipouser/eliminar',[TypeUsersController::class, 'destroy']);
Route::middleware(['auth:sanctum', 'verified'])->get('/api/tipouser/getdata',[TypeUsersController::class, 'getdata']);

//Rutas Usuarios
Route::middleware(['auth:sanctum', 'verified'])->get('/user',[AppUsersController::class, 'index'])->name('user');
Route::middleware(['auth:sanctum', 'verified'])->get('/api/user/index2',[AppUsersController::class, 'index2']);
Route::middleware(['auth:sanctum', 'verified'])->post('/api/user/registrar',[AppUsersController::class, 'store']);
Route::middleware(['auth:sanctum', 'verified'])->put('/api/user/actualizar',[AppUsersController::class, 'update']);
Route::middleware(['auth:sanctum', 'verified'])->post('/api/user/eliminar',[AppUsersController::class, 'destroy']);
Route::middleware(['auth:sanctum', 'verified'])->get('/api/user/getdata',[AppUsersController::class, 'getdata']);

//Rutas Pedidos
Route::middleware(['auth:sanctum', 'verified'])->get('/order',[OrdersController::class, 'index'])->name('order');
Route::middleware(['auth:sanctum', 'verified'])->get('/api/order/index2',[OrdersController::class, 'index2']);

Route::middleware(['auth:sanctum', 'verified'])->get('/api/detalle/index2',[OrdDetailsController::class, 'index2']);
Route::middleware(['auth:sanctum', 'verified'])->get('/api/detalle/getdata',[OrdDetailsController::class, 'getdata']);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');