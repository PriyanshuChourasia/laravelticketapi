<?php

namespace App\Http\Resources\Success;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class SuccessCollection extends ResourceCollection
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

    public function with(Request $request): array
    {
        $countMessage = count($this->collection) > 1 ? 'Records' . ' fetched' : 'Record' . ' fetched';
        return [
            'success' => true,
            'code' => 200,
            'status' => count($this->collection) . ' ' . $countMessage
        ];
    }
}
