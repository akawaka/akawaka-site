<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Gateway\FindCategoryBySlug;

use Mono\Component\Article\Domain\Entity\ArticleInterface;
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
            'name' => $category->getName(),
            'slug' => $category->getSlug()->getValue(),
            'articles' => $category->getArticles()->map(function (ArticleInterface $article) {
                return [
                    'identifier' => $article->getId()->getValue(),
                    'slug' => $article->getSlug()->getValue(),
                    'name' => $article->getName(),
                ];
            })->toArray(),
        ];
    }
}
