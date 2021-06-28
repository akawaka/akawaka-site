<?php

declare(strict_types=1);

namespace Mono\Component\Article\Domain\Operation\Category\Update;

use Mono\Component\Article\Domain\Operation\Category\Update\Model\CategoryInterface;

interface UpdaterInterface
{
    public function update(CategoryInterface $category): void;
}