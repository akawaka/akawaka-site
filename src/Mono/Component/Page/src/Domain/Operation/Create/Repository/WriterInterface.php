<?php

declare(strict_types=1);

namespace Mono\Component\Page\Domain\Operation\Create\Repository;

use Mono\Component\Page\Domain\Operation\Create\Model\PageInterface;

interface WriterInterface
{
    public function create(PageInterface $page): bool;
}
