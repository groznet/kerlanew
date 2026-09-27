<?php

namespace App\Services;

use App\Contracts\SmsSender;
use Illuminate\Support\Facades\Log;

class LogSmsSender implements SmsSender
{
    public function send(string $phone, string $code): void
    {
        if (! app()->environment(['local', 'testing'])) {
            throw new \RuntimeException('The log SMS driver is only available locally.');
        }

        Log::info('Kerla verification code', [
            'phone' => $phone,
            'code' => $code,
        ]);
    }
}
