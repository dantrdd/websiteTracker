<?php

namespace App\Http\Middleware;

use App\Models\Client;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CorsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $requestOrigin = $request->header('referer');
        $host = parse_url($requestOrigin, PHP_URL_HOST);
        $port = parse_url($requestOrigin, PHP_URL_PORT);

        $domainWithPort = $port ? "$host:$port" : $host;

        if (Client::isWhiteListedByOrigin($domainWithPort) || $domainWithPort === config('app.url')) {
            $response = $next($request);
            return $response
                ->header('Access-Control-Allow-Origin', $requestOrigin)
                ->header('Access-Control-Allow-Methods', 'GET, POST, OPTIONS')
                ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With')
                ->header('Access-Control-Allow-Credentials', 'true');
        }

        return response()->json(['error' => 'CORS Policy Denied'], 403);
    }
}
