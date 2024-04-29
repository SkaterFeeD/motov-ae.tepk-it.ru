<?php

namespace App\Http\Controllers;
use App\Http\Requests\SessionCreateRequest;
use App\Http\Requests\SessionUpdateRequest;
use App\Http\Resources\SessionResource;
use App\Models\Session;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function index()
    {
        $sessions = Session::all();
        return response()->json(SessionResource::collection($sessions))->setStatusCode(200);
    }
    public function update(SessionUpdateRequest $request, $id)
    {
        $session = Session::findOrFail($id);
        // Проверяем есть ли поля
        if ($request->has('time_start')) {
            $session->time_start = $request->input('time_start');
        }
        if ($request->has('time_end')) {
            $session->time_end = $request->input('time_end');
        }
        if ($request->has('session_status_id')) {
            $session->session_status_id = $request->input('session_status_id');
        }
        if ($request->has('film_id')) {
            $session->film_id = $request->input('film_id');
        }
        if ($request->has('hall_id')) {
            $session->hall_id = $request->input('hall_id');
        }
        // Обновляем
        $session->save();
        return response()->json($session)->setStatusCode(200);
    }
    public function create(SessionCreateRequest $request)
    {
        // Создание новой сессии
        $session = new Session();
        $session->time_start = $request->input('time_start');
        $session->time_end = $request->input('time_end');
        $session->session_status_id = $request->input('session_status_id');
        $session->film_id = $request->input('film_id');
        $session->hall_id = $request->input('hall_id');

        // Сохранение
        $session->save();
        return response()->json($session)->setStatusCode(201);
    }
    public function destroy($id)
    {
        // Находим жанр по идентификатору
        $session = Session::find($id);
        // Проверяем, найден ли жанр
        if (!$session) {
            // Если жанр не найден, возвращаем сообщение об ошибке
            return response()->json(['message' => 'Сеанс не найден'], 404);
        }
        // Удаляем сеанс
        $session->delete();
        // Возвращаем успешный ответ об удалении
        return response()->json(['message' => 'Сеанс успешно удален'], 200);
    }
}
