<?php

declare(strict_types=1);

namespace Mono\Component\Page\Domain\Repository;

use Mono\Component\Page\Domain\Entity\PageInterface;

interface RemovePage
{
    public function remove(PageInterface $page): void;
}
