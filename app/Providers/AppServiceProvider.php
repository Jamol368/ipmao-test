<?php

namespace App\Providers;

use App\Contracts\PaymentGateway;
use App\Services\AppPaymentGateway;
use App\Services\MerchantPaymentGateway;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->when(MerchantPaymentGateway::class)
            ->needs(PaymentGateway::class)
            ->give(function () {
                return new MerchantPaymentGateway();
            });

        $this->app->when(AppPaymentGateway::class)
            ->needs(PaymentGateway::class)
            ->give(function () {
                return new AppPaymentGateway();
            });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
