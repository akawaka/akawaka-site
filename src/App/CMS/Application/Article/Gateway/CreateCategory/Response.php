<?php

declare(strict_types=1);

namespace App\CMS\Application\Article\Gateway\CreateCategory;

use Mono\Component\Article\Domain\Entity\CategoryInterface;
use Mono\Component\Core\Application\Gateway\GatewayResponse;

final class Response implements GatewayResponse
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
            'slug' => $category->getSlug()->getValue(),
            'name' => $category->getName(),
        ];
    }
}
