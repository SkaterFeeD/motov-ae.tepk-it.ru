<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Models\Hall;
use Illuminate\Http\Request;

class HallController extends Controller
{
    public function index()
    {
        $halls = Hall::all();
        return response()->json($halls)->setStatusCode(200);
    }
    public function show($id)
    {
        $halls = Hall::find($id);
        if (!$halls) {
            throw new ApiException(404, 'Продукт не найден');
        }
        return response()->json($halls)->setStatusCode(200);
    }
}
