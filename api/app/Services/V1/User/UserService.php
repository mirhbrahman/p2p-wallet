<?php

namespace App\Services\V1\User;

use App\Http\Resources\V1\UserResource;
use App\Models\V1\User;
use App\Services\V1\BaseService;
use Exception;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserService extends BaseService
{

    /**
     * @param User $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }


    public function list(): AnonymousResourceCollection
    {
        // Get user except auth user
        $users = $this->model::where('id', '!=', $this->authUser()->id)->where('id', 5)->get();

        return UserResource::collection($users);
    }
}
