<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Category\Application\Operation\Read\FindBySlug;

use Mono\Bundle\AoBundle\Shared\Domain\ValueObject\Slug;

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
