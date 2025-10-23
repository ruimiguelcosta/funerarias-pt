<?php

namespace App\Services;

use App\Domain\FuneralHomes\Services\FuneralHomeService;

class PostFuneralHomesBlockService
{
    public function __construct(private FuneralHomeService $funeralHomeService) {}

    public function generateHtmlBlock(): string
    {
        $funeralHomes = $this->funeralHomeService->getRandomFuneralHomes(3);

        if ($funeralHomes->isEmpty()) {
            return '';
        }

        $html = '
<div style="margin-top: 60px; padding: 40px 0; border-top: 3px solid #7C3AED;">
    <h2 style="font-family: \'Playfair Display\', serif; font-size: 32px; font-weight: bold; color: #7C3AED; margin-bottom: 12px; text-align: center;">
        Funerárias Recomendadas
    </h2>
    <p style="text-align: center; color: #6B7280; font-size: 16px; margin-bottom: 40px;">
        Encontre os melhores serviços funerários perto de si
    </p>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 24px; max-width: 1200px; margin: 0 auto;">';

        foreach ($funeralHomes as $funeralHome) {
            $imageUrl = $this->getImageUrl($funeralHome);
            $description = $this->getCleanDescription($funeralHome->description ?? '');
            $url = $this->getFuneralHomeUrl($funeralHome);

            $html .= '
        <div style="background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.1); transition: transform 0.3s;">
            <a href="'.$url.'" style="text-decoration: none; color: inherit;">
                <div style="position: relative; height: 200px; overflow: hidden; background: linear-gradient(135deg, #E9D5FF 0%, #DDD6FE 100%);">
                    <img src="'.$imageUrl.'" alt="'.htmlspecialchars($funeralHome->title).'" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <div style="padding: 20px;">
                    <h3 style="font-family: \'Playfair Display\', serif; font-size: 20px; font-weight: 600; color: #1F2937; margin-bottom: 8px;">
                        '.htmlspecialchars($funeralHome->title).'
                    </h3>
                    <p style="color: #6B7280; font-size: 14px; line-height: 1.6; margin-bottom: 16px;">
                        '.$description.'
                    </p>
                    <div style="display: inline-flex; align-items: center; color: #7C3AED; font-weight: 600; font-size: 14px;">
                        <span>Ver detalhes</span>
                        <svg style="width: 16px; height: 16px; margin-left: 8px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </div>
            </a>
        </div>';
        }

        $html .= '
    </div>
</div>';

        return $html;
    }

    private function getImageUrl($funeralHome): string
    {
        $image = $funeralHome->images->where('category', 'main')->first()
            ?? $funeralHome->images->first();

        if ($image && $image->local_url) {
            return asset('storage/'.$image->local_path);
        }

        return 'https://images.unsplash.com/photo-1584907797015-7554cd315667?w=400&h=300&fit=crop';
    }

    private function getCleanDescription(string $description): string
    {
        $cleanText = strip_tags($description);
        $cleanText = html_entity_decode($cleanText, ENT_QUOTES | ENT_HTML5);
        $cleanText = trim(preg_replace('/\s+/', ' ', $cleanText));

        if (strlen($cleanText) > 200) {
            $cleanText = substr($cleanText, 0, 197).'...';
        }

        return htmlspecialchars($cleanText);
    }

    private function getFuneralHomeUrl($funeralHome): string
    {
        return route('funeral-home-detail', [
            'citySlug' => $funeralHome->city_slug,
            'funeralHomeSlug' => $funeralHome->slug,
        ]);
    }
}
