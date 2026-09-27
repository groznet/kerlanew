<?php

namespace Tests\Feature;

use App\Contracts\SmsSender;
use App\Models\PhoneVerification;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class PhoneAuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_phone_entry_page_shows_the_phone_authentication_form(): void
    {
        $response = $this->get('/login');

        $response->assertOk();
        $response->assertSee('Введите номер телефона');
        $response->assertSee('/vendor/tailwind-browser.js');
        $response->assertSee('/vendor/alpine.min.js');
    }

    public function test_phone_request_normalizes_the_number_and_persists_only_a_code_hash(): void
    {
        $sender = $this->fakeSmsSender();

        $response = $this->post(route('auth.request-code'), ['phone' => '8 (912) 345-67-89']);

        $response->assertRedirect(route('auth.verify'));
        $response->assertSessionHas('pending_phone', '+79123456789');
        $this->assertDatabaseHas('phone_verifications', [
            'phone' => '+79123456789',
            'attempts' => 0,
        ]);

        $verification = PhoneVerification::query()->firstOrFail();
        $this->assertNotSame($sender->messages[0]['code'], $verification->code_hash);
        $this->assertTrue(Hash::check($sender->messages[0]['code'], $verification->code_hash));
        $this->get(route('auth.verify'))->assertDontSee($sender->messages[0]['code']);
    }

    public function test_phone_request_rejects_non_russian_numbers(): void
    {
        $sender = $this->fakeSmsSender();

        $response = $this->from(route('login'))->post(route('auth.request-code'), ['phone' => '+12025550123']);

        $response->assertRedirect(route('login'));
        $response->assertSessionHasErrors('phone');
        $this->assertSame([], $sender->messages);
        $this->assertDatabaseCount('phone_verifications', 0);
    }

    public function test_phone_request_is_rate_limited_by_phone_and_ip(): void
    {
        config(['otp.phone_requests_per_hour' => 1, 'otp.ip_requests_per_hour' => 2]);
        $sender = $this->fakeSmsSender();

        $this->post(route('auth.request-code'), ['phone' => '+79123456789'])->assertRedirect(route('auth.verify'));
        $this->post(route('auth.request-code'), ['phone' => '+79123456780'])->assertRedirect(route('auth.verify'));
        $this->from(route('login'))
            ->post(route('auth.request-code'), ['phone' => '+79123456781'])
            ->assertSessionHasErrors('phone');

        $this->travelTo(now()->addSeconds(61));
        $this->from(route('login'))
            ->post(route('auth.request-code'), ['phone' => '+79123456789'])
            ->assertSessionHasErrors('phone');

        $this->assertCount(2, $sender->messages);
    }

    public function test_phone_request_enforces_the_resend_wait(): void
    {
        $sender = $this->fakeSmsSender();

        $this->post(route('auth.request-code'), ['phone' => '+79123456789'])->assertRedirect(route('auth.verify'));
        $this->from(route('login'))
            ->post(route('auth.request-code'), ['phone' => '+79123456789'])
            ->assertSessionHasErrors('phone');

        $this->assertCount(1, $sender->messages);
        $this->assertDatabaseCount('phone_verifications', 1);
    }

    public function test_verification_rejects_a_code_after_five_failed_attempts(): void
    {
        $sender = $this->fakeSmsSender();
        $this->post(route('auth.request-code'), ['phone' => '+79123456789'])->assertRedirect(route('auth.verify'));
        $sentCode = $sender->messages[0]['code'];
        $incorrectCode = $sentCode === '000000' ? '000001' : '000000';

        for ($attempt = 0; $attempt < 5; $attempt++) {
            $this->from(route('auth.verify'))
                ->post(route('auth.verify-code'), ['code' => $incorrectCode])
                ->assertSessionHasErrors('code');
        }

        $this->from(route('auth.verify'))
            ->post(route('auth.verify-code'), ['code' => $sentCode])
            ->assertSessionHasErrors('code');

        $this->assertDatabaseHas('phone_verifications', [
            'phone' => '+79123456789',
            'attempts' => 5,
        ]);
    }

    public function test_verification_rejects_an_expired_code(): void
    {
        $sender = $this->fakeSmsSender();
        $this->post(route('auth.request-code'), ['phone' => '+79123456789'])->assertRedirect(route('auth.verify'));
        $this->travelTo(now()->addMinutes(6));

        $this->from(route('auth.verify'))
            ->post(route('auth.verify-code'), ['code' => $sender->messages[0]['code']])
            ->assertSessionHasErrors('code');

        $this->assertDatabaseCount('users', 0);
    }

    public function test_registration_requires_all_three_separate_consents(): void
    {
        $this->startRegistration();

        $response = $this->from(route('auth.register'))
            ->post(route('auth.complete-registration'), ['name' => 'Керим']);

        $response->assertRedirect(route('auth.register'));
        $response->assertSessionHasErrors(['terms', 'pd_processing', 'age_confirmation']);
        $this->assertDatabaseCount('users', 0);
        $this->assertDatabaseCount('consents', 0);
    }

    public function test_registration_creates_user_and_audit_records_for_each_consent(): void
    {
        $this->startRegistration();

        $response = $this->withServerVariables(['HTTP_USER_AGENT' => 'KerlaTests/1.0'])
            ->post(route('auth.complete-registration'), [
                'name' => 'Керим',
                'terms' => '1',
                'pd_processing' => '1',
                'age_confirmation' => '1',
            ]);

        $response->assertRedirect(route('auth.completed'));
        $this->assertAuthenticated();

        $user = User::query()->where('phone', '+79123456789')->firstOrFail();
        $this->assertSame('Керим', $user->name);
        $this->assertModelExists($user);
        $this->assertDatabaseCount('consents', 3);

        foreach ([
            'terms' => '1.0',
            'pd_processing' => '1.0',
            'age_confirmation' => '1.0',
        ] as $type => $version) {
            $this->assertDatabaseHas('consents', [
                'user_id' => $user->id,
                'type' => $type,
                'document_version' => $version,
                'ip' => '127.0.0.1',
                'user_agent' => 'KerlaTests/1.0',
            ]);
        }
    }

    public function test_existing_user_can_sign_in_without_new_signup_consents(): void
    {
        $user = User::factory()->create(['phone' => '+79123456789']);
        $sender = $this->fakeSmsSender();
        $this->post(route('auth.request-code'), ['phone' => '+79123456789'])->assertRedirect(route('auth.verify'));

        $response = $this->post(route('auth.verify-code'), ['code' => $sender->messages[0]['code']]);

        $response->assertRedirect(route('auth.completed'));
        $this->assertAuthenticatedAs($user);
        $this->assertDatabaseCount('consents', 0);
        $this->assertNotNull($user->fresh()->last_login_at);
    }

    public function test_captcha_stub_fails_closed_when_a_real_driver_is_selected(): void
    {
        config(['services.smartcaptcha.driver' => 'yandex']);
        $sender = $this->fakeSmsSender();

        $response = $this->from(route('login'))->post(route('auth.request-code'), [
            'phone' => '+79123456789',
            'captcha_token' => 'not-verified',
        ]);

        $response->assertRedirect(route('login'));
        $response->assertSessionHasErrors('phone');
        $this->assertSame([], $sender->messages);
    }

    public function test_authenticated_user_can_log_out(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('logout'));

        $response->assertRedirect(route('login'));
        $this->assertGuest();
    }

    private function startRegistration(): void
    {
        $sender = $this->fakeSmsSender();
        $this->post(route('auth.request-code'), ['phone' => '+79123456789'])->assertRedirect(route('auth.verify'));
        $this->post(route('auth.verify-code'), ['code' => $sender->messages[0]['code']])
            ->assertRedirect(route('auth.register'));
    }

    private function fakeSmsSender(): FakeSmsSender
    {
        $sender = new FakeSmsSender;
        $this->app->instance(SmsSender::class, $sender);

        return $sender;
    }
}

class FakeSmsSender implements SmsSender
{
    /** @var array<int, array{phone: string, code: string}> */
    public array $messages = [];

    public function send(string $phone, string $code): void
    {
        $this->messages[] = ['phone' => $phone, 'code' => $code];
    }
}
