<?php

namespace App\Services;

use App\Http\Requests\UserType\UserTypeStoreRequest;
use App\Http\Requests\UserType\UserTypeUpdateRequest;
use App\Http\Resources\UserType\UserTypeCollection;
use App\Http\Resources\UserType\UserTypeResource;
use App\Models\UserType;
use App\Services\Interfaces\IUserTypeService;

class UserTypeService implements IUserTypeService
{
    public function getAll()
    {
        return new UserTypeCollection(UserType::all());
    }

    public function getById(UserType $userType)
    {
        return new UserTypeResource($userType);
    }


    public function store(UserTypeStoreRequest $userTypeStoreRequest)
    {
        $data = $userTypeStoreRequest->validated();
        $response = UserType::create($data);
        return new UserTypeResource($response);
    }


    public function update(UserTypeUpdateRequest $userTypeUpdateRequest)
    {
        $data = $userTypeUpdateRequest->validated();
        $response = UserType::create($data);
        return new UserTypeResource($response);
    }

    public function destroy(UserType $userType)
    {
        $userType->delete();
        return response()->json([
            'data' => [
                'message' => 'Data deleted successfully'
            ],
            'success' => false
        ]);
    }
}
