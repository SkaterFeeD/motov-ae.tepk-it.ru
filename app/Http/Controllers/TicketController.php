<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketCreateRequest;
use Illuminate\Http\Request;
use App\Models\Ticket;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::with('session', 'session.hall:id,price')->get();
        return response()->json($tickets)->setStatusCode(200);
    }

    public function create(TicketCreateRequest $request)
    {
        // Создание билета
        $tickets = Ticket::create($request->all());
        // Возвращаем успешный ответ с созданным билетом
        return response()->json($tickets)->setStatusCode(201);
    }
}
