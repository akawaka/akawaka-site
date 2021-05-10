<?php

declare(strict_types=1);

namespace Mono\Component\Channel\Domain\Repository;

interface FindAllChannels
{
    public const ITEMS_PER_PAGE = 25;

    public function findAll(): array;
}
