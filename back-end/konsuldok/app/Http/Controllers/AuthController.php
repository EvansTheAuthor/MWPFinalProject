<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function register(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        
        Log::info('User registered: ' . $user->email);

        return response()->json(['message' => 'Registration successful'], 201);
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();
    
        if(! $user || ! Hash::check($request->password, $user->password)){
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        Log::info('User logged in: ' . $user->email);

        return response()->json(['token' => $token, 'user' => $user]);
    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();

        Log::info('User logged out: ' . $request->user()->email);

        return response()->json(['message' => 'Logged Out']);
    }
}

