<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\auth\LoginRequest;
use App\Http\Requests\Api\auth\RegisterRequest;
use App\Http\Resources\Api\auth\ProfileResource;
use App\Services\AuthService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use ApiResponseTrait;

    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        $user = $this->authService->register($data);
        $user->token = $user->createToken('api-token')->plainTextToken;

        return $this->successResponse(new ProfileResource($user), 'User registered successfully');
    }

    public function login(LoginRequest $request)
    {
        $data = $request->validated();

        $userData = $this->authService->login($data);

        if (!$userData) {
            return $this->errorResponse('Invalid credentials', 401);
        }

        return $this->successResponse(new ProfileResource($userData), 'Logged in successfully');
    }

    public function profile()
    {
        return $this->successResponse(new ProfileResource(Auth::user()), 'User data');
    }

    public function logout()
    {
        Auth::user()->currentAccessToken()->delete();
        return $this->successResponse([], 'Logged out successfully');
    }
}
