<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FilmController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//  Регистрация
Route::post('/register' , [AuthController::class, 'register' ]);
//  Авторизация
Route::post('/login' , [AuthController::class, 'login' ]);
//  Выход
Route::middleware('auth:api')->get('/logout', [AuthController::class, 'logout']);


// Просмотр всех фильмов
Route::get('/film' , [FilmController::class, 'index' ]);
Route::post('/film', [FilmController::class, 'create']);
Route::get('/film/{id}' , [FilmController::class, 'show' ]);
Route::patch('/film/{id}' , [FilmController::class, 'update' ]);
Route::delete('/film/{id}' , [FilmController::class, 'destroy' ]);





