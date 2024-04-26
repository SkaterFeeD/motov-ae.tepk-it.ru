<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Http\Requests\FilmCreateRequest;
use App\Http\Requests\FilmUpdateRequest;
use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FilmController extends Controller
{
    public function index()
    {
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

    // Работает весьма благополучно
    // Создание фильма
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

    // Обновление фильма
    // Не работает весьма благополучно
    public function update(FilmUpdateRequest $request, $id)
    {
        $film = Film::find($id);
        if (!$film) {
            throw new ApiException(404, 'Фильм не найден');
        }
        // Обновляем атрибуты фильма с данными из запроса, исключая поле 'photo'
        $film->update($request->except('photo'));

        // Проверяем наличие нового файла фотографии в запросе
        if ($request->hasFile('photo')) {
            // Получаем расширение нового файла
            $extension = $request->file('photo')->getClientOriginalExtension();
            // Генерируем имя нового файла
            $fileName = 'films/' . $film->id . '.' . $extension;
            // Сохраняем новый файл
            $request->file('photo')->storeAs('public', $fileName);
            // Удаляем предыдущий файл фотографии, если он существует
            if ($film->photo) {
                Storage::delete('public/' . $film->photo);
            }
            // Обновляем ссылку на фотографию в модели фильма
            $film->photo = $fileName;
        }
        $film->save();
        // Возвращаем обновленный фильм
        return response()->json($film)->setStatusCode(200);
    }

    public function destroy($id)
    {
        $film = Film::find($id);
        if (!$film) {
            throw new ApiException(404, 'Фильм не найден');
        }
        // Удаляем фотографию фильма, если она существует
        if ($film->photo) {
            Storage::delete('public/' . $film->photo);
        }
        // Удаляем фильм из базы данных
        $film->delete();
        // Возвращаем успешный ответ
        return response()->json(['message' => 'Фильм успешно удален'])->setStatusCode(200);
    }
}
