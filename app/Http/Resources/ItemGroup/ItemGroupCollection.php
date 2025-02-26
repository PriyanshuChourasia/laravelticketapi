<?php

namespace App\Http\Resources\ItemGroup;

use App\Http\Resources\Success\SuccessCollection;
use Illuminate\Http\Request;

class ItemGroupCollection extends SuccessCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
