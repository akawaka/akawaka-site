<?php

declare(strict_types=1);

namespace Mono\Component\Page\Domain\Repository;

use Mono\Component\Page\Domain\Entity\PageInterface;
use Mono\Component\Page\Domain\Identifier\PageId;

interface CreatePage
{
    public function insert(PageInterface $page): void;

    public function nextIdentity(): PageId;
}
