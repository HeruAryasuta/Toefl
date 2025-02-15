<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Midtrans\Config;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Config::$serverKey = config('midtrans.midtrans.serverKey'); 
        Config::$isProduction = config('midtrans.midtrans.isProduction'); 
        Config::$isSanitized = config('midtrans.midtrans.isSanitized'); 
        Config::$is3ds = config('midtrans.midtrans.is3ds');
        Config::$curlOptions = [
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
        ];        
    }
    
}