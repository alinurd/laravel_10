<?php

// app/Http/Middleware/ApiKeyMiddleware.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiKeyMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $apiKey = $request->header('X-API-KEY');
        $secretKey = env('API_SECRET_KEY');

        if ($apiKey !== $secretKey) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}
