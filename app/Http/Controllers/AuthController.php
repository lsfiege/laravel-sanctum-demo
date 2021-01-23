<?php

namespace App\Http\Controllers;

use App\Http\Traits\ApiResponser;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use ApiResponser;

    public function register(Request $request): JsonResponse
    {
        $attr = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $attr['name'],
            'password' => bcrypt($attr['password']),
            'email' => $attr['email'],
        ]);

        return $this->success([
            'token' => $user->createToken('API Token')->plainTextToken,
        ]);
    }

    public function login(Request $request): JsonResponse
    {
        $attr = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:6',
        ]);

        if (! Auth::attempt($attr)) {
            return $this->error(401, 'Credentials not match');
        }

        return $this->success([
            'token' => auth()->user()->createToken('API Token')->plainTextToken,
        ]);
    }

    public function logout(): JsonResponse
    {
        auth()->user()->tokens()->delete();

        return $this->success(null, 'Logged out');
    }
}
