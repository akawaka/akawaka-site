<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Shared\Domain\Repository;

interface FindAllUsers
{
    public const ITEMS_PER_PAGE = 25;

    public function findAll(): array;
}
