<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Auth\AuthLoginRequest;
use App\Http\Requests\Auth\AuthRegisterRequest;
use App\Models\User;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use App\Http\Resources\Auth\AuthResource;
use App\Http\Resources\User\UserResource;
use App\Models\UserType;
use Illuminate\Support\Facades\Auth;

class AuthController extends BaseController
{

    protected $userLoader = ['user_types'];
    public function index()
    {
        return response()->json([
            "data" => "Priyanshu",
            "message" => "This is login"
        ]);
    }

    /***
     * Get a JWT via given credentials
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(AuthLoginRequest $authLoginRequest)
    {

        //This line  of code is getting me the validation for the credentials entered;
        $credentials = $authLoginRequest->validated();
        // $userData = User::findOrFail($authLoginRequest('email'));



        $token = Auth::attempt($credentials);
        $user = Auth::guard('api')->user();


        if (!$token) {

            $response = [
                'message' => 'Unauthorized',
                'error' => 'Check your credentials',
                'status' => 401
            ];

            return response()->json([
                'error' => $response,
                'success' => false
            ]);
        }

        $refreshToken = JWTAuth::customClaims(
            [
                'exp' => now()->addDays(2)->timestamp,
            ]
        )->fromUser($user);

        $loginResponse = [
            'access_token' => $token,
            'refresh_token' => $refreshToken,
            'status' => '200',
        ];


        return response()->json([
            'data' => $loginResponse,
            'success' => true
        ], 200);

        // return new AuthResource((object)$loginResponse);
    }


    public function register(AuthRegisterRequest $request)
    {
        $data = $request->validated();
        $authRegister = User::create($data);
        return new UserResource($authRegister);
    }

    // This function will called when the access token will get expire and it will generated to provide new access_token and refresh_token
    public function respondWithNewTokens()
    {
        $user = Auth::user();
        $access_Token = Auth::tokenById($user->id);
        $refresh_Token = JWTAuth::customClaims(
            [
                'exp' => now()->addDays(4)->timestamp,
            ]
        )->fromUser($user);

        return response()->json([
            'access_token' => $access_Token,
            'refresh_token' => $refresh_Token,
            'success' => true
        ], 200);
    }



    public function responseWithToken($token)
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 60
        ];
    }



    public function profile()
    {
        $user = JWTAuth::user();
        return new UserResource($user->load($this->userLoader));
    }
}
