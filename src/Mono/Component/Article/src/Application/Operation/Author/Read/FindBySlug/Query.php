<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Operation\Author\Read\FindBySlug;

use Mono\Component\Article\Domain\Common\ValueObject\Slug;

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
