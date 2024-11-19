<?php

namespace App\Http\Resources\Error;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ErrorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'message'=> $this->message ?? 'An error occurred',
            'error'=> $this->error ?? null,
            'status'=> $this->status ?? null
        ];
    }


    /**
     *
     * @param Request $reuqest
     * @return array
     */
    public function with(Request $request){
        return [
            'success'=>false
        ];
    }
}
