@props([
    'src' => '',
    'alt' => '',
    'class' => '',
    'size' => 'large',
    'priority' => false
])

@php
    // Converter asset() para caminho real
    $realPath = str_replace(asset(''), public_path(), $src);
    $pathInfo = pathinfo($realPath);
    $directory = $pathInfo['dirname'];
    $filename = $pathInfo['filename'];
    
    $avifPath = "{$directory}/{$filename}-{$size}.avif";
    $webpPath = "{$directory}/{$filename}-{$size}.webp";
    
    $hasAvif = file_exists($avifPath);
    $hasWebp = file_exists($webpPath);
@endphp

@if($hasAvif || $hasWebp)
    <picture>
        @if($hasAvif)
            <source srcset="{{ asset('images/' . basename($avifPath)) }}" type="image/avif">
        @endif
        
        @if($hasWebp)
            <source srcset="{{ asset('images/' . basename($webpPath)) }}" type="image/webp">
        @endif
        
        <img 
            src="{{ $src }}" 
            alt="{{ $alt }}" 
            class="{{ $class }}"
            @if($priority) fetchpriority="high" @endif
            loading="{{ $priority ? 'eager' : 'lazy' }}"
            decoding="async"
        >
    </picture>
@else
    <img 
        src="{{ $src }}" 
        alt="{{ $alt }}" 
        class="{{ $class }}"
        @if($priority) fetchpriority="high" @endif
        loading="{{ $priority ? 'eager' : 'lazy' }}"
        decoding="async"
    >
@endif
