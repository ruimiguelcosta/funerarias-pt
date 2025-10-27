<?php

namespace App\Actions\Http\Pages;

use Illuminate\View\View;

class TermsPageAction
{
    public function __invoke(): View
    {
        return view('pages.terms', [
            'seoPage' => 'terms',
        ]);
    }
}

