<?php

namespace App\Services;

use App\Contracts\SmsSender;
use App\Models\PhoneVerification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class PhoneAuthenticationService
{
    public function __construct(private SmsSender $smsSender) {}

    public function requestCode(string $phone, ?string $ip): void
    {
        $phoneKey = 'otp:phone:'.$phone;
        $ipKey = 'otp:ip:'.($ip ?? 'unknown');
        $phoneLimit = (int) config('otp.phone_requests_per_hour');
        $ipLimit = (int) config('otp.ip_requests_per_hour');

        if (RateLimiter::tooManyAttempts($phoneKey, $phoneLimit) || RateLimiter::tooManyAttempts($ipKey, $ipLimit)) {
            throw ValidationException::withMessages([
                'phone' => __('auth.rate_limited'),
            ]);
        }

        $latestVerification = PhoneVerification::query()->where('phone', $phone)->latest('id')->first();

        if ($latestVerification !== null && $latestVerification->created_at->gt(now()->subSeconds((int) config('otp.resend_wait_seconds')))) {
            throw ValidationException::withMessages([
                'phone' => __('auth.resend_wait'),
            ]);
        }

        $code = str_pad((string) random_int(0, 999999), (int) config('otp.code_length'), '0', STR_PAD_LEFT);

        DB::transaction(function () use ($phone, $code, $ip): void {
            PhoneVerification::query()->where('phone', $phone)->delete();
            PhoneVerification::query()->create([
                'phone' => $phone,
                'code_hash' => Hash::make($code),
                'attempts' => 0,
                'expires_at' => now()->addMinutes((int) config('otp.expiry_minutes')),
                'ip' => $ip,
                'created_at' => now(),
            ]);
        });

        RateLimiter::hit($phoneKey, (int) config('otp.rate_limit_window_seconds'));
        RateLimiter::hit($ipKey, (int) config('otp.rate_limit_window_seconds'));
        $this->smsSender->send($phone, $code);
    }

    public function verifyCode(string $phone, string $code): bool
    {
        return DB::transaction(function () use ($phone, $code): bool {
            $verification = PhoneVerification::query()
                ->where('phone', $phone)
                ->latest('id')
                ->lockForUpdate()
                ->first();

            if ($verification === null || $verification->expires_at->isPast() || $verification->attempts >= config('otp.max_attempts')) {
                return false;
            }

            if (! Hash::check($code, $verification->code_hash)) {
                $verification->increment('attempts');

                return false;
            }

            $verification->delete();

            return true;
        });
    }
}
