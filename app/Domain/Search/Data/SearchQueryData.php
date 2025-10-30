<?php

namespace App\Domain\Search\Data;

use Spatie\LaravelData\Data;

class SearchQueryData extends Data
{
    public function __construct(
        public string $q,
    ) {}
}


