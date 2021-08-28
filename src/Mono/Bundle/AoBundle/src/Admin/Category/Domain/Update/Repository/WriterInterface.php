<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Category\Domain\Update\Repository;

use Mono\Bundle\AoBundle\Admin\Category\Domain\Update\Model\CategoryInterface;

interface WriterInterface
{
    public function update(CategoryInterface $category): bool;
}
