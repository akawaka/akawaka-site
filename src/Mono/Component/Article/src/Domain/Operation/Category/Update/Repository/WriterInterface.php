<?php

declare(strict_types=1);

namespace Mono\Component\Article\Domain\Operation\Category\Update\Repository;

use Mono\Component\Article\Domain\Operation\Category\Update\Model\CategoryInterface;

interface WriterInterface
{
    public function update(CategoryInterface $category): bool;
}
