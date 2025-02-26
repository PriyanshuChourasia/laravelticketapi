<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class AuthRegisterRequest extends FormRequest
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
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:7', 'max:255'],
            'user_type_id' => ['string', 'nullable']
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'user_type_id' => $this->input('user_type_id', '3b781758-3eec-4ddd-bb0d-ad8a8fec8590')
        ]);
    }
}
