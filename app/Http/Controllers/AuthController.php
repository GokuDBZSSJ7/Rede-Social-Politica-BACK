<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => $user
            ]);
        }

        return response()->json(['message' => 'Credenciais inválidas'], 401);
    }

    public function me()
    {
        return response()->json(Auth::user());
    }

    public function logout()
    {
        $user = Auth::user();
        
        $user->tokens()->delete();

        return response()->json(['message' => 'Logout realizado com sucesso']);
    }

    public function refresh(Request $request)
    {
        $user = Auth::user();
        
        $request->user()->currentAccessToken()->delete();
        
        $newToken = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $newToken,
            'token_type' => 'Bearer',
            'user' => $user
        ]);
    }

}