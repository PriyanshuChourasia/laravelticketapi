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

    public function index()
    {
        return new UserTypeCollection(UserType::all());
    }


    public function store(UserTypeRequest $request)
    {
        $data = $request->validated();
        $userType = UserType::create($data);
        return new UserTypeResource($userType);
    }


    public function show(UserType $userType)
    {
        return new UserTypeResource($userType);
    }


    public function update(Request $request, string $id)
    {
        //
    }


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
