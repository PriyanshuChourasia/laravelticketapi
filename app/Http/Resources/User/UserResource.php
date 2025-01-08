<?php

namespace App\Http\Resources\User;

use App\Http\Resources\Success\SuccessResource;
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
        return array_filter(
            [
                'id' => $this->id,
                'username' => $this->username,
                'email' => $this->email,
                'firstName' => $this->firstName,
                'lastName' => $this->lastName,
                'phoneNumber' => $this->phoneNumber,
                'image' => $this->profile_path
            ],
            function ($value) {
                return $value !== null;
            }
        );
    }
}
