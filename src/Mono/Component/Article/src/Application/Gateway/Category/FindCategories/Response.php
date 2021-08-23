<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Gateway\Category\FindCategories;

use Doctrine\Common\Collections\ArrayCollection;
use Mono\Component\Core\Application\Gateway\GatewayResponse;
use Mono\Component\Article\Domain\Operation\Category\View\Model\CategoryInterface;

final class Response implements GatewayResponse
{
    private ArrayCollection $categories;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
    }

    public function add(CategoryInterface $category): void
    {
        $this->categories->add($category);
    }

    public function getCategories(): ArrayCollection
    {
        return $this->categories;
    }

    public function data(): array
    {
        return $this->getCategories()->map(function (CategoryInterface $category) {
            return [
                'identifier' => $category->getId()->getValue(),
                'name' => $category->getName(),
                'slug' => $category->getSlug()->getValue(),
            ];
        })->toArray();
    }
}
