<?php

declare(strict_types=1);

namespace App\CMS\Application\Article\Operation\Read\FindArticleBySlug;

use Mono\Component\Article\Domain\ValueObject\Slug;

final class Query
{
    public function __construct(
        private string $slug
    ) {
    }

    public function getSlug(): Slug
    {
        return new Slug($this->slug);
    }
}
