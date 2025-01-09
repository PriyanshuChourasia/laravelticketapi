<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemRequest\ItemStoreRequest;
use App\Services\ItemService;
use Illuminate\Http\Request;

class ItemController extends Controller
{

    protected $itemService;

    public function __construct(ItemService $itemService)
    {
        $this->itemService = $itemService;
    }

    public function index()
    {
        return $this->itemService->getAll();
    }


    public function store(ItemStoreRequest $itemStoreRequest)
    {
        return $this->itemService->store($itemStoreRequest);
    }


    public function show(string $id)
    {
        return $this->itemService->getById($id);
    }


    public function update(Request $request, string $id) {}


    public function destroy(string $id)
    {
        return $this->itemService->destroy($id);
    }
}
