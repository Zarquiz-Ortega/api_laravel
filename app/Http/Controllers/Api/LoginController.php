<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where("email", "=", $request->email)->first();

        if (isset($user->id)) {
            if (Hash::check($request->password, $user->password)) {

                $token = $user->createToken("auth_token")->plainTextToken;

                return response()->json([
                    'status' => true,
                    'message' => 'Usuario logeado',
                    'access_token' => $token,
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Datos incorrectos'
                ], Response::HTTP_FORBIDDEN);
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Usuario no reguistrado'
            ], Response::HTTP_FORBIDDEN);
        }
    }
}
