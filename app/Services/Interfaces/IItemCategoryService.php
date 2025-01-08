<?php

namespace App\Services\Interfaces;

use App\Http\Requests\ItemCategory\ItemCategoryStoreRequest;
use App\Http\Requests\ItemCategory\ItemCategoryUpdateRequest;

interface IItemCategoryService
{
    public function getAll();
    public function getById(string $id);
    public function store(ItemCategoryStoreRequest $itemCategoryStoreRequest);
    public function update(ItemCategoryUpdateRequest $itemCategoryUpdateRequest, string $id);
    public function destroy(string $id);
}
