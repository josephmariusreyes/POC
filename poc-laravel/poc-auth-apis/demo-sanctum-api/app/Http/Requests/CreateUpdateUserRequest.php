<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateUpdateUserRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $userId = $this->input('id');
        $emailRule = 'required|email|unique:users,email';
        if ($userId) {
            $emailRule .= ',' . $userId;
        }
        return [
            'id' => ['sometimes', 'integer', 'exists:users,id'],
            'name' => ['required', 'string', 'max:255'],
            'email' => $emailRule,
            'password' => $userId
                ? ['nullable', 'string', 'min:8']
                : ['required', 'string', 'min:8'],
        ];
    }
}
