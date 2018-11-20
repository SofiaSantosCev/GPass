<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('categories', 'CategoryController');
Route::apiResource('users', 'UsersController');
Route::apiResource('rol', 'RolController');
Route::apiResource('passwords', 'PasswordsController');

Route::post('login','LoginController@login');
Route::post('registration', 'RegistrationController');

