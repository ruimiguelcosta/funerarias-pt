<?php

namespace App\Actions\Http\Pages;

use Illuminate\View\View;

class NotFoundPageAction
{
    public function __invoke(): View
    {
        return view('pages.404', [
            'seoPage' => '404',
        ]);
    }
}
