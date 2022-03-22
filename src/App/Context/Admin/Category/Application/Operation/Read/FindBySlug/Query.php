<?php

declare(strict_types=1);

namespace App\Context\Admin\Category\Application\Operation\Read\FindBySlug;

use App\Shared\Domain\ValueObject\Slug;

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
