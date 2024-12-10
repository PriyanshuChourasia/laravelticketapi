<?php

namespace App\Http\Resources\User;

use App\Http\Resources\Success\SuccessResource;
use App\Http\Resources\UserType\UserTypeResource;
use Illuminate\Http\Request;

class UserResource extends SuccessResource
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
            'email' => $this->email,
            'user_type' => new UserTypeResource($this->whenLoaded('user_types')),
        ];
    }
}
