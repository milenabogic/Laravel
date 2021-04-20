<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\ClientsController;
use App\Http\Controllers\API\EmployeesController;
use App\Http\Controllers\API\ProjectsController;
use App\Http\Controllers\API\TimeSheetController;
use App\Http\Controllers\API\UserController;

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
Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [RegisterController::class, 'login']);

Route::middleware('custom_auth')->group(function () {
    Route::get('/projects', function () {
        return "Uspesno!";
    });
});

// Route::middleware('auth:api')->group( function () {
    Route::resource('employees', EmployeesController::class);
    Route::resource('clients', ClientsController::class);
    Route::resource('time_sheets',  TimeSheetsController::class);
    Route::resource('projects',  ProjectsController::class);
 // });
