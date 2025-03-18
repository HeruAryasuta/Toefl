<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Midtrans\Config;
use App\Observers\TransaksiObserver;
use App\Models\Transaksi;

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
        Transaksi::observe(TransaksiObserver::class);
        Config::$serverKey = config('midtrans.midtrans.serverKey'); 
        Config::$isProduction = config('midtrans.midtrans.isProduction'); 
        Config::$isSanitized = config('midtrans.midtrans.isSanitized'); 
        Config::$is3ds = config('midtrans.midtrans.is3ds');
        Config::$curlOptions = [
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'Accept: application/json',
            ],
        ];   
    }
    
}