<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('categories', 'CategoryController');
Route::apiResource('users', 'UsersController');
Route::apiResource('rol', 'RolController');
Route::apiResource('passwords', 'PasswordsController');

Route::apiResource('login','LoginController@login');
Route::apiResource('register', 'RegistrationController');

