<?php

declare(strict_types=1);

namespace Black\Bundle\PeanutBundle\Domain\Repository;

use Black\Component\Page\Enum\StatusEnum;

interface FindPagesByStatusRepository
{
    public function findPages(string $status = StatusEnum::PUBLISHED, int $page = 1): array;
}
