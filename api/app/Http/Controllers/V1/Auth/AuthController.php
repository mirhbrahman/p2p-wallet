<?php

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Auth\LoginRequest;
use App\Services\V1\Auth\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * @param AuthService $authService
     */
    public function __construct(private AuthService $authService)
    {
    }

    /**
     * @route   POST api/v1/auth/login
     * @desc    Login User / Returning Token
     * @access  Public
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $data = $this->authService->login($request->validated());

        return response()->success(
            'Login successful.',
            $data
        );
    }
}
