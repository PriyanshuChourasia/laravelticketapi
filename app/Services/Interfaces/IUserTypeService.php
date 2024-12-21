<?php

namespace App\Services\Interfaces;

use App\Http\Requests\UserType\UserTypeStoreRequest;
use App\Http\Requests\UserType\UserTypeUpdateRequest;
use App\Models\UserType;

interface IUserTypeService
{
    public function getAll();
    public function getById(UserType $userType);
    public function store(UserTypeStoreRequest $userTypeStoreRequest);
    public function update(UserTypeUpdateRequest $userTypeUpdateRequest);
    public function destroy(UserType $userType);
}
