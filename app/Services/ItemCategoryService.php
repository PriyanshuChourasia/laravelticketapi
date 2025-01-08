<?php

namespace App\Services;

use App\Http\Requests\ItemCategory\ItemCategoryStoreRequest;
use App\Http\Requests\ItemCategory\ItemCategoryUpdateRequest;
use App\Http\Resources\ItemCategory\ItemCategoryCollection;
use App\Http\Resources\ItemCategory\ItemCategoryResource;
use App\Models\ItemCategory;
use App\Services\Interfaces\IItemCategoryService;


class ItemCategoryService implements IItemCategoryService
{
    /**
     *   Return a listing of resource
     */
    public function getAll()
    {
        return new ItemCategoryCollection(ItemCategory::all());
    }



    /**
     *   Get a new resource by Id
     */
    public function getById(string $id)
    {
        $data = ItemCategory::findOrFail($id);
        return new ItemCategoryResource($data);
    }


    /**
     *   store a new resource
     */
    public function store(ItemCategoryStoreRequest $itemCategoryStoreRequest)
    {
        $data = $itemCategoryStoreRequest->validated();
        $category = ItemCategory::create($data);
        return new ItemCategoryResource($category);
    }


    /**
     *   Update resource in storage
     */
    public function update(ItemCategoryUpdateRequest $itemCategoryUpdateRequest, string $id)
    {
        $data = $itemCategoryUpdateRequest->validated();
        $categoryData = ItemCategory::findOrFail($id);
        $categoryData->update($data);
        return new ItemCategoryResource($categoryData);
    }




    /**
     *   Delete a specified resource
     */
    public function destroy(string $id)
    {
        $data = ItemCategory::findOrFail($id);
        $data->delete();
        return response()->json([
            'message' => 'Record deleted successfully',
            'status' => 200
        ], 200);
    }
}
