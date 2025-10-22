<?php

namespace App\Actions\Http\Pages;

use Illuminate\View\View;

class PrivacyPolicyPageAction
{
    public function __invoke(): View
    {
        return view('pages.privacy-policy', [
            'seoPage' => 'privacy-policy',
        ]);
    }
}
