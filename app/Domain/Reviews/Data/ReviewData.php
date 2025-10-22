<?php

namespace App\Domain\Reviews\Data;

use Spatie\LaravelData\Data;

class ReviewData extends Data
{
    public function __construct(
        public int $funeral_home_id,
        public int $rating,
        public string $author_name,
        public string $comment
    ) {}
}
