<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Page\Update\Repository;

use Mono\Bundle\AoBundle\Admin\Domain\Operation\Page\Update\Model\PageInterface;

interface WriterInterface
{
    public function update(PageInterface $page): bool;
}
