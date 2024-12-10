<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class VerifyToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->header('Authorization');
        if (!$token) {
            return response()->json([
                'error' => [
                    'message' => 'Authorization Token is required',
                ],
                'success' => false
            ], 401);
        } else if ($token) {
            $user = JWTAuth::user();
            if (!$user) {
                return response()->json([
                    'error' => [
                        'message' => 'The provided token is invalid.',
                    ],
                    'success' => false
                ], 401);
            }
        }
        return $next($request);
    }
}
