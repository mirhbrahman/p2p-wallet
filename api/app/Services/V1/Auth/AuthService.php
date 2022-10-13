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
        if (!auth()->attempt($credentials)) {
            throw new AuthenticationException();
        }
        $user = auth()->user();
        return [
            "token_type" => "Bearer",
            "token" => $user->createToken('auth_token')->plainTextToken,
            "user" => new UserResource($user)
        ];
    }
}
