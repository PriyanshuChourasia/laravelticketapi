<?php

namespace App\Services;

use App\Http\Requests\ItemRequest\ItemStoreRequest;
use App\Http\Resources\Item\ItemCollection;
use App\Http\Resources\Item\ItemResource;
use App\Http\Resources\User\UserResource;
use App\Models\Item;
use App\Services\Interfaces\IItemService;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

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
    public function getById(string $id)
    {

        $data = Item::all()->where('user_id', $id);
        return new ItemCollection($data);
    }


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

        $id = JWTAuth::user()->id;
        $itemdata = Item::all()->where('user_id', $id);
        return new ItemCollection($itemdata);
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
        $data = Item::findOrFail($id);
        $data->delete();
        return response()->json([
            'message' => 'Record deleted successfully',
            'status' => 200
        ], 200);
    }
}
