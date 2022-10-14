<?php

namespace App\Services\V1\Transfer;

use App\Exceptions\OwnAccountException;
use App\Http\Resources\V1\UserResource;
use App\Models\V1\User;
use App\Services\V1\BaseService;
use App\Services\V1\ExchangeApi\ExchangeApiService;
use App\Services\V1\User\UserService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TransferService extends BaseService
{

    /**
     * @param User $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }



    public function send(string $account_no, float $amount): AnonymousResourceCollection
    {
        $current_user = $this->authUser();
        // Check own account or not
        if ($account_no == $current_user->email){
            throw new OwnAccountException();
        }
        // If needed to multiple method put it on constructor
        $userService = app(UserService::class);
        // Get account
        $send_to = $userService->getAccountByAccountNo($account_no);

        // Exchange money
        $exchangeService = app(ExchangeApiService::class);
        $exchange_amount = $exchangeService->exchange($current_user->default_currency, $send_to->default_currency, $amount);
dd($exchange_amount);
        // Store transaction

        // Return response


        // Get user except auth user
        $users = $this->model::where('id', '!=', $this->authUser()->id)->get();

        return UserResource::collection($users);
    }
}
