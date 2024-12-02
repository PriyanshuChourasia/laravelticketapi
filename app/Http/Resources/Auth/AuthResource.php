<?php

namespace App\Http\Resources\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {

            return [
                'access_token'=>$this->access_token,
                'token_type'=> $this->token_type,
            ];

    }


    /**
     * Additional success param
     *
     * @param Request $request
     * @return array
     */
    public function with(Request $request){

            return[
                'error'=>[
                    'message'=> $this->message ?? "An error occurred",
                    'error'=> $this->error ?? "Unknown error",
                    'status'=> $this->status ?? 500
                ],
                'success'=> false,
            ];

    }
}
