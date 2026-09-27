<?php

namespace App\Services;

class CaptchaVerifier
{
    public function verify(?string $token): bool
    {
        return config('services.smartcaptcha.driver') === 'stub'
            && app()->environment(['local', 'testing']);
    }
}
