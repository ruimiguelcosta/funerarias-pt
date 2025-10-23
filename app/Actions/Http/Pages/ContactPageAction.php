<?php

namespace App\Actions\Http\Pages;

use Illuminate\View\View;

class ContactPageAction
{
    public function __invoke(): View
    {
        return view('pages.contact', [
            'seoPage' => 'contact',
        ]);
    }
}
