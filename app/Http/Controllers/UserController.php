<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function this() {
        $user = auth()->user();

        return response()->json([
            'data' => $user
        ]);
    }
    public function show(int $id) {
        $user = User::find($id);
        if(!$user) throw new ApiException(404, 'Пользователь не найден');
        return response([
            'data' => $user,
        ]);
    }
    public function index()
    {
        // Получаем всех пользователей
        $users = User::all();
        return response()->json($users)->setStatusCode(200);
    }
    public function auth()
    {
        // Получаем текущего авторизованного пользователя
        $user = Auth::user();

        // Проверяем, авторизован ли пользователь
        if (!$user) {
            // Если пользователь не авторизован, возвращаем ошибку 401 (Unauthorized)
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Возвращаем данные авторизованного пользователя
        return response()->json($user)->setStatusCode(200);
    }
    public function update(Request $request)
    {
        // Получаем текущего авторизованного пользователя
        $user = Auth::user();

        // Проверяем, авторизован ли пользователь
        if (!$user) {
            // Если пользователь не авторизован, возвращаем ошибку 401 (Unauthorized)
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Валидация данных
        $validatedData = $request->validate([
            'name' => 'string|max:255',
            'surname' => 'string|max:255',
            'patronymic' => 'string|max:255',
            'email' => 'email|max:255|unique:users,email,'.$user->id,
            'login' => 'string|max:255|unique:users,login,'.$user->id,
            'password' => 'string|min:6|max:255', // Подтверждение пароля может быть добавлено при необходимости
            'phone_number' => 'string|max:255',
            'birth' => 'date',
        ]);

        // Обновляем данные пользователя
        $user->update($request->all());

        // Возвращаем успешный ответ
        return response()->json($user)->setStatusCode(200);
    }
}
