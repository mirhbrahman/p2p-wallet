<?php

namespace App\Http\Controllers\V1\Transfer;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Transfer\SendRequest;
use App\Services\V1\ExchangeApi\ExchangeApiService;
use App\Services\V1\Transfer\TransferService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TransferController extends Controller
{
    /**
     * @param TransferService $transferService
     */
    public function __construct(private TransferService $transferService)
    {
    }

    /**
     * @route   POST api/v1/transfer/send
     * @desc    Send money to another account
     * @access  Private
     * @param SendRequest $request
     * @return JsonResponse
     */
    public function send(SendRequest $request): JsonResponse
    {
        $data = $this->transferService->send($request->account_no, $request->amount);

        return response()->success(
            'Transfer successful.',
            $data
        );
    }
}
