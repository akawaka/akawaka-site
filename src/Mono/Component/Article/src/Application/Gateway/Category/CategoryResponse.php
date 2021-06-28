<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Gateway\Category;

use Mono\Component\Article\Domain\Operation\Category\View\Model\CategoryInterface;

trait CategoryResponse
{
    public function __construct(
        private CategoryInterface $category
    ) {
    }

    public function getCategory(): CategoryInterface
    {
        return $this->category;
    }

    public function data(): array
    {
        $category = $this->getCategory();

        return [
            'identifier' => $category->getId()->getValue(),
            'name' => $category->getName(),
            'slug' => $category->getSlug()->getValue(),
        ];
    }
}
