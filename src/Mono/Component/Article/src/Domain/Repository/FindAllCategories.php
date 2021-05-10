<?php

declare(strict_types=1);

namespace Mono\Component\Article\Domain\Repository;

interface FindAllCategories
{
    public const ITEMS_PER_PAGE = 25;

    public function findAll(): array;
}
