<?php

namespace App\Services\V1\User;

use App\Exceptions\NoDataFoundException;
use App\Http\Resources\V1\UserResource;
use App\Models\V1\User;
use App\Services\V1\BaseService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserService extends BaseService
{

    /**
     * @param User $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }


    /**
     * @return AnonymousResourceCollection
     */
    public function list(): AnonymousResourceCollection
    {
        // Get user except auth user
        $users = $this->model::where('id', '!=', $this->authUser()->id)->get();

        return UserResource::collection($users);
    }

    /**
     * @param string $email
     * @return Collection
     * @throws NoDataFoundException
     */
    public function getAccountByAccountNo(string $email): User
    {
        $user = $this->model::where('email', $email)->first();
        if (!$user) throw new NoDataFoundException('Account not found!');
        return $user;
    }
}
