@props(['page', 'data' => []])

@php
    $seoService = app(\App\Services\SeoService::class);
    $metaTags = $seoService->generateMetaTags($page, $data);
    $jsonLd = $seoService->generateJsonLd($page, $data);
@endphp

<!-- SEO Meta Tags -->
<title>{{ $metaTags['title'] }}</title>
<meta name="description" content="{{ $metaTags['description'] }}">
@if(isset($metaTags['keywords']))
<meta name="keywords" content="{{ $metaTags['keywords'] }}">
@endif
<link rel="canonical" href="{{ $metaTags['canonical'] }}">

<!-- Open Graph Meta Tags -->
<meta property="og:title" content="{{ $metaTags['og_title'] }}">
<meta property="og:description" content="{{ $metaTags['og_description'] }}">
<meta property="og:type" content="{{ $metaTags['og_type'] }}">
<meta property="og:url" content="{{ $metaTags['canonical'] }}">
@if(isset($metaTags['og_image']))
<meta property="og:image" content="{{ $metaTags['og_image'] }}">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
@endif
<meta property="og:site_name" content="Funerárias Portugal">
<meta property="og:locale" content="pt_PT">

<!-- Additional Open Graph Tags for Business -->
@if(isset($metaTags['og_latitude']))
<meta property="place:location:latitude" content="{{ $metaTags['og_latitude'] }}">
<meta property="place:location:longitude" content="{{ $metaTags['og_longitude'] }}">
@endif
@if(isset($metaTags['og_street_address']))
<meta property="business:contact_data:street_address" content="{{ $metaTags['og_street_address'] }}">
@endif
@if(isset($metaTags['og_locality']))
<meta property="business:contact_data:locality" content="{{ $metaTags['og_locality'] }}">
@endif
@if(isset($metaTags['og_postal_code']))
<meta property="business:contact_data:postal_code" content="{{ $metaTags['og_postal_code'] }}">
@endif
@if(isset($metaTags['og_country_name']))
<meta property="business:contact_data:country_name" content="{{ $metaTags['og_country_name'] }}">
@endif
@if(isset($metaTags['og_phone_number']))
<meta property="business:contact_data:phone_number" content="{{ $metaTags['og_phone_number'] }}">
@endif

<!-- Twitter Card Meta Tags -->
<meta name="twitter:card" content="{{ $metaTags['twitter_card'] ?? 'summary_large_image' }}">
<meta name="twitter:title" content="{{ $metaTags['twitter_title'] ?? $metaTags['og_title'] }}">
<meta name="twitter:description" content="{{ $metaTags['twitter_description'] ?? $metaTags['og_description'] }}">
@if(isset($metaTags['twitter_image']))
<meta name="twitter:image" content="{{ $metaTags['twitter_image'] }}">
@elseif(isset($metaTags['og_image']))
<meta name="twitter:image" content="{{ $metaTags['og_image'] }}">
@endif
<meta name="twitter:site" content="@funerariasportugal">
<meta name="twitter:creator" content="@funerariasportugal">

<!-- Additional Meta Tags for Articles -->
@if(isset($metaTags['article_author']))
<meta property="article:author" content="{{ $metaTags['article_author'] }}">
@endif
@if(isset($metaTags['article_published_time']))
<meta property="article:published_time" content="{{ $metaTags['article_published_time'] }}">
@endif
@if(isset($metaTags['article_modified_time']))
<meta property="article:modified_time" content="{{ $metaTags['article_modified_time'] }}">
@endif

<!-- Additional SEO Meta Tags -->
<meta name="robots" content="index, follow">
<meta name="googlebot" content="index, follow">
<meta name="language" content="pt">
<meta name="geo.region" content="PT">
<meta name="geo.country" content="Portugal">
<meta name="distribution" content="global">
<meta name="rating" content="general">
<meta name="revisit-after" content="7 days">

<!-- JSON-LD Structured Data -->
@foreach($jsonLd as $schema)
<script type="application/ld+json">
{!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
@endforeach
