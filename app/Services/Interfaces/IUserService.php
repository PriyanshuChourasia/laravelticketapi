<?php

namespace App\Services\Interfaces;

use App\Http\Requests\User\UserUpdateRequest;
use Illuminate\Http\Request;

interface IUserService
{
    public function getAll();
    public function getById(string $id);
    public function store();
    public function update(UserUpdateRequest $userUpdateRequest, string $id);
    public function destroy();
}
