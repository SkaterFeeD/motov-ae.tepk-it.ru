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
            'name' => 'string|min:1|max:32',
            'surname' => 'string|min:1|max:32',
            'patronymic' => 'string|min:1|max:32',
            'email' => 'email|min:5|max:32|unique:users,email,'.$user->id,
            'login' => 'string|min:4|max:32|unique:users,login,'.$user->id,
            'password' => 'string|min:8|max:32',
            'phone_number' => 'string|min:6|max:12',
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
