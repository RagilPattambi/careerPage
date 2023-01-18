<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\ApplicationController;

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

Route::get('/', [Careercontroller::class, 'index']);

Route::get('/login', [UserController::class, 'login'])
    ->name('login')
    ->middleware('guest');

Route::post('/user/authenticate', [UserController::class, 'authenticate']);
Route::get('/logout', [UserController::class, 'logout'])
    ->middleware('auth');
Route::post('apply', [ApplicationController::class, 'store'])
->middleware('auth');
Route::get('application', [ApplicationController::class, 'index'])
->middleware('auth');
Route::get('application/download/{id}', [ApplicationController::class, 'download'])
->middleware('auth');
Route::post('career/store', [Careercontroller::class, 'store'])
->middleware('auth');