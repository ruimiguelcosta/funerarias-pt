<?php

namespace App\Support\Helpers;

use App\Models\Tenant;

class TenantHelper
{
    /**
     * Get the current tenant.
     */
    public static function current(): ?Tenant
    {
        return app('tenant');
    }

    /**
     * Get the current tenant ID.
     */
    public static function id(): ?int
    {
        return config('app.current_tenant_id');
    }

    /**
     * Check if a tenant is currently set.
     */
    public static function check(): bool
    {
        return self::id() !== null;
    }
}
