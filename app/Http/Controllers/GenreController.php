<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Http\Requests\GenreCreateRequest;
use App\Http\Requests\GenreUpdateRequest;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::all();
        return response()->json($genres)->setStatusCode(200);
    }
    public function show($id)
    {
        $genres = Genre::find($id);
        if (!$genres) {
            throw new ApiException(404, 'Жанр не найден');
        }
        return response()->json($genres)->setStatusCode(200);
    }
    public function create(GenreCreateRequest $request)
    {
        // Создание жанра
        $genre = Genre::create($request->all());
        // Возвращаем успешный ответ с созданным жанром
        return response()->json($genre)->setStatusCode(201);
    }
    public function update(GenreUpdateRequest $request, $id)
    {
        // Находим жанр
        $genre = Genre::find($id);
        if (!$genre) {
            return response()->json(['message' => 'Жанр не найден'], 404);
        }
        // Валидация входных данных
        $validatedData = $request->validate([
            'name' => 'required|string|max:32',
        ]);
        // Обновляем атрибуты жанра
        $genre->update($validatedData);
        // Возвращаем успешный ответ с обновленным жанром
        return response()->json($genre, 200);
    }
    public function destroy($id)
    {
        // Находим жанр по идентификатору
        $genre = Genre::find($id);
        // Проверяем, найден ли жанр
        if (!$genre) {
            // Если жанр не найден, возвращаем сообщение об ошибке
            return response()->json(['message' => 'Жанр не найден'], 404);
        }
        // Удаляем жанр
        $genre->delete();
        // Возвращаем успешный ответ об удалении
        return response()->json(['message' => 'Жанр успешно удален'], 200);
    }
}
