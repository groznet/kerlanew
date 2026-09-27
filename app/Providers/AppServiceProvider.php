<?php

namespace App\Providers;

use App\Contracts\SmsSender;
use App\Services\LogSmsSender;
use Illuminate\Support\ServiceProvider;
use InvalidArgumentException;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(SmsSender::class, function (): SmsSender {
            return match (config('services.sms.driver')) {
                'log' => new LogSmsSender,
                default => throw new InvalidArgumentException('Unsupported SMS driver.'),
            };
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
