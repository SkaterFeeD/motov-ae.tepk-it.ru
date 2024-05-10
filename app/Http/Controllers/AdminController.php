<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UserCreateRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function update(Request $request, $userId)
    {
        // Находим пользователя по ID
        $user = User::findOrFail($userId);
        $validator = Validator::make($request->all(), [
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

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
        $user->update($request->all());
        return response()->json($user)->setStatusCode(200);
    }
    public function destroy($userId)
    {
        $user = User::findOrFail($userId);
        $user->delete();
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
