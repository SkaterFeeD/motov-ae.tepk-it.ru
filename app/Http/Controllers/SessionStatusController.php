<?php

namespace App\Http\Controllers;

use App\Models\Session_status;
use Illuminate\Http\Request;

class SessionStatusController extends Controller
{
    public function index()
    {
        $sessionstatuses = Session_status::all();
        return response()->json($sessionstatuses)->setStatusCode(200);
    }
}
