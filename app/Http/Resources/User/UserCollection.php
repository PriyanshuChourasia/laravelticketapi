<?php

namespace App\Http\Resources\User;

use App\Http\Resources\Success\SuccessCollection;
use Illuminate\Http\Request;

class UserCollection extends SuccessCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection
        ];
    }
}
