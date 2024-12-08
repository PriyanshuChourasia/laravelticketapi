<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserType\UserTypeDeleteRequest;
use App\Http\Requests\UserType\UserTypeRequest;
use App\Http\Resources\UserType\UserTypeCollection;
use App\Http\Resources\UserType\UserTypeResource;
use App\Models\UserType;
use Illuminate\Http\Request;

class UserTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new UserTypeCollection(UserType::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserTypeRequest $request)
    {
        $data = $request->validated();
        $userType = UserType::create($data);
        return new UserTypeResource($userType);
    }

    /**
     * Display the specified resource.
     */
    public function show(UserType $userType)
    {
        return new UserTypeResource($userType);
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
    public function destroy(UserType $userType)
    {
        $userType->delete();
        return response()->json([
            'status' => true,
            'data' => [
                'result' => 'Record has been deleted'
            ]
        ], 200);
    }
}
