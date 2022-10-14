<?php

namespace App\Providers;

use App\Services\V1\ExchangeApi\ExchangeApiService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ExchangeApiService::class, function ($app) {
            return new ExchangeApiService(
                config('services.exchange.currencylayer.api'),
                config('services.exchange.currencylayer.key')
            );
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('success', function (string $message, array|AnonymousResourceCollection $data = [], int $status_code = 200): JsonResponse {
            return response()->json([
                'success' => true,
                'message' => $message,
                'data' => $data,
            ], $status_code);
        });

        Response::macro('error', function (string $message, array $data = [], int $status_code = 400): JsonResponse {
            return response()->json([
                'success' => false,
                'message' => $message,
                'data' => $data,
            ], $status_code);
        });
    }
}
