<?php

namespace App\Http\Resources\ItemCategory;

use App\Http\Resources\Success\SuccessResource;
use Illuminate\Http\Request;

class ItemCategoryResource extends SuccessResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return array_filter([
            'id' => $this->id,
            'name' => $this->name,
            'alias' => $this->alias
        ], function ($value) {
            return $value !== null;
        });
    }
}
