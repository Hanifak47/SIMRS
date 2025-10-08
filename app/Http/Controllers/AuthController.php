<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthService;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    //
    private $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }


    //register

    public function register(RegisterRequest $request)
    {
        $user = $this->authService->register($request->validated());
        return response()->json(['Message' => 'Pengguna berhasil registrasi', 'user' => $user], 201);
    }

    public function login(LoginRequest $request)
    {
        return $this->authService->login($request->validated());
    }


    public function tokenLogin(LoginRequest $request)
    {
        return $this->authService->tokenLogin($request->validated());
    }

    public function logout(Request $request)
    {
        // melupakan informasi user yg login
        Auth::guard('web')->logout();

        // semua sesi dianggap invalid
        $request->session()->invalidate();

        // token login dihapus
        $request->session()->regenerateToken();

        return response()->json(['message' => 'Logged out successfully']);
    }
}
