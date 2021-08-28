<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Page\Domain\Create\Repository;

use Mono\Bundle\AoBundle\Admin\Page\Domain\Create\Model\PageInterface;

interface WriterInterface
{
    public function create(PageInterface $page): bool;
}
