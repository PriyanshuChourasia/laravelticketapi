<?php

namespace App\Services\Interfaces;

use App\Http\Requests\ItemGroup\ItemGroupStoreRequest;
use App\Http\Requests\ItemGroup\ItemGroupUpdateRequest;

interface IItemGroupService
{
    public function getAll();
    public function getById(string $id);
    public function store(ItemGroupStoreRequest $itemGroupStoreRequest);
    public function update(ItemGroupUpdateRequest $itemGroupStoreRequest, string $id);
    public function destroy(string $id);
}
