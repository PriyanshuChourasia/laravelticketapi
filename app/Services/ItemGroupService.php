<?php

namespace App\Services;

use App\Http\Requests\ItemGroup\ItemGroupStoreRequest;
use App\Http\Requests\ItemGroup\ItemGroupUpdateRequest;
use App\Http\Resources\Item\ItemCollection;
use App\Http\Resources\ItemGroup\ItemGroupCollection;
use App\Http\Resources\ItemGroup\ItemGroupResource;
use App\Models\ItemGroup;
use App\Services\Interfaces\IItemGroupService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class ItemGroupService implements IItemGroupService
{

    public function getAll(Request $request)
    {
        if ($request->query() !== []) {
            $params = $request->query();
            if (array_diff_key($params, ['user_id' => '']) !== []) {
                throw ValidationException::withMessages(['param other than user_id not allowed'], 401);
            }

            $userId = $request->query('user_id');

            $data = ItemGroup::where('created_by', '=', $userId)->get();
            return new ItemGroupCollection($data);
        } else {
            return new ItemGroupCollection(ItemGroup::all());
        }
    }



    public function getById(string $id)
    {
        $data = ItemGroup::findOrFail($id);
        return new ItemGroupResource($data);
    }



    public function store(ItemGroupStoreRequest $itemGroupStoreRequest)
    {
        $data = $itemGroupStoreRequest->validated();
        $groupData = ItemGroup::create($data);
        return new ItemGroupResource($groupData);
    }



    public function update(ItemGroupUpdateRequest $itemGroupUpdateRequest, string $id)
    {
        $data = ItemGroup::findOrFail($id);
        $updateData = $itemGroupUpdateRequest->validated();
        $data->update($updateData);
        return new ItemGroupResource($data);
    }




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
