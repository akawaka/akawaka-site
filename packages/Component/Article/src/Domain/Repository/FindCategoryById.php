<?php

declare(strict_types=1);

namespace Mono\Component\Article\Domain\Repository;

use Mono\Component\Article\Domain\Entity\CategoryInterface;
use Mono\Component\Article\Domain\Identifier\CategoryId;

interface FindCategoryById
{
    public function find(CategoryId $id): CategoryInterface;
}
