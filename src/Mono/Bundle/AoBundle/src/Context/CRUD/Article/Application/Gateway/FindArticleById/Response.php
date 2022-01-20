<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Article\Application\Gateway\FindArticleById;

use Mono\Bundle\AoBundle\Context\CRUD\Article\Domain\View\DataProvider\Model\ArticleInterface;
use Mono\Bundle\CoreBundle\Application\Gateway\GatewayResponse;

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

    public function data(): array
    {
        $article = $this->getArticle();

        return [
            'identifier' => $article->getId()->getValue(),
            'name' => $article->getName(),
            'slug' => $article->getSlug()->getValue(),
            'content' => $article->getContent(),
            'status' => $article->getStatus(),
            'creationDate' => $article->getCreationDate()->format('Y-m-d H:i:s'),
            'lastUpdate' => null !== $article->getLastUpdate() ? $article->getLastUpdate()->format('Y-m-d H:i:s') : null,
        ];
    }
}
