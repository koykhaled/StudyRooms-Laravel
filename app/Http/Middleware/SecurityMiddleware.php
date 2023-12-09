<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // remove vulanerabilities from http request
        $response = $next($request);
        $response->headers->remove('X-Powered-By');
        $response->headers->remove('Server');
        $response->headers->remove('x-turbo-charged-by');

        $response->headers->set('X-Frame-Options', 'deny');
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-Primitted-Domain-Policies', 'none');
        $response->headers->set('Referrer-Policy', 'noreferrer');
        $response->headers->set('Cross-Origin-Embedder-Policy', 'require-corp');
        $response->headers->set('Content-Security-Policy', "default-src 'none'; style-src 'self'; form-action 'self'; img-src 'self'");
        return $response;
    }
}