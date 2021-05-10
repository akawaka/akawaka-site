<?php

declare(strict_types=1);

namespace Mono\Component\AdminSecurity\Domain\Repository;

interface FindAllUsers
{
    public const ITEMS_PER_PAGE = 25;

    public function findAll(): array;
}
