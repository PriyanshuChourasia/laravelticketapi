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
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->itemService->getAll();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemStoreRequest $itemStoreRequest)
    {
        return $this->itemService->store($itemStoreRequest);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        //
    }
}
