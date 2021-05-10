<?php

declare(strict_types=1);

namespace Mono\Component\Page\Domain\Repository;

interface FindAllPages
{
    public const ITEMS_PER_PAGE = 25;

    public function findAll(): array;
}
