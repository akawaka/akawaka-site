<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Article\Application\Gateway;

use Mono\Bundle\AoBundle\Admin\Article\Domain\View\Model\ArticleInterface;

trait ArticleResponse
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
            'creationDate' => $article->getCreationDate()->format('Y-m-d H:i:s'),
            'lastUpdate' => null !== $article->getLastUpdate() ? $article->getLastUpdate()->format('Y-m-d H:i:s') : null,
        ];
    }
}
