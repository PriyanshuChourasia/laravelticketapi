<?php

namespace App\Http\Resources\Category;

use App\Http\Resources\Success\SuccessResource;
use Illuminate\Http\Request;

class CategoryResource extends SuccessResource
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
            'name' => $this->name
        ];
    }
}
