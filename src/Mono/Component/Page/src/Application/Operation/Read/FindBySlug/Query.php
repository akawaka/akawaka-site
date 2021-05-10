<?php

declare(strict_types=1);

namespace Mono\Component\Page\Application\Operation\Read\FindBySlug;

use Mono\Component\Page\Domain\ValueObject\PageSlug;

final class Query
{
    public function __construct(
        private string $slug
    ) {
    }

    public function getSlug(): PageSlug
    {
        return new PageSlug($this->slug);
    }
}
