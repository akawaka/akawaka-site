<?php

declare(strict_types=1);

namespace Mono\Component\Page\Domain\Repository;

use Mono\Component\Page\Domain\Entity\PageInterface;
use Mono\Component\Page\Domain\Identifier\PageId;

interface FindPageById
{
    public function find(PageId $id): ?PageInterface;
}
