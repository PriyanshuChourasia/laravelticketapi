<?php

namespace App\Http\Controllers;

use App\Http\Requests\StatusType\StoreStatusTypeRequest;
use App\Http\Requests\StatusType\UpdateStatusTypeRequest;
use App\Http\Resources\StatusType\StatusTypeCollection;
use App\Http\Resources\StatusType\StatusTypeResource;
use App\Models\StatusType;
use Illuminate\Http\Request;

class StatusTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new StatusTypeCollection(StatusType::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStatusTypeRequest $storeStatusTypeRequest)
    {
        $data = $storeStatusTypeRequest->validated();
        $status = StatusType::create($data);
        return new StatusTypeResource($status);
    }

    /**
     * Display the specified resource.
     */
    public function show(StatusType $statusType)
    {
        return new StatusTypeResource($statusType);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStatusTypeRequest $updateStatusTypeRequest, StatusType $statusType)
    {
        $data = $updateStatusTypeRequest->validated();
        $statusType->update($data);
        return new StatusTypeResource($statusType);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StatusType $statusType)
    {
        $statusType->delete();
        return response()->json([
            'data' => [
                'message' => 'Record has been deleted'
            ],
            'status' => true
        ]);
    }
}
