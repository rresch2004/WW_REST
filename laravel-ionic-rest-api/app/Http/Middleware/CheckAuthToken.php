<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAuthToken
{
    public function handle(Request $request, Closure $next)
    {
        // Überprüfen, ob ein Token im Request-Header vorhanden ist
        if (!$request->bearerToken()) {
            // Wenn kein Token vorhanden ist, geben Sie eine Fehlerantwort zurück
            return response()->json(['error' => 'Unauthorized. Token missing.'], 401);
        }

        // Validieren Sie den Token hier, z.B. mit Laravel Passport oder JWTAuth
        // Beispiel mit Laravel Passport:
        if (!Auth::guard('api')->check()) {
            // Wenn der Token ungültig ist, geben Sie eine Fehlerantwort zurück
            return response()->json(['error' => 'Unauthorized. Invalid token.'], 401);
        }

        // Wenn der Token gültig ist, fahren Sie mit der Anfrage fort
        return $next($request);
    }
}
