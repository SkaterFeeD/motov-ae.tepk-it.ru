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
        $genre = Genre::create($request->all());
        return response()->json($genre)->setStatusCode(201);
    }
    public function update(GenreUpdateRequest $request, $id)
    {
        // Находим жанр
        $genre = Genre::find($id);
        if (!$genre) {
            return response()->json(['message' => 'Жанр не найден'], 404);
        }
        $genre->update($request->all());
        return response()->json($genre, 200);
    }
    public function destroy($id)
    {
        $genre = Genre::find($id);
        if (!$genre) {
            return response()->json(['message' => 'Жанр не найден'], 404);
        }
        $genre->delete();
        return response()->json(['message' => 'Жанр успешно удален'], 200);
    }
}
