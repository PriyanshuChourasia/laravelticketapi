<?php

namespace App\Http\Resources\Item;

use App\Http\Resources\ItemUnit\ItemUnitResource;
use App\Http\Resources\Success\SuccessResource;
use Illuminate\Http\Request;

class ItemResource extends SuccessResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return array_filter([
            'name' => $this->name,
            'cost' => $this->cost,
            'qauntity' => $this->qtn,
            'item_unit' => $this->item_unit?->name,
            'unit_alias' => $this->item_unit?->alias,
            'item_group' => $this->item_group?->name,
            'group_alias' => $this->item_group?->alias
        ], function ($value) {
            return $value != null;
        });
    }
}
