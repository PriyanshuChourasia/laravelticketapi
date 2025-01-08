<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'firstName' => ['nullable', 'string', 'max:255'],
            'lastName' => ['nullable', 'string', 'max:255'],
            'username' => ['nullable', 'string'],
            'profile_path' => ['nullable', 'sometimes', 'image', 'mimes:png,jpg,jpeg'],
            'password' => ['sometimes', 'string', 'password'],
            'email' => ['nullable', 'email', Rule::unique('users')->ignore($this->id)]
        ];
    }
}
