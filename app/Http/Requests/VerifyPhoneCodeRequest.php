<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VerifyPhoneCodeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->session()->has('pending_phone');
    }

    public function rules(): array
    {
        return [
            'code' => ['required', 'string', 'regex:/^\d{4,6}$/'],
        ];
    }
}
