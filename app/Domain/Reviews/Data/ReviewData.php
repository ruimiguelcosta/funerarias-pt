<?php

namespace App\Domain\Reviews\Data;

use Spatie\LaravelData\Data;

class ReviewData extends Data
{
    public function __construct(
        public int $entity_id,
        public int $rating,
        public string $author_name,
        public string $comment
    ) {}
}
