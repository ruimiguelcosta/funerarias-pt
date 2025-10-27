<?php

namespace App\Services;

use App\Models\Entity;
use Illuminate\Support\Str;

class SeoService
{
    public function generateMetaTags(string $page, array $data = []): array
    {
        $baseUrl = config('app.url');
        $siteName = 'Funerárias Portugal';

        return match ($page) {
            'home' => $this->getHomeMetaTags($baseUrl, $siteName),
            'funeral-homes' => $this->getEntitysMetaTags($baseUrl, $siteName),
            'funeral-home-detail' => $this->getEntityDetailMetaTags($data['entity'], $baseUrl, $siteName),
            'about' => $this->getAboutMetaTags($baseUrl, $siteName),
            'blog-post' => $this->getBlogPostMetaTags($data, $baseUrl, $siteName),
            'privacy-policy' => $this->getPrivacyPolicyMetaTags($baseUrl, $siteName),
            'cookie-policy' => $this->getCookiePolicyMetaTags($baseUrl, $siteName),
            '404' => $this->get404MetaTags($baseUrl, $siteName),
            default => $this->getDefaultMetaTags($baseUrl, $siteName)
        };
    }

    private function getHomeMetaTags(string $baseUrl, string $siteName): array
    {
        return [
            'title' => 'Serviços Funerários em Portugal - Dignidade e Respeito | Funerárias Portugal',
            'description' => 'Encontre as melhores funerárias em Portugal. Serviços funerários com dignidade, respeito e profissionalismo. Apoio compassivo em momentos difíceis.',
            'keywords' => 'funerárias portugal, serviços funerários, funeral, cremação, enterro, velório, cemitério, luto, dignidade',
            'canonical' => $baseUrl,
            'og_title' => 'Serviços Funerários em Portugal - Dignidade e Respeito',
            'og_description' => 'Conectamos famílias com serviços funerários de qualidade e confiança em Portugal. Profissionalismo e compaixão em momentos difíceis.',
            'og_image' => $baseUrl.'/images/home-large.webp',
            'og_image:width' => '1200',
            'og_image:height' => '800',
            'og_type' => 'website',
            'twitter_card' => 'summary_large_image',
            'twitter_title' => 'Serviços Funerários em Portugal - Dignidade e Respeito',
            'twitter_description' => 'Encontre as melhores funerárias em Portugal com serviços de qualidade e apoio compassivo.',
            'twitter_image' => $baseUrl.'/images/home-large.webp',
        ];
    }

    private function getEntitysMetaTags(string $baseUrl, string $siteName): array
    {
        return [
            'title' => 'Todas as Funerárias em Portugal - Lista Completa | Funerárias Portugal',
            'description' => 'Lista completa de funerárias em Portugal. Encontre serviços funerários por localização, avaliações e preços. Compare e escolha a melhor opção.',
            'keywords' => 'funerárias portugal, lista funerárias, serviços funerários por cidade, avaliações funerárias, preços funerárias',
            'canonical' => $baseUrl.'/funerarias',
            'og_title' => 'Todas as Funerárias em Portugal - Lista Completa',
            'og_description' => 'Explore nossa lista completa de funerárias em Portugal. Compare serviços, avaliações e encontre a melhor opção para sua família.',
            'og_image' => $baseUrl.'/images/cruzes-large.webp',
            'og_image:width' => '1200',
            'og_image:height' => '800',
            'og_type' => 'website',
        ];
    }

    private function getEntityDetailMetaTags(Entity $entity, string $baseUrl, string $siteName): array
    {
        $title = $entity->title.' - '.$entity->city.' | Funerárias Portugal';
        $description = $entity->description ?
            Str::limit($entity->description, 155) :
            'Serviços funerários profissionais em '.$entity->city.'. Dignidade e respeito em momentos difíceis.';

        return [
            'title' => $title,
            'description' => $description,
            'keywords' => 'funerária '.$entity->city.', '.$entity->title.', serviços funerários '.$entity->city.', funeral '.$entity->city,
            'canonical' => $baseUrl.'/funeraria/'.$entity->slug,
            'og_title' => $title,
            'og_description' => $description,
            'og_image' => $entity->images->where('category', 'main')->first()?->local_url ?? $baseUrl.'/images/default-funeral-home.jpg',
            'og_type' => 'business.business',
            'og_latitude' => $entity->latitude,
            'og_longitude' => $entity->longitude,
            'og_street_address' => $entity->address,
            'og_locality' => $entity->city,
            'og_postal_code' => $entity->postal_code,
            'og_country_name' => 'Portugal',
            'og_phone_number' => $entity->phone,
        ];
    }

