<?php

namespace App\Http\Middleware;

use App\Models\Tenant;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IdentifyTenant
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Skip tenant identification for admin, Livewire, and Horizon routes
        if ($request->is('admin/*') ||
            $request->is('livewire/*') ||
            $request->is('horizon/*') ||
            $request->is('_boost/*')) {
            return $next($request);
        }

        $host = $request->getSchemeAndHttpHost();

        $tenant = Tenant::query()
            ->where('domain', $host)
            ->where('is_enabled', true)
            ->first();

        if (! $tenant) {
            abort(404, 'Tenant not found for domain: '.$host);
        }

        app()->instance('tenant', $tenant);
        config(['app.current_tenant_id' => $tenant->id]);

        return $next($request);
    }
}
