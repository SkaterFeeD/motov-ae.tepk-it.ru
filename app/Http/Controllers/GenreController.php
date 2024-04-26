<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
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
    public function create(Request $request)
    {
        // Валидация данных
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:genres,name',
        ]);
        // Создание жанра
        $genre = Genre::create($validatedData);
        // Возвращаем успешный ответ с созданным жанром
        return response()->json($genre)->setStatusCode(201);
    }
}
