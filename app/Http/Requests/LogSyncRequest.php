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
        return false;
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
            'rrule' => 'required|array',
            'rrule.freq' => 'required|string',
            'rrule.interval' => 'required|integer',
            'rrule.count' => 'required|integer',
            'data' => 'optional|array',
        ];
    }
}
