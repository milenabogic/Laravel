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
//Route::post('register', [RegisterController::class, 'register']);
//Route::post('login', [RegisterController::class, 'login']);

Route::post('employee', [EmployeesController::class, 'create']);
//Route::get('employee', [EmployeesController::class, 'list_all_employees']);
Route::get('employee/{id}', [EmployeesController::class, 'one_employee']);
Route::get('search/{name}', [EmployeesController::class, 'search']);


//Route::post('login', [EmployeesController::class, 'login']);
Route::post('client', [ClientsController::class, 'register']);
Route::post('project', [ProjectsController::class, 'register']);
Route::post('timesheet', [TimeSheetController::class, 'register']);




/*Route::middleware('custom_auth')->group(function () {
    Route::get('/projects', function () {
        return "Uspesno!";
    });
});
*/
