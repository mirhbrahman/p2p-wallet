<?php

namespace App\Services\V1\User;

use App\Http\Resources\V1\UserResource;
use App\Models\V1\User;
use App\Services\V1\BaseService;
use Illuminate\Auth\AuthenticationException;

class UserService extends BaseService{

    /**
     * @param User $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }


    public function list(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
       // Return user except auth user
        $users = $this->model::where('id', '!=', $this->authUser()->id)->get();

        return UserResource::collection($users);
    }
}
