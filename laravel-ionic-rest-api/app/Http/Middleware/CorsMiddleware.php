<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CorsMiddleware
{
    public function handle($request, Closure $next)
{
    // Erlaube Anfragen von allen Ursprüngen
    $headers = [
        'Access-Control-Allow-Origin' => '*',
        'Access-Control-Allow-Methods' => 'GET, POST, PUT, DELETE, OPTIONS',
        'Access-Control-Allow-Headers' => 'Content-Type, Authorization, X-XSRF-TOKEN',
    ];

    // Füge die CORS-Header zu allen Antworten hinzu
    if ($request->isMethod('OPTIONS')) {
        return response()->json('OK', 200, $headers);
    }

    $response = $next($request);

    foreach ($headers as $key => $value) {
        $response->headers->set($key, $value);
    }

    return $response;
}
}