    private function getAboutMetaTags(string $baseUrl, string $siteName): array
    {
        return [
            'title' => 'Quem Somos - Plataforma de Serviços Funerários | Funerárias Portugal',
            'description' => 'Conheça nossa missão de conectar famílias com serviços funerários de qualidade em Portugal. Dignidade, respeito e apoio em momentos difíceis.',
            'keywords' => 'quem somos, missão funerárias, plataforma serviços funerários, história empresa funerária',
            'canonical' => $baseUrl.'/quem-somos',
            'og_title' => 'Quem Somos - Plataforma de Serviços Funerários',
            'og_description' => 'Descubra nossa missão de proporcionar dignidade e respeito às famílias através de serviços funerários de qualidade.',
            'og_image' => $baseUrl.'/images/cemiterio-large.webp',
            'og_image:width' => '1200',
            'og_image:height' => '800',
            'og_type' => 'website',
        ];
    }

    private function getBlogPostMetaTags(array $data, string $baseUrl, string $siteName): array
    {
        $title = $data['title'].' | Blog Funerárias Portugal';
        $description = $data['excerpt'] ?? 'Artigo sobre serviços funerários e orientações para famílias em momentos difíceis.';

        return [
            'title' => $title,
            'description' => $description,
            'keywords' => 'blog funerárias, orientações funeral, luto, apoio familiar, tradições funerárias',
            'canonical' => $baseUrl.'/post/'.$data['id'],
            'og_title' => $title,
            'og_description' => $description,
            'og_image' => $data['image'] ?? $baseUrl.'/images/default-blog.jpg',
            'og_type' => 'article',
            'article_author' => $data['author'] ?? 'Equipa Funerárias Portugal',
            'article_published_time' => $data['published_time'] ?? now()->toISOString(),
        ];
    }

    private function getPrivacyPolicyMetaTags(string $baseUrl, string $siteName): array
    {
        return [
            'title' => 'Política de Privacidade | Funerárias Portugal',
            'description' => 'Política de privacidade da plataforma Funerárias Portugal. Saiba como protegemos e tratamos os seus dados pessoais.',
            'canonical' => $baseUrl.'/politica-privacidade',
            'og_title' => 'Política de Privacidade | Funerárias Portugal',
            'og_description' => 'Conheça como protegemos e tratamos os seus dados pessoais na nossa plataforma.',
            'og_type' => 'website',
        ];
    }

    private function getCookiePolicyMetaTags(string $baseUrl, string $siteName): array
    {
        return [
            'title' => 'Política de Cookies | Funerárias Portugal',
            'description' => 'Política de cookies da plataforma Funerárias Portugal. Informações sobre o uso de cookies no nosso website.',
            'canonical' => $baseUrl.'/politica-cookies',
            'og_title' => 'Política de Cookies | Funerárias Portugal',
            'og_description' => 'Saiba como utilizamos cookies para melhorar a sua experiência no nosso website.',
            'og_type' => 'website',
        ];
    }

    private function get404MetaTags(string $baseUrl, string $siteName): array
    {
        return [
            'title' => 'Página Não Encontrada | Funerárias Portugal',
            'description' => 'A página que procura não foi encontrada. Explore os nossos serviços funerários ou volte à página inicial.',
            'canonical' => $baseUrl.'/404',
            'og_title' => 'Página Não Encontrada | Funerárias Portugal',
            'og_description' => 'A página que procura não foi encontrada. Explore os nossos serviços funerários.',
            'og_type' => 'website',
        ];
    }

    private function getDefaultMetaTags(string $baseUrl, string $siteName): array
    {
        return [
            'title' => 'Serviços Funerários em Portugal | Funerárias Portugal',
            'description' => 'Serviços funerários profissionais em Portugal. Dignidade, respeito e apoio compassivo em momentos difíceis.',
            'canonical' => $baseUrl,
            'og_title' => 'Serviços Funerários em Portugal',
            'og_description' => 'Encontre serviços funerários de qualidade em Portugal.',
            'og_type' => 'website',
        ];
    }

    public function generateJsonLd(string $page, array $data = []): array
    {
        return match ($page) {
            'home' => $this->getHomeJsonLd(),
            'funeral-home-detail' => $this->getEntityDetailJsonLd($data['entity']),
            'about' => $this->getAboutJsonLd(),
            'blog-post' => $this->getBlogPostJsonLd($data),
            default => []
        };
    }

