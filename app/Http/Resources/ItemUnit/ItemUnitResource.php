<?php

namespace App\Http\Resources\ItemUnit;

use App\Http\Resources\Success\SuccessResource;
use Illuminate\Http\Request;

class ItemUnitResource extends SuccessResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'alias' => $this->alias
        ];
    }
}
