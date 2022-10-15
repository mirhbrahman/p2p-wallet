<?php

namespace App\Services\V1\Auth;

use App\Http\Resources\V1\UserResource;
use App\Models\V1\User;
use App\Services\V1\BaseService;
use Illuminate\Auth\AuthenticationException;

class AuthService extends BaseService{

    /**
     * @param User $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }


    /**
     * @param array $credentials
     * @return array
     * @throws AuthenticationException
     */
    public function login(array $credentials): array
    {
        // Auth check
        if (!auth()->attempt($credentials)) {
            throw new AuthenticationException("Invalid email or password!");
        }

        // Return user token and info
        $user = $this->authUser();
        // Revoke all previous tokens
        if($user->tokens){
            $user->tokens()->delete();
        }

        // Return info
        return [
            "token_type" => "Bearer",
            "token" => $user->createToken('auth_token')->plainTextToken,
            "user" => new UserResource($user)
        ];
    }
}
