<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $request;

    public function __construct(Request $request) {
        $this->request = $request;
    }

    public function auth(): JsonResponse {
        $credentials = $this->request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = $this->request->user();
    
            $token = $user->createToken('auth_token')->plainTextToken;
    
            return response()->json([
                "access_token" => $token,
                "token_type" => "Bearer"
            ], 200);
        }
    
        return response()->json([
            "code" => 400,
            "message" => "Usuário inválido"
        ], 400);
    }
}
