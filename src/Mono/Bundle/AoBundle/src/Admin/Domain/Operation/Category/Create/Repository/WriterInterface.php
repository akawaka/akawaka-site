<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Category\Create\Repository;

use Mono\Bundle\AoBundle\Admin\Domain\Operation\Category\Create\Model\CategoryInterface;

interface WriterInterface
{
    public function create(CategoryInterface $category): bool;
}
