<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\SessionController;


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




// Функционал администратора
Route::middleware('auth:api', 'role:admin')->group(function () {

});

// Функционал администратора
// Создание жанра
Route::post('/genre' , [GenreController::class, 'create' ]);
// Обновление жанра
Route::post('/genre/{id}' , [GenreController::class, 'update' ]); // - не сделано
// Удаление жанра
Route::delete('/genre/{id}' , [GenreController::class, 'destroy' ]);

// Добавление фильма
Route::post('/film', [FilmController::class, 'create']);
// Обновление фильма
Route::post('/film/{id}' , [FilmController::class, 'update' ]); // - фотки выдают проблемы и остаются - пока работает
// Удаление фильма
Route::delete('/film/{id}' , [FilmController::class, 'destroy' ]);

// Добавление сеанса
Route::post('/session' , [SessionController::class, 'create' ]);
// Обновление сеанса
Route::patch('/session' , [SessionController::class, 'update' ]);
// Удаление сеанса
Route::delete('/session' , [SessionController::class, 'destroy' ]);


// Функционал менеджера



// Функционал пользователя
// Просмотр всех фильмов
Route::get('/film' , [FilmController::class, 'index' ]);
// Просмотр конкретного фильма
Route::get('/film/{id}' , [FilmController::class, 'show' ]);
// Просмотр жанров
Route::get('/genre' , [GenreController::class, 'index' ]);
// Просмотр сеансов
Route::get('/session' , [SessionController::class, 'index' ]);




