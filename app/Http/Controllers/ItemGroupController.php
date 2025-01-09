<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemGroup\ItemGroupStoreRequest;
use App\Http\Requests\ItemGroup\ItemGroupUpdateRequest;
use App\Services\ItemGroupService;
use Illuminate\Http\Request;

class ItemGroupController extends Controller
{
    protected $itemGroupService;
    public function __construct(ItemGroupService $itemGroupService)
    {
        $this->itemGroupService = $itemGroupService;
    }

    public function index()
    {
        return $this->itemGroupService->getAll();
    }


    public function store(ItemGroupStoreRequest $request)
    {
        return $this->itemGroupService->store($request);
    }


    public function show(string $id)
    {
        return $this->itemGroupService->getById($id);
    }


    public function update(ItemGroupUpdateRequest $request, string $id)
    {
        return $this->itemGroupService->update($request, $id);
    }


    public function destroy(string $id)
    {
        return $this->itemGroupService->destroy($id);
    }
}
