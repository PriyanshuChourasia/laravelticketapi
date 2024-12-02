<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Auth\AuthLoginRequest;
use App\Http\Requests\Auth\AuthRegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use App\Http\Resources\Auth\AuthResource;
use App\Http\Resources\User\UserResource;

class AuthController extends BaseController
{

    public function index(){
        return response()->json([
            "data"=>"Priyanshu",
            "message"=>"This is login"
        ]);
    }

    /***
     * Get a JWT via given credentials
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(AuthLoginRequest $authLoginRequest){
        // $credentials = request(['email','password']);

        dd(!$token = JWTAuth::attempt($authLoginRequest));

        if(!$token = JWTAuth::attempt($credentials))
        {
            $response = [
                'message'=>'Unauthorized',
                'error'=>'Check your credentials',
                'status'=>401
            ];

            return new AuthResource((object)$response);
        }

        $success = $this->responseWithToken($token);

        return new AuthResource((object)$success);
    }


    public function register(AuthRegisterRequest $authRegisterRequest){
        $data = $authRegisterRequest->validated();
        $authRegister = User::create($data);
        return new UserResource($authRegister);
    }



    public function responseWithToken($token){
        return [
            'access_token' => $token,
            'token_type'=> 'bearer',
            'expires_in'=> JWTAuth::factory()->getTTL() * 60
        ];
    }



    public function profile(){
        $user = JWTAuth::user();
        return new UserResource(JWTAuth::user());
    }
}
