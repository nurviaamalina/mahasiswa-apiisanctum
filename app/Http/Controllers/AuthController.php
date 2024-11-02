<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth; // Import Auth facade
use App\Models\User;

class AuthController extends Controller
{
    // Fungsi untuk registrasi pengguna baru
    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|string|in:admin,mahasiswa',
        ]);

        // Membuat user baru dengan data dari request
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash password
            'role' => $request->role,
        ]);

        return response()->json(['user' => $user], 201);
    }

    // Fungsi untuk login
    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // Check if the user exists
    $user = User::where('email', $request->email)->first();
    
    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    // Attempt to authenticate the user
   $token = $user->createToken('auth_token')->plainTextToken;
   return response()->json(['token' => $token, 'role' => $user->role], 200);
}
}