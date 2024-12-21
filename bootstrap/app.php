<?php

use App\Console\Commands\ServicePattern;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        apiPrefix: 'api/admin-service',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withCommands([
        ServicePattern::class
    ])
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->use([
            //    'verify.token' => App\Http\Middleware\VerifyToken::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (ValidationException $e, Request $request) {
            if ($request->is('api/admin-service/*')) {
                return response()->json([
                    'success' => false,
                    'errors' => [
                        'message' => $e->getMessage(),
                    ],

                ], 401);
            }
        });

        $exceptions->render(function (NotFoundHttpException $e, Request $request) {
            if ($request->is('api/admin-service/*')) {
                return response()->json([
                    'success' => false,
                    'errors' => [
                        'message' => 'Record not found'
                    ],
                ], 404);
            }
        });
    })->create();
