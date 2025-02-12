<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        $admin = Admin::where('username', $request->username)->first();
        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid credentials',
            ], 401);
        }
        if ($admin->tokens()->exists()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Anda sudah login di perangkat lain. Harap logout terlebih dahulu.',
            ], 403);
        }
        $token = $admin->createToken('admin-token')->plainTextToken;
        return response()->json([
            'status' => 'success',
            'message' => 'Login successful',
            'data' => [
                'token' => $token,
                'admin' => $admin->only(['id', 'name', 'username', 'phone', 'email']),
            ],
        ]);
    }

public function logout(Request $request)
{
    $request->user()->currentAccessToken()->delete();
    return response()->json(['status' => 'success', 'message' => 'Logged out']);
}
public function unauthenticated()
    {
        return response()->json([
            "status" => false,
            "message" => "Unauthenticated",
        ], 401);
    }
}
