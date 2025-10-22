<?php

namespace App\Actions\Http\Pages;

use Illuminate\View\View;

class AboutPageAction
{
    public function __invoke(): View
    {
        return view('pages.about', [
            'seoPage' => 'about',
        ]);
    }
}
