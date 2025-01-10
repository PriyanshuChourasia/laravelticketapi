<?php

namespace App\Services\Interfaces;

use App\Http\Requests\ItemGroup\ItemGroupStoreRequest;
use App\Http\Requests\ItemGroup\ItemGroupUpdateRequest;
use Illuminate\Http\Request;

interface IItemGroupService
{
    public function getAll(Request $request);
    public function getById(string $id);
    public function store(ItemGroupStoreRequest $itemGroupStoreRequest);
    public function update(ItemGroupUpdateRequest $itemGroupStoreRequest, string $id);
    public function destroy(string $id);
}
