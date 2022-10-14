<?php

namespace App\Http\Controllers\V1\User;

use App\Http\Controllers\Controller;
use App\Services\V1\User\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * @param UserService $userService
     */
    public function __construct(private UserService $userService)
    {
    }

    /**
     * @route   POST api/v1/users/list
     * @desc    Return all user except auth user
     * @access  Private
     */
    public function list(): JsonResponse
    {
        $data = $this->userService->list();

        return response()->success(
            'User list.',
            $data
        );
    }
}
