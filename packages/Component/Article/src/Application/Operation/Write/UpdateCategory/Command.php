<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Operation\Write\UpdateCategory;

use Mono\Component\Article\Domain\Entity\CategoryInterface;
use Mono\Component\Article\Domain\ValueObject\Slug;

final class Command
{
    public function __construct(
        private CategoryInterface $category,
        private string $name,
        private string $slug
    ) {
    }

    public function getCategory(): CategoryInterface
    {
        return $this->category;
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
