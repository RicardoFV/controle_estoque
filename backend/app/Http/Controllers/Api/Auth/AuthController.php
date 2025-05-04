<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Valida as credenciais
        $credentials = $request->only('email', 'password');

        if (!auth()->attempt($credentials)) {
            return response()->json(['message' => 'Credenciais inválidas'], Response::HTTP_UNAUTHORIZED);
        }

        // Gera um token personalizado para o usuário autenticado
        $user = auth()->user();
        $token = $user->createToken('Token Pessoal')->plainTextToken;

        // Retorna o token
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer'
        ]);
    }
}
