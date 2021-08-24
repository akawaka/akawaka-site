<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Application\Article\Gateway\FindArticleBySlug;

use Mono\Bundle\CoreBundle\Application\Gateway\GatewayResponse;
use Mono\Bundle\AoBundle\Admin\Domain\Operation\Article\View\Model\ArticleInterface;

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
