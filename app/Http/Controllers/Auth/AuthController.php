<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BaseController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

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
    public function login(){
        $credentials = request(['email','password']);


        if(!$token = JWTAuth::attempt($credentials))
        {
            return $this->sendError('Unauthorized',['error'=> 'Unauthorized']);
        }

        $success = $this->responseWithToken($token);

        return $this->sendResponse($success,'User login successfully');
    }


    public function register(Request $request){
        
        $validator = Validator::make($request->all(),[
            'name'=>'required',
            'email'=> 'required',
            "password"=> 'required'
        ]);

        if($validator->fails()){
            return $this->sendError("Validation Error.",$validator->errors());
        }
        else{
            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = bcrypt($request->input('password'));

            $user->save();
            $success['user'] = $user;
            return $this->sendResponse($success,"User Registered Successfully");
        }

    }



    public function responseWithToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 60
        ]);
    }



    public function profile(){
        $success = JWTAuth::user();
        return $this->sendResponse($success,'Profile fetched successfully');
    }
}
