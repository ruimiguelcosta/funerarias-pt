@props([
    'alt' => 'Logo',
    'class' => '',
    'size' => 'small'
])

@php
    $logoPath = public_path('images/logo.png');
    $pathInfo = pathinfo($logoPath);
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
            src="{{ asset('images/logo.png') }}" 
            alt="{{ $alt }}" 
            class="{{ $class }}"
            loading="eager"
            decoding="sync"
        >
    </picture>
@else
    <img 
        src="{{ asset('images/logo.png') }}" 
        alt="{{ $alt }}" 
        class="{{ $class }}"
        loading="eager"
        decoding="sync"
    >
@endif
