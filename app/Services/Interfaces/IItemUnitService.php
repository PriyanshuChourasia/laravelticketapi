<?php

namespace App\Services\Interfaces;

use App\Http\Requests\ItemUnit\ItemUnitStoreRequest;

interface IItemUnitService
{
    public function getAll();
    public function getById(string $id);
    public function store(ItemUnitStoreRequest $itemUnitStoreRequest);
    public function update();
    public function destroy($id);
}
