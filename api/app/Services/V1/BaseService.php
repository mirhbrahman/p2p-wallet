<?php

namespace App\Services\V1;

use Illuminate\Database\Eloquent\Model;

class BaseService
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function authUser()
    {
        return auth('sanctum')->user();
    }

}
