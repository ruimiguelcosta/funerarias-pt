<?php

namespace App\Domain\PostIdeas\Data;

use Spatie\LaravelData\Data;

class PostIdeaData extends Data
{
    public function __construct(
        public string $title,
        public ?string $description = null,
        public ?string $category = null,
        public bool $is_used = false,
        public ?string $used_at = null,
    ) {}
}
