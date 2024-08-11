<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class LogSyncRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'key' => 'required|string',
            'freq' => 'required|string',
            'interval' => 'required|integer',
            'count' => 'required|integer',
            'status' => 'required|bool',
            'data' => 'optional|array',
        ];
    }
}
