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

    public function index()
    {
        return $this->itemCategoryService->getAll();
    }


    public function store(ItemCategoryStoreRequest $request)
    {
        return $this->itemCategoryService->store($request);
    }


    public function show(string $id)
    {
        return $this->itemCategoryService->getById($id);
    }


    public function update(ItemCategoryUpdateRequest $request, string $id)
    {
        return $this->itemCategoryService->update($request, $id);
    }

    public function destroy(string $id)
    {
        return $this->destroy($id);
    }
}
