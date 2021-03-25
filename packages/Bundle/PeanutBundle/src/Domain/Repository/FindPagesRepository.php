<?php

declare(strict_types=1);

namespace Black\Bundle\PeanutBundle\Domain\Repository;

interface FindPagesRepository
{
    public function findPages(int $page = 1): array;
}
