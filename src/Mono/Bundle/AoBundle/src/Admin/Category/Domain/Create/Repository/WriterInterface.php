<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Category\Domain\Create\Repository;

use Mono\Bundle\AoBundle\Admin\Category\Domain\Create\Model\CategoryInterface;

interface WriterInterface
{
    public function create(CategoryInterface $category): bool;
}
