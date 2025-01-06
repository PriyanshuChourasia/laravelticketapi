<?php

namespace App\Services\Interfaces;

use App\Http\Requests\ItemRequest\ItemStoreRequest;

interface IItemService
{
    public function getAll();
    public function getById(string $id);
    public function store(ItemStoreRequest $itemStoreRequest);
    public function update();
    public function destroy();
}
