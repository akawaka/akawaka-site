<?php

declare(strict_types=1);

namespace Mono\Component\Page\Domain\Repository;

use Mono\Component\Page\Domain\Entity\PageInterface;

interface UpdatePage
{
    public function update(PageInterface $PageInterface): void;
}
