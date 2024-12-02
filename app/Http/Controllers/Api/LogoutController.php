<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            "status" => 1,
            "msg" => "Cierre de Sesión",
        ]);
    }
}
