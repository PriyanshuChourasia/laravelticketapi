<?php

namespace App\Services;

use App\Http\Requests\ItemUnit\ItemUnitStoreRequest;
use App\Http\Resources\ItemUnit\ItemUnitCollection;
use App\Http\Resources\ItemUnit\ItemUnitResource;
use App\Models\ItemUnit;
use App\Services\Interfaces\IItemUnitService;


class ItemUnitService implements IItemUnitService
{
    /**
     *   Return a listing of resource
     */
    public function getAll()
    {
        return new ItemUnitCollection(ItemUnit::all());
    }



    /**
     *   Get a new resource by Id
     */
    public function getById(string $id)
    {
        $data = ItemUnit::findOrFail($id);
        return new ItemUnitResource($data);
    }


    /**
     *   store a new resource
     */
    public function store(ItemUnitStoreRequest $itemUnitStoreRequest)
    {
        $data = $itemUnitStoreRequest->validated();
        $itemUnit = ItemUnit::create($data);
        return new ItemUnitResource($itemUnit);
    }


    /**
     *   Update resource in storage
     */
    public function update() {}




    /**
     *   Delete a specified resource
     */
    public function destroy($id)
    {
        $data = ItemUnit::findOrFail($id);
        $data->delete();
        return response()->json([
            'message' => 'Record deleted successfully',
            'status' => 200
        ], 200);
    }
}
