<?php

declare(strict_types=1);

namespace Mono\Component\Article\Domain\Operation\Category\Create\Repository;

use Mono\Component\Article\Domain\Operation\Category\Create\Model\CategoryInterface;

interface WriterInterface
{
    public function create(CategoryInterface $category): bool;
}
