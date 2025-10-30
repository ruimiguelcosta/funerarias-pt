@php
    $tenant = app()->bound('tenant') ? app('tenant') : null;
    $name = $tenant?->settings['bing_verify_name'] ?? null;
    $value = $tenant?->settings['bing_verify_value'] ?? null;
    if (!$tenant || empty($name) || empty($value)) {
        return;
    }
@endphp
<meta name="{{ $name }}" content="{{ $value }}" />


