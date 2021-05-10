<?php

declare(strict_types=1);

namespace Mono\Component\Article\Domain\Repository;

use Mono\Component\Article\Domain\Entity\CategoryInterface;

interface UpdateCategory
{
    public function update(CategoryInterface $category): void;
}
