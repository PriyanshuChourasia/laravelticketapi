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
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->itemGroupService->getAll();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemGroupStoreRequest $request)
    {
        return $this->itemGroupService->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->itemGroupService->getById($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ItemGroupUpdateRequest $request, string $id)
    {
        return $this->itemGroupService->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->itemGroupService->destroy($id);
    }
}
