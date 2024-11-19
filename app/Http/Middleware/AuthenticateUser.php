<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class AuthenticateUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->header('Authorization');
            $user = JWTAuth::authenticate($token);
            if(!$user){
                return response()->json([
                    'error'=>'Invalid Token',
                    'message'=>'The Provided Token is Invalid',
                    'status'=>401
                ]);
            }

        return $next($request);
    }
}
