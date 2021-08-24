<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Application\Page\Operation\Read\FindBySlug;

use Mono\Bundle\AoBundle\Admin\Domain\Shared\ValueObject\Slug;

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
