<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompleteRegistrationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->session()->has('verified_phone');
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:60'],
            'terms' => ['required', 'accepted'],
            'pd_processing' => ['required', 'accepted'],
            'age_confirmation' => ['required', 'accepted'],
        ];
    }
}
