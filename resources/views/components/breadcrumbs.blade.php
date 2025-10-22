@props(['items' => []])

@if(count($items) > 0)
<nav aria-label="Breadcrumb" class="bg-gray-50 py-3">
    <div class="container mx-auto px-4">
        <ol class="flex items-center space-x-2 text-sm">
            @foreach($items as $index => $item)
                <li class="flex items-center">
                    @if($index > 0)
                        <svg class="w-4 h-4 text-gray-400 mx-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    @endif

                    @if(isset($item['url']) && $index < count($items) - 1)
                        <a href="{{ $item['url'] }}"
                           class="text-purple-600 hover:text-purple-800 transition-colors duration-200"
                           aria-label="{{ $item['label'] }}">
                            {{ $item['label'] }}
                        </a>
                    @else
                        <span class="text-gray-600 font-medium" aria-current="page">
                            {{ $item['label'] }}
                        </span>
                    @endif
                </li>
            @endforeach
        </ol>
    </div>
</nav>

<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'BreadcrumbList',
    'itemListElement' => collect($items)->map(function($item, $index) {
        $breadcrumb = [
            '@type' => 'ListItem',
            'position' => $index + 1,
            'name' => $item['label']
        ];
        
        if (isset($item['url'])) {
            $breadcrumb['item'] = config('app.url') . $item['url'];
        }
        
        return $breadcrumb;
    })->toArray()
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
@endif
