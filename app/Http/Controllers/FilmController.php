<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Http\Requests\FilmCreateRequest;
use App\Models\Film;
use Illuminate\Http\Request;

class FilmController extends Controller
{
    public function index(){
        $films = Film::all();
        return response()->json($films)->setStatusCode(200);
    }

    public function show($id)
    {
        $films = Film::find($id);
        if (!$films) {
            throw new ApiException(404, 'Фильм не найден');
        }
        return response()->json($films)->setStatusCode(200);
    }



    // - Работает весьма благополучно
    public function create(FilmCreateRequest $request)
    {
        $film = new Film($request->all());
        $film->save();

        if ($request->hasFile('photo')) {
            $extension = $request->file('photo')->getClientOriginalExtension();
            $fileName = 'films/' . $film->id . '.' . $extension;
            $request->file('photo')->storeAs('public/', $fileName);
            $film->photo = $fileName;
            $film->save();
        }

        return response()->json($film)->setStatusCode(201);
    }


    // - Не работает весьма благополучно
    public function update(Request $request, $id)
    {
        // Находим фильм по его ID
        $films = Film::find($id);

        // Если фильм не найден, выбрасываем исключение с кодом 404
        if (!$films) {
            throw new ApiException(404, 'Фильм не найден');
        }

        // Валидация данных, полученных из запроса
        $validatedData = $request->validate([
            'name' => 'required|string|max:128',
            'duration' => 'required|integer',
            'description' => 'required|string',
            'year' => 'required|integer',

        ]);

        // Обновляем данные фильма на основе валидированных данных
        $films->update($validatedData);

        // Возвращаем успешный ответ с обновленными данными фильма
        return response(['data' => $films, 'message' => 'Фильм успешно обновлен'], 200);
    }



}
