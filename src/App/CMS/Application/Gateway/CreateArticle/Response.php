<?php

declare(strict_types=1);

namespace App\CMS\Application\Gateway\CreateArticle;

use App\CMS\Domain\Entity\Article;
use Mono\Component\Article\Domain\Entity\Category;
use Mono\Component\Core\Application\Gateway\GatewayResponse;

final class Response implements GatewayResponse
{
    public function __construct(
        private Article $article
    ) {
    }

    public function getArticle(): Article
    {
        return $this->article;
    }

    public function data(): array
    {
        $article = $this->getArticle();

        return [
            'identifier' => $article->getId()->getValue(),
            'channel' => $article->getChannels(),
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
