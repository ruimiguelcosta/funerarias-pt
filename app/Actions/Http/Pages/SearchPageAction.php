<?php

namespace App\Actions\Http\Pages;

use Illuminate\Contracts\View\View;

class SearchPageAction
{
    public function __invoke(): View
    {
        return view('pages.search');
    }
}


