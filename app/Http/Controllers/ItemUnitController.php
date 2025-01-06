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
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->itemUnitService->getAll();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemUnitStoreRequest $request)
    {
        return $this->itemUnitService->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->itemUnitService->getById($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->itemUnitService->destroy($id);
    }
}
