<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestPhoneCodeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $phone = preg_replace('/[\s().-]/u', '', (string) $this->input('phone'));

        if (is_string($phone) && preg_match('/^8\d{10}$/', $phone) === 1) {
            $phone = '+7'.substr($phone, 1);
        } elseif (is_string($phone) && preg_match('/^7\d{10}$/', $phone) === 1) {
            $phone = '+'.$phone;
        }

        $this->merge(['phone' => $phone]);
    }

    public function rules(): array
    {
        return [
            'phone' => ['required', 'string', 'regex:/^\+7\d{10}$/'],
            'captcha_token' => ['nullable', 'string', 'max:4096'],
        ];
    }
}
