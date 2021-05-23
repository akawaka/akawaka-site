<?php

declare(strict_types=1);

namespace App\CMS\Application\Page\Operation\Read\FindBySlug;

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
