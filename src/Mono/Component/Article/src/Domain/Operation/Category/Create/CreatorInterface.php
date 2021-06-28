<?php

declare(strict_types=1);

namespace Mono\Component\Article\Domain\Operation\Category\Create;

use Mono\Component\Article\Domain\Operation\Category\Create\Model\CategoryInterface;

interface CreatorInterface
{
    public function create(CategoryInterface $category): void;
}
