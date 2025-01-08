<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemCategory\ItemCategoryStoreRequest;
use App\Http\Requests\ItemCategory\ItemCategoryUpdateRequest;
use App\Services\ItemCategoryService;
use Illuminate\Http\Request;

class ItemCategoryController extends Controller
{
    protected $itemCategoryService;
    public function __construct(ItemCategoryService $itemCategoryService)
    {
        $this->itemCategoryService = $itemCategoryService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->itemCategoryService->getAll();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemCategoryStoreRequest $request)
    {
        return $this->itemCategoryService->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->itemCategoryService->getById($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ItemCategoryUpdateRequest $request, string $id)
    {
        return $this->itemCategoryService->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->destroy($id);
    }
}
