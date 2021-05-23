<?php

declare(strict_types=1);

namespace App\CMS\Application\Article\Operation\Write\UpdateCategory;

use Mono\Component\Article\Domain\Identifier\CategoryId;
use Mono\Component\Article\Domain\ValueObject\Slug;

final class Command
{
    public function __construct(
        private string $identifier,
        private string $name,
        private string $slug
    ) {
    }

    public function getCategoryId(): CategoryId
    {
        return new CategoryId($this->identifier);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSlug(): Slug
    {
        return new Slug($this->slug);
    }
}
