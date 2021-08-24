<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Page\Create\Repository;

use Mono\Bundle\AoBundle\Admin\Domain\Operation\Page\Create\Model\PageInterface;

interface WriterInterface
{
    public function create(PageInterface $page): bool;
}
