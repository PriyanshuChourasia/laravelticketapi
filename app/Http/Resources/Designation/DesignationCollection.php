<?php

namespace App\Http\Resources\Designation;

use App\Http\Resources\Success\SuccessCollection;
use Illuminate\Http\Request;

class DesignationCollection extends SuccessCollection
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
