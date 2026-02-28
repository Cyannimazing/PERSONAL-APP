<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GrantAppRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'application_id' => ['required', 'integer', 'exists:applications,id'],
            'expires_at' => ['nullable', 'date'],
        ];
    }
}
