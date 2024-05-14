<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class LogRequest
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        $requestData = $request->all();
        $responseData = $response->original;

        $user = auth()->user();

        Log::channel('requests')->info('Request logged:', [
            'url' => $request->fullUrl(),
            'method' => $request->method(),
            'ip' => $request->ip(),
            'user_agent' => $request->header('User-Agent'),
            'user' => $user->email ?? 'Guest',
            'request' => json_encode($requestData),
            'response' => json_encode($responseData)
        ]);

        return $response;
    }

}
