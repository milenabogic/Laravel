<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\ClientsController;
use App\Http\Controllers\API\EmployeesController;
use App\Http\Controllers\API\ProjectsController;
use App\Http\Controllers\API\TimeSheetController;

Route::post('create_employee', [EmployeesController::class, 'create']);
Route::get('list_all_employees', [EmployeesController::class, 'list_all_employees']);
Route::get('show_one_employee/{id}', [EmployeesController::class, 'one_employee']);
Route::get('search/{name}', [EmployeesController::class, 'search']);
Route::post('login', [EmployeesController::class, 'login']);
Route::put('update_employee', [EmployeesController::class, 'update']);
Route::delete('delete_employee/{id}', [EmployeesController::class, 'delete']);

Route::post('create_client', [ClientsController::class, 'create']);
Route::get('list_all_clients', [ClientsController::class, 'list_all_clients']);
Route::get('show_one_client/{id}', [ClientsController::class, 'show_one_client']);
Route::get('search/{name}', [ClientsController::class, 'search']);
Route::put('update_client', [ClientsController::class, 'update']);
Route::delete('delete_client/{id}', [ClientsController::class, 'delete']);

Route::post('create_project', [ProjectsController::class, 'create']);
Route::get('list_all_projects', [ProjectsController::class, 'list_all_projects']);
Route::get('show_one_project/{id}', [ProjectsController::class, 'one_project']);
Route::get('search/{name}', [ProjectsController::class, 'search']);
Route::put('update_project', [ProjectsController::class, 'update']);
Route::delete('delete_project/{id}', [ProjectsController::class, 'delete']);

Route::post('create_timesheet', [TimeSheetController::class, 'create']);
Route::put('update_timesheet', [TimesheetController::class, 'update']);


