<?php

namespace App\Services;

use App\Http\Requests\ItemRequest\ItemStoreRequest;
use App\Http\Resources\Item\ItemCollection;
use App\Http\Resources\Item\ItemResource;
use App\Models\Item;
use App\Services\Interfaces\IItemService;


class ItemService implements IItemService
{
    /**
     *   Return a listing of resource
     */
    public function getAll()
    {
        return new ItemCollection(Item::all());
    }



    /**
     *   Get a new resource by Id
     */
    public function getById(string $id) {}


    /**
     *   store a new resource
     */
    public function store(ItemStoreRequest $itemStoreRequest)
    {
        $data = $itemStoreRequest->validated();


        foreach ($data as  $itemData) {
            foreach ($itemData as  $value) {
                Item::create($value);
            }
        }
        return new ItemCollection(Item::all());
    }


    /**
     *   Update resource in storage
     */
    public function update() {}




    /**
     *   Delete a specified resource
     */
    public function destroy() {}
}
