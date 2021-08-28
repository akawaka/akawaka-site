<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Page\Domain\Update\Repository;

use Mono\Bundle\AoBundle\Admin\Page\Domain\Update\Model\PageInterface;

interface WriterInterface
{
    public function update(PageInterface $page): bool;
}
