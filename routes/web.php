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

/*Route::get('/', function () {
    return view('welcome');
});

Route::get('/new', function () {
    return view('new');
});
*/

//Route::get('/', 'EmployeesController@list_all_employees');
Route::get('/', 'EmployeesController@one_employee');
Route::post('/', 'EmployeesController@create');