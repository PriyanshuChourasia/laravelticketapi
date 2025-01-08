<?php

namespace App\Services;

use App\Http\Requests\ItemGroup\ItemGroupStoreRequest;
use App\Http\Requests\ItemGroup\ItemGroupUpdateRequest;
use App\Http\Resources\ItemGroup\ItemGroupCollection;
use App\Http\Resources\ItemGroup\ItemGroupResource;
use App\Models\ItemGroup;
use App\Services\Interfaces\IItemGroupService;


class ItemGroupService implements IItemGroupService
{
    /**
     *   Return a listing of resource
     */
    public function getAll()
    {
        return new ItemGroupCollection(ItemGroup::all());
    }



    /**
     *   Get a new resource by Id
     */
    public function getById(string $id)
    {
        $data = ItemGroup::findOrFail($id);
        return new ItemGroupResource($data);
    }


    /**
     *   store a new resource
     */
    public function store(ItemGroupStoreRequest $itemGroupStoreRequest)
    {
        $data = $itemGroupStoreRequest->validated();
        $groupData = ItemGroup::create($data);
        return new ItemGroupResource($groupData);
    }


    /**
     *   Update resource in storage
     */
    public function update(ItemGroupUpdateRequest $itemGroupUpdateRequest, string $id)
    {
        $data = ItemGroup::findOrFail($id);
        $updateData = $itemGroupUpdateRequest->validated();
        $data->update($updateData);
        return new ItemGroupResource($data);
    }




    /**
     *   Delete a specified resource
     */
    public function destroy(string $id)
    {
        $data = ItemGroup::findOrFail($id);
        $data->delete();
        return response()->json([
            'message' => 'Record deleted successfully',
            'status' => 200
        ], 200);
    }
}
