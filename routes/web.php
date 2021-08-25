<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryProdsController;
use App\Http\Controllers\DocTypesController;
use App\Http\Controllers\CalendarsController;
use App\Http\Controllers\TypeUsersController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\AppUsersController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\DeliveriesController;


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
    return view('welcome');
});

Route::get('/api/catprod/index', [CategoryProdsController::class, 'index']);
Route::get('/api/catprod/getData', [CategoryProdsController::class, 'getData']);
Route::post('/api/catprod/store', [CategoryProdsController::class, 'store']);
Route::put('/api/catprod/update', [CategoryProdsController::class, 'update']);
Route::delete('/api/catprod/delete', [CategoryProdsController::class, 'destroy']);

Route::get('/api/doctype/index', [DocTypesController::class, 'index']);
Route::get('/api/doctype/getData', [DocTypesController::class, 'getData']);
Route::post('/api/doctype/store', [DocTypesController::class, 'store']);
Route::put('/api/doctype/update', [DocTypesController::class, 'update']);
Route::delete('/api/doctype/delete', [DocTypesController::class, 'destroy']);

Route::get('/api/calendar/index', [CalendarsController::class, 'index']);
Route::get('/api/calendar/getData', [CalendarsController::class, 'getData']);
Route::post('/api/calendar/store', [CalendarsController::class, 'store']);
Route::put('/api/calendar/update', [CalendarsController::class, 'update']);
Route::delete('/api/calendar/delete', [CalendarsController::class, 'destroy']);

Route::get('/api/typeuser/index', [TypeUsersController::class, 'index']);
Route::get('/api/typeuser/getData', [TypeUsersController::class, 'getData']);
Route::post('/api/typeuser/store', [TypeUsersController::class, 'store']);
Route::put('/api/typeuser/update', [TypeUsersController::class, 'update']);
Route::delete('/api/typeuser/delete', [TypeUsersController::class, 'destroy']);

Route::get('/api/product/index', [ProductsController::class, 'index']);
Route::get('/api/product/getData', [ProductsController::class, 'getData']);
Route::post('/api/product/store', [ProductsController::class, 'store']);
Route::put('/api/product/update', [ProductsController::class, 'update']);
Route::delete('/api/product/delete', [ProductsController::class, 'destroy']);

Route::get('/api/user/index', [AppUsersController::class, 'index']);
Route::get('/api/user/getData', [AppUsersController::class, 'getData']);
Route::post('/api/user/store', [AppUsersController::class, 'store']);
Route::put('/api/user/update', [AppUsersController::class, 'update']);
Route::delete('/api/user/delete', [AppUsersController::class, 'destroy']);

Route::get('/api/order/index', [OrdersController::class, 'index']);
Route::get('/api/order/getData', [OrdersController::class, 'getData']);
Route::post('/api/order/store', [OrdersController::class, 'store']);
Route::put('/api/order/update', [OrdersController::class, 'update']);
Route::delete('/api/order/delete', [OrdersController::class, 'destroy']);

Route::get('/api/deliverie/index', [DeliveriesController::class, 'index']);
Route::get('/api/deliverie/getData', [DeliveriesController::class, 'getData']);
Route::post('/api/deliverie/store', [DeliveriesController::class, 'store']);
Route::put('/api/deliverie/update', [DeliveriesController::class, 'update']);
Route::delete('/api/deliverie/delete', [DeliveriesController::class, 'destroy']);
