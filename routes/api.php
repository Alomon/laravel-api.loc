<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [\App\Http\Controllers\Api\AuthController::class, 'register']);
Route::post('/login', [\App\Http\Controllers\Api\AuthController::class, 'login']);
Route::post('/logout', [\App\Http\Controllers\Api\AuthController::class, 'logout'])->middleware('auth:api');


Route::get('/book', [\App\Http\Controllers\BookController::class, 'index']);
Route::get('/book/{id}', [\App\Http\Controllers\BookController::class, 'show']);
Route::post('/book', [\App\Http\Controllers\BookController::class, 'store']);
Route::post('/book/{id}', [\App\Http\Controllers\BookController::class, 'update']);
Route::delete('/book/{id}', [\App\Http\Controllers\BookController::class, 'destroy']);


