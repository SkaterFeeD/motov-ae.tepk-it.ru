<?php

namespace App\Http\Controllers;

use App\Models\Type_hall;
use Illuminate\Http\Request;

class TypeHallController extends Controller
{
    public function index()
    {
        $typehalls = Type_hall::all();
        return response()->json($typehalls)->setStatusCode(200);
    }
}
