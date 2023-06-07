<?php

use ConfrariaWeb\User\Controllers\Api\AuthController;
use ConfrariaWeb\User\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::apiResource('users', UserController::class);

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
