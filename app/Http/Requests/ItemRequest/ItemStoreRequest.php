<?php

namespace App\Http\Requests\ItemRequest;

use Illuminate\Foundation\Http\FormRequest;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class ItemStoreRequest extends FormRequest
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
            'items' => ['required', 'array'],
            'items.*.name' => ['string', "required", "max:255"],
            'items.*.cost' => ['numeric', 'required'],
            "items.*.user_id" => ['string', 'nullable']
        ];
    }

    protected function prepareForValidation()
    {
        $items = $this->input('items', []);

        $defaultUserId = JWTAuth::user()->id;

        $updatedItems = array_map(function ($item) use ($defaultUserId) {
            return array_merge($item, ['user_id' => $defaultUserId]);
        }, $items);

        $this->merge(['items' => $updatedItems]);
    }
}
