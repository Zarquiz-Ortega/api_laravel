<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function register(Request $request){
        $request->validate([
            'name' => 'required|string|min:3|max:50',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        $user = new User();
        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'registro de usuario exitoso',
        ], Response::HTTP_CREATED);
    }

    public function userProfile(){
        return response()->json([
            'status' => true,
            'message' => 'perfil de usuario',
            'data' => auth()->user(),
        ],Response::HTTP_OK);
    }

}
