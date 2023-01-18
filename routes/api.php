<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', [ApiController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
Route::post('create-career', [ApiController::class, 'createCareer']);
Route::post('create-application', [ApiController::class, 'createApplication']);
Route::get('careers', [ApiController::class, 'listCareers']);
Route::get('applications', [ApiController::class, 'listApplications']);
});




