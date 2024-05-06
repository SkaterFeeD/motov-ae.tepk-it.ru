<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function update(Request $request, $userId)
    {
        // Находим пользователя по ID
        $user = User::findOrFail($userId);

        // Валидация данных
        $validatedData = $request->validate([
            'name' => 'string|max:255',
            'surname' => 'string|max:255',
            'patronymic' => 'string|max:255',
            'email' => 'email|max:255|unique:users,email,'.$user->id,
            'login' => 'string|max:255|unique:users,login,'.$user->id,
            'password' => 'string|min:8|max:255',
            'phone_number' => 'string|max:255',
            'birth' => 'date',
            'role_id' => 'integer|exists:roles,id',
        ]);

        // Обновляем данные пользователя
        $user->update($validatedData);

        // Возвращаем успешный ответ
        return response()->json($user)->setStatusCode(200);
    }
    public function destroy($userId)
    {
        // Находим пользователя по ID
        $user = User::findOrFail($userId);

        // Удаляем пользователя
        $user->delete();

        // Возвращаем успешный ответ
        return response()->json(['message' => 'Пользователь успешно удален'])->setStatusCode(200);
    }
    public function create(UserCreateRequest $request)
    {
        // Создаем нового пользователя с предоставленными данными
        $user = new User($request->all());
        $user->save();
        return response([
            'message' => 'Регистрация прошла успешно'
        ], 200);
    }
}
