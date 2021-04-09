<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Gateway\FindArticleById;

use Mono\Component\Article\Domain\Entity\ArticleInterface;
use Mono\Component\Article\Domain\Entity\Category;
use Mono\Component\Core\Application\Gateway\GatewayResponse;
use Doctrine\Common\Collections\Collection;

final class Response implements GatewayResponse
{
    public function __construct(
        private ArticleInterface $article
    ) {
    }

    public function getArticle(): ArticleInterface
    {
        return $this->article;
    }

    public function getName(): string
    {
        return $this->article->getName();
    }

    public function getSlug(): string
    {
        return $this->article->getSlug()->getValue();
    }

    public function getContent(): ?string
    {
        return $this->article->getContent();
    }

    public function getCategories(): Collection
    {
        return $this->article->getCategories();
    }

    public function data(): array
    {
        $article = $this->getArticle();

        return [
            'identifier' => $article->getId()->getValue(),
            'name' => $article->getName(),
            'slug' => $article->getSlug()->getValue(),
            'content' => $article->getContent(),
            'status' => $article->getStatus(),
            'categories' => $article->getCategories()->map(function (Category $category) {
                return [
                    'identifier' => $category->getId()->getValue(),
                    'name' => $category->getName(),
                    'slug' => $category->getSlug()->getValue(),
                ];
            })->toArray(),
            'creationDate' => $article->getCreationDate()->format('Y-m-d H:i:s'),
            'lastUpdate' => null !== $article->getLastUpdate() ? $article->getLastUpdate()->format('Y-m-d H:i:s') : null,
        ];
    }
}
