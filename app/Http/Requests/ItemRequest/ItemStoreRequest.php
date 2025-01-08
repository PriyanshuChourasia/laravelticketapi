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
            'items.*.item_unit_id' => ['nullable', 'string'],
            "items.*.user_id" => ['string', 'nullable']
        ];
    }

    protected function prepareForValidation()
    {
        $items = $this->input('items', []);

        $defaultUserId = JWTAuth::user()->id;
        $itemUnitDefault = '7deaed0e-08c7-44d5-8eb2-56037e682bc0';

        $updatedItems = array_map(function ($a) use ($defaultUserId, $itemUnitDefault) {
            $a += ['item_unit_id' => $itemUnitDefault];
            $a += ['user_id' => $defaultUserId];
            return $a;
        }, $items);

        $this->merge(['items' => $updatedItems]);
    }
}
