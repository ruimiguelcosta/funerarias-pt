<?php

namespace App\Actions\Http\Pages;

use Illuminate\View\View;

class CookiePolicyPageAction
{
    public function __invoke(): View
    {
        return view('pages.cookie-policy', [
            'seoPage' => 'cookie-policy',
        ]);
    }
}
