<?php

declare(strict_types=1);

namespace Mono\Component\Article\Domain\Repository;

use Mono\Component\Article\Domain\Entity\CategoryInterface;
use Mono\Component\Article\Domain\ValueObject\Slug;

interface FindCategoryBySlug
{
    public function find(Slug $slug): CategoryInterface;
}
