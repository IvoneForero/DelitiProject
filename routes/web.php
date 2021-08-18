<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryProdsController;
use App\Http\Controllers\DocTypesController;
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