    private function getHomeJsonLd(): array
    {
        $baseUrl = config('app.url');

        return [
            [
                '@context' => 'https://schema.org',
                '@type' => 'Organization',
                'name' => 'Funerárias Portugal',
                'url' => $baseUrl,
                'logo' => $baseUrl.'/images/logo.png',
                'description' => 'Plataforma dedicada a conectar famílias com serviços funerários de qualidade e confiança em Portugal.',
                'address' => [
                    '@type' => 'PostalAddress',
                    'addressCountry' => 'PT',
                    'addressLocality' => 'Portugal',
                ],
                'contactPoint' => [
                    '@type' => 'ContactPoint',
                    'telephone' => '+351-XXX-XXX-XXX',
                    'contactType' => 'customer service',
                    'availableLanguage' => 'Portuguese',
                ],
                'sameAs' => [
                    'https://www.facebook.com/funerariasportugal',
                    'https://www.instagram.com/funerariasportugal',
                ],
            ],
            [
                '@context' => 'https://schema.org',
                '@type' => 'WebSite',
                'name' => 'Funerárias Portugal',
                'url' => $baseUrl,
                'description' => 'Encontre os melhores serviços funerários em Portugal com dignidade e respeito.',
                'potentialAction' => [
                    '@type' => 'SearchAction',
                    'target' => $baseUrl.'/funerarias?search={search_term_string}',
                    'query-input' => 'required name=search_term_string',
                ],
            ],
            [
                '@context' => 'https://schema.org',
                '@type' => 'Service',
                'name' => 'Serviços Funerários',
                'description' => 'Serviços funerários profissionais com dignidade, respeito e apoio compassivo.',
                'provider' => [
                    '@type' => 'Organization',
                    'name' => 'Funerárias Portugal',
                ],
                'serviceType' => 'Funeral Services',
                'areaServed' => [
                    '@type' => 'Country',
                    'name' => 'Portugal',
                ],
            ],
        ];
    }

    private function getEntityDetailJsonLd(Entity $entity): array
    {
        $baseUrl = config('app.url');

        $jsonLd = [
            '@context' => 'https://schema.org',
            '@type' => 'Entity',
            'name' => $entity->title,
            'description' => $entity->description,
            'url' => $baseUrl.'/funeraria/'.$entity->slug,
            'telephone' => $entity->phone,
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => $entity->address,
                'addressLocality' => $entity->city,
                'postalCode' => $entity->postal_code,
                'addressCountry' => 'PT',
            ],
            'geo' => [
                '@type' => 'GeoCoordinates',
                'latitude' => $entity->latitude,
                'longitude' => $entity->longitude,
            ],
            'openingHoursSpecification' => $this->getOpeningHoursJsonLd($entity),
            'aggregateRating' => $entity->total_score ? [
                '@type' => 'AggregateRating',
                'ratingValue' => $entity->total_score,
                'reviewCount' => $entity->reviews_count ?? 0,
                'bestRating' => 5,
                'worstRating' => 1,
            ] : null,
            'image' => $entity->images->where('category', 'main')->first()?->local_url ??
                      $entity->images->first()?->local_url,
            'priceRange' => $entity->price ? '€€' : null,
            'paymentAccepted' => ['Cash', 'Credit Card', 'Bank Transfer'],
            'currenciesAccepted' => 'EUR',
        ];

        if ($entity->website) {
            $jsonLd['sameAs'] = [$entity->website];
        }

        return array_filter([$jsonLd]);
    }

    private function getOpeningHoursJsonLd(Entity $entity): array
    {
        $openingHours = [];

        foreach ($entity->openingHours as $hour) {
            $openingHours[] = [
                '@type' => 'OpeningHoursSpecification',
                'dayOfWeek' => $hour->day_of_week,
                'opens' => $hour->opens,
                'closes' => $hour->closes,
            ];
        }

        return $openingHours;
    }

    private function getAboutJsonLd(): array
    {
        $baseUrl = config('app.url');

        return [
            [
                '@context' => 'https://schema.org',
                '@type' => 'AboutPage',
                'name' => 'Quem Somos - Funerárias Portugal',
                'description' => 'Conheça nossa missão de conectar famílias com serviços funerários de qualidade em Portugal.',
                'url' => $baseUrl.'/quem-somos',
                'mainEntity' => [
                    '@type' => 'Organization',
                    'name' => 'Funerárias Portugal',
                    'description' => 'Plataforma dedicada a conectar famílias com serviços funerários de qualidade e confiança.',
                    'foundingDate' => '2020',
                    'address' => [
                        '@type' => 'PostalAddress',
                        'addressCountry' => 'PT',
                    ],
                ],
            ],
        ];
    }

    private function getBlogPostJsonLd(array $data): array
    {
        $baseUrl = config('app.url');

        return [
            [
                '@context' => 'https://schema.org',
                '@type' => 'BlogPosting',
                'headline' => $data['title'],
                'description' => $data['excerpt'] ?? '',
                'url' => $baseUrl.'/post/'.$data['id'],
                'datePublished' => $data['published_time'] ?? now()->toISOString(),
                'dateModified' => $data['modified_time'] ?? now()->toISOString(),
                'author' => [
                    '@type' => 'Person',
                    'name' => $data['author'] ?? 'Equipa Funerárias Portugal',
                ],
                'publisher' => [
                    '@type' => 'Organization',
                    'name' => 'Funerárias Portugal',
                    'logo' => [
                        '@type' => 'ImageObject',
                        'url' => $baseUrl.'/images/logo.png',
                    ],
                ],
                'image' => $data['image'] ?? $baseUrl.'/images/default-blog.jpg',
                'mainEntityOfPage' => [
                    '@type' => 'WebPage',
                    '@id' => $baseUrl.'/post/'.$data['id'],
                ],
            ],
        ];
    }
}
