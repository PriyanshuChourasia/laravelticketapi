<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemUnit\ItemUnitStoreRequest;
use App\Services\ItemUnitService;
use Illuminate\Http\Request;

class ItemUnitController extends Controller
{
    protected $itemUnitService;
    public function __construct(ItemUnitService $itemUnitService)
    {
        $this->itemUnitService = $itemUnitService;
    }

    public function index()
    {
        return $this->itemUnitService->getAll();
    }


    public function store(ItemUnitStoreRequest $request)
    {
        return $this->itemUnitService->store($request);
    }

    public function show(string $id)
    {
        return $this->itemUnitService->getById($id);
    }


    public function update(Request $request, string $id)
    {
        //
    }


    public function destroy(string $id)
    {
        return $this->itemUnitService->destroy($id);
    }
}
