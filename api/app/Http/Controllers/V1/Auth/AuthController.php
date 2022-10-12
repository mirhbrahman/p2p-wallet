<?php

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Auth\LoginRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * @route   POST api/v1/auth/login
     * @desc    Login User / Returning Token
     * @access  Public
     */
    public function login(LoginRequest $request): string
    {
        return 'login';
    }
}
