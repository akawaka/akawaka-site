<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Gateway\FindCategories;

use Doctrine\Common\Collections\ArrayCollection;
use Mono\Component\Article\Domain\Entity\ArticleInterface;
use Mono\Component\Article\Domain\Entity\CategoryInterface;
use Mono\Component\Core\Application\Gateway\GatewayResponse;

final class Response implements GatewayResponse
{
    public ArrayCollection $categories;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
    }

    public function add(CategoryInterface $category): void
    {
        $this->categories->add($category);
    }

    public function getCategories()
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
                'articles' => $category->getArticles()->map(function (ArticleInterface $article) {
                    return [
                        'identifier' => $article->getId()->getValue(),
                        'slug' => $article->getSlug()->getValue(),
                        'name' => $article->getName(),
                    ];
                })->toArray(),
            ];
        })->toArray();
    }
}
