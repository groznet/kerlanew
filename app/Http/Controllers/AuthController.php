<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompleteRegistrationRequest;
use App\Http\Requests\RequestPhoneCodeRequest;
use App\Http\Requests\VerifyPhoneCodeRequest;
use App\Models\Consent;
use App\Models\User;
use App\Services\CaptchaVerifier;
use App\Services\PhoneAuthenticationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showPhoneForm(): View
    {
        return view('auth.phone');
    }

    public function requestCode(
        RequestPhoneCodeRequest $request,
        CaptchaVerifier $captchaVerifier,
        PhoneAuthenticationService $phoneAuthenticationService
    ): RedirectResponse {
        if (! $captchaVerifier->verify($request->input('captcha_token'))) {
            return back()->withErrors(['phone' => __('auth.captcha_failed')])->withInput();
        }

        $phone = (string) $request->validated('phone');
        $phoneAuthenticationService->requestCode($phone, $request->ip());
        $request->session()->put('pending_phone', $phone);

        return redirect()->route('auth.verify')->with('status', __('auth.code_sent'));
    }

    public function showVerifyForm(Request $request): View|RedirectResponse
    {
        $phone = $request->session()->get('pending_phone');

        if (! is_string($phone)) {
            return redirect()->route('login');
        }

        return view('auth.verify', ['phone' => $phone]);
    }

    public function verifyCode(
        VerifyPhoneCodeRequest $request,
        PhoneAuthenticationService $phoneAuthenticationService
    ): RedirectResponse {
        $phone = (string) $request->session()->get('pending_phone');

        if (! $phoneAuthenticationService->verifyCode($phone, (string) $request->validated('code'))) {
            return back()->withErrors(['code' => __('auth.invalid_code')])->withInput();
        }

        $request->session()->forget('pending_phone');
        $user = User::query()->where('phone', $phone)->first();

        if ($user !== null) {
            if ($user->status !== 'active') {
                return redirect()->route('login')->withErrors(['phone' => __('auth.account_blocked')]);
            }

            $user->forceFill([
                'phone_verified_at' => $user->phone_verified_at ?? now(),
                'last_login_at' => now(),
            ])->save();
            Auth::login($user);
            $request->session()->regenerate();

            return redirect()->route('auth.completed');
        }

        $request->session()->put('verified_phone', $phone);

        return redirect()->route('auth.register');
    }

    public function showRegistrationForm(Request $request): View|RedirectResponse
    {
        if (! is_string($request->session()->get('verified_phone'))) {
            return redirect()->route('login');
        }

        return view('auth.register');
    }

    public function completeRegistration(CompleteRegistrationRequest $request): RedirectResponse
    {
        $phone = (string) $request->session()->get('verified_phone');
        $userAgent = mb_substr((string) $request->userAgent(), 0, 255);
        $ip = (string) $request->ip();
        $givenAt = now();

        $user = DB::transaction(function () use ($request, $phone, $userAgent, $ip, $givenAt): User {
            $user = User::query()->create([
                'phone' => $phone,
                'phone_verified_at' => $givenAt,
                'name' => trim((string) $request->validated('name')),
                'city_id' => null,
                'show_phone' => false,
                'role' => 'user',
                'status' => 'active',
            ]);

            $versions = [
                'terms' => config('consents.terms_version'),
                'pd_processing' => config('consents.pd_processing_version'),
                'age_confirmation' => config('consents.age_confirmation_version'),
            ];

            foreach ($versions as $type => $version) {
                Consent::query()->create([
                    'user_id' => $user->id,
                    'type' => $type,
                    'document_version' => $version,
                    'fields' => null,
                    'ip' => $ip,
                    'user_agent' => $userAgent,
                    'given_at' => $givenAt,
                ]);
            }

            return $user;
        });

        Auth::login($user);
        $request->session()->regenerate();
        $request->session()->forget('verified_phone');

        return redirect()->route('auth.completed');
    }

    public function showCompleted(): View
    {
        return view('auth.completed');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
