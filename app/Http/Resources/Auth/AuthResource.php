<?php

namespace App\Http\Resources\Auth;

use App\Http\Resources\Success\SuccessResource;
use Illuminate\Http\Request;

class AuthResource extends SuccessResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'access_token' => $this->access_token,
            'token_type' => $this->token_type,
        ];
    }
}
