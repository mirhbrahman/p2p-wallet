<?php

namespace App\Services\V1\Transfer;

use App\Exceptions\OwnAccountException;
use App\Models\V1\Transaction;
use App\Notifications\AccountCredited;
use App\Services\V1\BaseService;
use App\Services\V1\ExchangeApi\ExchangeApiService;
use App\Services\V1\User\UserService;
use Illuminate\Support\Facades\DB;

class TransferService extends BaseService
{

    /**
     * @param Transaction $model
     */
    public function __construct(Transaction $model)
    {
        $this->model = $model;
    }


    /**
     * @param string $account_no
     * @param float $amount
     * @return bool
     * @throws OwnAccountException
     */
    public function send(string $account_no, float $amount): bool
    {
        $current_user = $this->authUser();
        // Check own account or not
        if ($account_no == $current_user->email) {
            throw new OwnAccountException();
        }
        // If needed to multiple methods put it on constructor
        $userService = app(UserService::class);
        // Get account
        $send_to = $userService->getAccountByAccountNo($account_no);
        // Exchange money
        $exchangeService = app(ExchangeApiService::class);
        $exchange_amount = $exchangeService->exchange($current_user->default_currency, $send_to->default_currency, $amount);

        try {
            DB::beginTransaction();
            // Store transaction
            $data = [
                "sender_id" => $current_user->id,
                "receiver_id" => $send_to->id,
                "send_currency" => $current_user->default_currency,
                "exchange_currency" => $send_to->default_currency,
                "send_amount" => $amount,
                "exchange_amount" => $exchange_amount,
                "status" => Transaction::STATUS_SUCCESSFUL
            ];
            $this->model::create($data);
            // Update user transaction count
            $current_user->total_conversion += 1;
            $current_user->save();
            DB::commit();

            // Send mail
            // TODO: add queueable mail
            $send_to->notify(new AccountCredited($data));

            // Modify later
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function totalConverted(int $id): float
    {
        return $this->model::where('sender_id', $id)->sum('send_amount');
    }
}
