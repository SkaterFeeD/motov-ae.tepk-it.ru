<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TypeHallController;
use App\Http\Controllers\SessionStatusController;
use App\Http\Controllers\HallController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\CartController;


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
Route::middleware(['auth:api'])->group(function () {
    // Создание жанра
    Route::post('/genre' , [GenreController::class, 'create' ]);
    // Обновление жанра
    Route::post('/genre/{id}' , [GenreController::class, 'update' ]);
    // Удаление жанра
    Route::delete('/genre/{id}' , [GenreController::class, 'destroy' ]);

    // Добавление фильма
    Route::post('/film', [FilmController::class, 'create']);
    // Обновление фильма
    Route::post('/film/{id}' , [FilmController::class, 'update' ]);
    // Удаление фильма
    Route::delete('/film/{id}' , [FilmController::class, 'destroy' ]);

    // Добавление сеанса
    Route::post('/session' , [SessionController::class, 'create' ]);
    // Обновление сеанса
    Route::post('/session/{id}' , [SessionController::class, 'update' ]);
    // Удаление сеанса
    Route::delete('/session/{id}' , [SessionController::class, 'destroy' ]);

    // Вывод всех пользователей
    Route::get('/users' , [UserController::class, 'index' ]);
    // Вывод одного пользователя
    Route::get('/users/{id}' , [UserController::class, 'show' ]);
    // Создание пользователя администратором
    Route::post('/user/create', [AdminController::class, 'create']);
    // Редактирование пользователя администратором
    Route::post('/user/update/{id}', [AdminController::class, 'update']);
    // Удаление пользователя администратором
    Route::delete('/user/delete/{id}', [AdminController::class, 'destroy']);


    // Изменение данных авторизированного пользователя
    Route::middleware('auth:api')->post('/user/update', [UserController::class, 'update']);
});


// Функционал администратора












// Вывод авторизированного пользователя
Route::middleware('auth:api')->get('/user', [UserController::class, 'auth']);


// Функционал менеджера
Route::middleware('auth:api', 'role:manager')->group(function () {

});

// Функционал менеджера
Route::middleware(['auth:api'])->group(function () {
    // Добавление продукта
    Route::post('/product', [ProductController::class, 'create']);
    // Обновление продукта
    Route::post('/product/{id}', [ProductController::class, 'update']);
    // Удаление продукта
    Route::delete('/product/{id}', [ProductController::class, 'destroy']);
    // Просмотр билетов
    Route::get('/ticket', [TicketController::class, 'index']);
});
// Создание билета - МОЖЕТ И ПОЛЬЗОВАТЕЛЬ - ОЙ НЮАНСЫ - ОЙ КОРОЧЕ PRICE удалить в таблице tickets
Route::post('/ticket', [TicketController::class, 'create']);





// Функционал пользователя
// Просмотр всех фильмов
Route::get('/film' , [FilmController::class, 'index' ]);
// Просмотр конкретного фильма
Route::get('/film/{id}' , [FilmController::class, 'show' ]);
// Просмотр жанров
Route::get('/genre' , [GenreController::class, 'index' ]);
// Просмотр конкретного жанра
Route::get('/genre/{id}' , [GenreController::class, 'show' ]);
// Просмотр сеансов
Route::get('/session' , [SessionController::class, 'index' ]);
// Просмотр всех залов
Route::get('/typehall' , [TypeHallController::class, 'index' ]);
// Просмотр конкретного типа зала
Route::get('/typehall/{id}' , [TypeHallController::class, 'show' ]);
// Просмотр статусов сессий
Route::get('/sessionstatuses' , [SessionStatusController::class, 'index' ]);

// Получение списка заллов
Route::get('/hall', [HallController::class, 'index']);
// Просмотр конкретного зала
Route::get('/hall/{id}', [HallController::class, 'show']);

// Просмотр продуктов
Route::get('/product' , [ProductController::class, 'index' ]);
// Просмотр конкретного продукта
Route::get('/product/{id}' , [ProductController::class, 'show' ]);

Route::middleware(['auth:api'])->group(function () {
// Корзина
    Route::get('/cart', [CartController::class, 'index']);
    Route::get('/cart/my', [CartController::class, 'showByUser']);
    Route::post('/cart', [CartController::class, 'create']);
    // Редактирование корзины
    Route::post('/carts/{id}', [CartController::class, 'update']);
});

// Просмотр корзины
Route::get('/carts/{id}', [CartController::class, 'show']);
// Редактирование корзины
Route::post('/carts/{id}', [CartController::class, 'update']);
// Удаление корзины
Route::delete('/carts/{id}', [CartController::class, 'destroy']);

// ИНФОРМАЦИЯ ПО ПРОДАЖАМ
// Просмотр всех продаж за период (день/месяц/год)
Route::post('/sales', [SaleController::class, 'getSalesByPeriod']);
// Просмотр продаж по позиции за период (день/месяц/год)
Route::post('/sales/{id}', [SaleController::class, 'getSalesByPeriodAndProduct']);
// Заказы
// Список заказов
// Список корзины
