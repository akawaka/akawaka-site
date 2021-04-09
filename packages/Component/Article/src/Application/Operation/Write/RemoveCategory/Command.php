<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Operation\Write\RemoveCategory;

use Mono\Component\Article\Domain\Entity\CategoryInterface;

final class Command
{
    public function __construct(
        private CategoryInterface $category,
    ) {
    }

    public function getCategory(): CategoryInterface
    {
        return $this->category;
    }
}
