<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryType\CategoryTypeRequest;
use App\Http\Requests\CategoryType\CategoryUpdateRequest;
use App\Http\Resources\CategoryType\CategoryTypeCollection;
use App\Http\Resources\CategoryType\CategoryTypeResource;
use App\Models\CategoryType;
use Illuminate\Http\Request;

class CategoryTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new CategoryTypeCollection(CategoryType::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryTypeRequest $request)
    {
        $data = $request->validated();
        $category = CategoryType::create($data);
        return new CategoryTypeResource($category);
    }

    /**
     * Display the specified resource.
     */
    public function show(CategoryType $categoryType)
    {
        return new CategoryTypeResource($categoryType);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryUpdateRequest $request, CategoryType $categoryType)
    {
        $data = $request->validated();
        $categoryType->update($data);
        return new CategoryTypeResource($categoryType);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CategoryType $categoryType)
    {
        $categoryType->delete();
        return response()->json([
            'data' => [
                'message' => 'Record has been deleted'
            ],
            'status' => true
        ]);
    }
}
