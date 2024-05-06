<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Models\Type_hall;
use Illuminate\Http\Request;

class TypeHallController extends Controller
{
    public function index()
    {
        $typehalls = Type_hall::all();
        return response()->json($typehalls)->setStatusCode(200);
    }
    public function show($id)
    {
        $typehalls = Type_hall::find($id);
        if (!$typehalls) {
            throw new ApiException(404, 'Тип зала не найден');
        }
        return response()->json($typehalls)->setStatusCode(200);
    }
}
