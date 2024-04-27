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

}
