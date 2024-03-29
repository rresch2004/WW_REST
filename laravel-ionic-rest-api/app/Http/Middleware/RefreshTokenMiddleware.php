<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RefreshTokenMiddleware
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if ($response->status() === 401) {
            return response()->json([
                'message' => 'Token expired',
                'refresh_token' => Auth::refresh(),
            ]);
        }

        return $response;
    }

}
