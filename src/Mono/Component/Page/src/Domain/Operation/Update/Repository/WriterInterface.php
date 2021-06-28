<?php

declare(strict_types=1);

namespace Mono\Component\Page\Domain\Operation\Update\Repository;

use Mono\Component\Page\Domain\Operation\Update\Model\PageInterface;

interface WriterInterface
{
    public function update(PageInterface $page): bool;
}
