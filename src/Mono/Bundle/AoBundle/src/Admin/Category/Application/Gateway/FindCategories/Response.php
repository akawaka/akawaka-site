<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Category\Application\Gateway\FindCategories;

use Doctrine\Common\Collections\ArrayCollection;
use Mono\Bundle\AoBundle\Admin\Category\Domain\View\DataProvider\Model\CategoryInterface;
use Mono\Bundle\CoreBundle\Application\Gateway\GatewayResponse;

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
