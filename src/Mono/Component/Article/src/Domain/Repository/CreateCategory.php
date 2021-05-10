<?php

declare(strict_types=1);

namespace Mono\Component\Article\Domain\Repository;

use Mono\Component\Article\Domain\Entity\CategoryInterface;
use Mono\Component\Article\Domain\Identifier\CategoryId;

interface CreateCategory
{
    public function insert(CategoryInterface $Category): void;

    public function nextIdentity(): CategoryId;
}
