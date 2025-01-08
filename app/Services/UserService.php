<?php

namespace App\Services;

use App\Http\Requests\User\UserUpdateRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use App\Services\Interfaces\IUserService;


class UserService implements IUserService
{
    /**
     *   Return a listing of resource
     */
    public function getAll() {}



    /**
     *   Get a new resource by Id
     */
    public function getById(string $id) {}


    /**
     *   store a new resource
     */
    public function store() {}


    /**
     *   Update resource in storage
     */
    public function update(UserUpdateRequest $userUpdateRequest, string $id)
    {
        $data = $userUpdateRequest->validated();
        $userData = User::findOrFail($id);
        $userData->update($data);
        return new UserResource($userData);
    }




    /**
     *   Delete a specified resource
     */
    public function destroy() {}
}
