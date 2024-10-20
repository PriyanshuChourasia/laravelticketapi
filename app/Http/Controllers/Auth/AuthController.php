<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance
     * @return void
     */
    // public function __construct(){
    //     $this->middleware('auth:api',['expect'=> ['login']]);
    // }

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
    public function login(Request $request){
        $email = $request->input('email');
        $password = $request->input('password');
        
        if($email == "" || $password == "")
        {

        }
    }
}
