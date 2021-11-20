<?php

use Illuminate\Support\Facades\Route;

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

use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index']);

Route::get('/create', [HomeController::class, 'create']);

Route::resource('home', HomeController::class);

//Route::post('createCompany', [HomeController::class, 'store'])->name('createCompany');
Route::delete('/home/{id}/delete', [HomeController::class, 'destroy']);


//Route::get('/home/{id}/edit', [HomeController::class, 'edit']);
Route::post('/home/{id}/edit', [HomeController::class, 'update']);

Auth::routes();
