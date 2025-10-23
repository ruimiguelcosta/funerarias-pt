@props([
    'image' => null,
    'alt' => '',
    'class' => '',
    'size' => 'medium',
    'lazy' => true,
    'fallback' => 'https://images.unsplash.com/photo-1584907797015-7554cd315667?w=400&h=300&fit=crop'
])

@php
    // Dimensões baseadas no tamanho
    $dimensions = match($size) {
        'small' => ['width' => 300, 'height' => 200],
        'medium' => ['width' => 600, 'height' => 400],
        'large' => ['width' => 1200, 'height' => 800],
        default => ['width' => 600, 'height' => 400]
    };
@endphp

@if($image && $image instanceof \App\Models\Image)
    @if($image->local_path)
        <picture>
            @if(file_exists(storage_path('app/public/' . str_replace('.jpg', '-large.avif', $image->local_path))))
                <source srcset="{{ $image->large_url }}" type="image/avif">
            @endif
            @if(file_exists(storage_path('app/public/' . str_replace('.jpg', '-large.webp', $image->local_path))))
                <source srcset="{{ $image->large_url }}" type="image/webp">
            @endif
            <img 
                src="{{ $image->local_url }}" 
                alt="{{ $alt }}" 
                width="{{ $dimensions['width'] }}"
            height="{{ $dimensions['height'] }}"
                width="{{ $dimensions['width'] }}"
                height="{{ $dimensions['height'] }}"
                @if($lazy) loading="lazy" decoding="async" @endif
            >
        </picture>
    @else
        <img 
            src="{{ $fallback }}" 
            alt="{{ $alt }}" 
            width="{{ $dimensions['width'] }}"
            height="{{ $dimensions['height'] }}" 
            @if($lazy) loading="lazy" decoding="async" @endif
        >
    @endif
@elseif($image && is_string($image))
    @php
        $imageModel = \App\Models\Image::findByUrl($image);
    @endphp
    @if($imageModel)
        <picture>
            @if(file_exists(storage_path('app/public/' . str_replace('.jpg', '-large.avif', $imageModel->local_path))))
                <source srcset="{{ $imageModel->large_url }}" type="image/avif">
            @endif
            @if(file_exists(storage_path('app/public/' . str_replace('.jpg', '-large.webp', $imageModel->local_path))))
                <source srcset="{{ $imageModel->large_url }}" type="image/webp">
            @endif
            <img 
                src="{{ $imageModel->local_url }}" 
                alt="{{ $alt }}" 
                width="{{ $dimensions['width'] }}"
            height="{{ $dimensions['height'] }}" 
                @if($lazy) loading="lazy" decoding="async" @endif
            >
        </picture>
    @else
        <img 
            src="{{ $image }}" 
            alt="{{ $alt }}" 
            width="{{ $dimensions['width'] }}"
            height="{{ $dimensions['height'] }}" 
            @if($lazy) loading="lazy" decoding="async" @endif
        >
    @endif
@else
    <img 
        src="{{ $fallback }}" 
        alt="{{ $alt }}" 
        class="{{ $class }}" 
        @if($lazy) loading="lazy" decoding="async" @endif
    >
@endif
