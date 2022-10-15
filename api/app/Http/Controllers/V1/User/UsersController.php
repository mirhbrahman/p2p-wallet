<?php

namespace App\Http\Controllers\V1\User;

use App\Exceptions\NoDataFoundException;
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
     * @route   GET api/v1/users/list
     * @desc    Return all user except auth user
     * @access  Private
     * @throws NoDataFoundException
     */
    public function list(): JsonResponse
    {
        $users = $this->userService->list();
        if (!count($users)) throw new NoDataFoundException();

        return response()->success(
            'User list.',
            $users
        );
    }

    /**
     * @route   GET api/v1/users/stats
     * @desc    Return stats
     * @access  Private
     * @throws NoDataFoundException
     */
    public function stats(): JsonResponse
    {
        $data = $this->userService->stats();
        if (!count($data)) throw new NoDataFoundException();

        return response()->success(
            'User stats.',
            $data
        );
    }
}
