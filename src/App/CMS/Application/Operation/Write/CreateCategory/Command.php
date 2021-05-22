<?php

declare(strict_types=1);

namespace App\CMS\Application\Operation\Write\CreateCategory;

use Mono\Component\Article\Domain\ValueObject\Slug;

final class Command
{
    public function __construct(
        private string $name,
        private string $slug,
    ) {
    }

    public function getSlug(): Slug
    {
        return new Slug($this->slug);
    }

    public function getName(): string
    {
        return $this->name;
    }
}
