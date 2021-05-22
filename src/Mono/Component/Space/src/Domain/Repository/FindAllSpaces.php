<?php

declare(strict_types=1);

namespace Mono\Component\Space\Domain\Repository;

interface FindAllSpaces
{
    public const ITEMS_PER_PAGE = 25;

    public function findAll(): array;
}
