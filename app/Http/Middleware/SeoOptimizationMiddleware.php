<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SeoOptimizationMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Add security headers
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-Frame-Options', 'DENY');
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        
        // Add performance headers
        $response->headers->set('Cache-Control', 'public, max-age=3600');
        
        // Add SEO headers
        $response->headers->set('X-Robots-Tag', 'index, follow');
        
        // Add language headers
        $response->headers->set('Content-Language', 'pt');
        
        // Add geographic headers
        $response->headers->set('X-Geo-Country', 'PT');
        $response->headers->set('X-Geo-Region', 'Portugal');

        return $response;
    }
}