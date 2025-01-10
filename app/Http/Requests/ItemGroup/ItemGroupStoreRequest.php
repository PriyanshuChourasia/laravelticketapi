<?php

namespace App\Http\Requests\ItemGroup;

use Illuminate\Foundation\Http\FormRequest;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class ItemGroupStoreRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'alias' => ['nullable', 'string', 'max:255'],
            'created_by' => ['nullable', 'uuid']
        ];
    }

    protected function prepareForValidation()
    {
        $user_id = JWTAuth::user()->id;
        $this->merge(['created_by' => $user_id]);
    }
}
