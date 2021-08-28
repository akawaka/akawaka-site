<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Category\Application\Gateway;

use Mono\Bundle\AoBundle\Admin\Category\Domain\View\Model\CategoryInterface;

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
