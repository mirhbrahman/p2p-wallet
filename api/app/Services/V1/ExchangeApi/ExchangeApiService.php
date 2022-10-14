<?php

namespace App\Services\V1\ExchangeApi;

use App\Exceptions\ExchangeApiFailedException;
use App\Services\Interfaces\ExchangeApiInterface;
use App\Services\V1\BaseService;
use Illuminate\Support\Facades\Http;

class ExchangeApiService extends BaseService implements ExchangeApiInterface
{
    /**
     * @param string $api
     * @param string $key
     */
    public function __construct(string $api, string $key)
    {
        $this->api_base_url = $api;
        $this->api_key = $key;
    }


    /**
     * @param string $from_currency
     * @param string $to_currency
     * @param float $amount
     * @return float
     * @throws ExchangeApiFailedException
     */
    public function exchange(string $from_currency, string $to_currency, float $amount): float
    {
        $response = Http::withHeaders([
            "Content-Type" => "application/json",
            "apikey" => "jgczpDgYj590zlaIZcIvsOf8Y8HRdwug"
        ])->get('https://api.apilayer.com/currency_data/convert', [
            'to' => $to_currency,
            'from' => $from_currency,
            'amount' => $amount
        ]);

        if ($response->successful()) {
            return number_format($response['result'], 2);
        } else {
            throw new ExchangeApiFailedException();
        }

    }
}
