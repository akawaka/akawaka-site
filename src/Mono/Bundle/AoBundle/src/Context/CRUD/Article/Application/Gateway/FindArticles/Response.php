<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Article\Application\Gateway\FindArticles;

use Doctrine\Common\Collections\ArrayCollection;
use Mono\Bundle\AoBundle\Context\CRUD\Article\Domain\View\DataProvider\Model\ArticleInterface;
use Mono\Bundle\CoreBundle\Application\Gateway\GatewayResponse;

final class Response implements GatewayResponse
{
    private ArrayCollection $articles;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
    }

    public function add(ArticleInterface $article): void
    {
        $this->articles->add($article);
    }

    public function getArticles(): ArrayCollection
    {
        return $this->articles;
    }

    public function data(): array
    {
        return $this->getArticles()->map(function (ArticleInterface $article) {
            return [
                'identifier' => $article->getId()->getValue(),
                'name' => $article->getName(),
                'slug' => $article->getSlug()->getValue(),
                'content' => $article->getContent(),
                'status' => $article->getStatus(),
                'creationDate' => $article->getCreationDate()->format('Y-m-d H:i:s'),
                'lastUpdate' => null !== $article->getLastUpdate() ? $article->getLastUpdate()->format('Y-m-d H:i:s') : null,
            ];
        })->toArray();
    }
}
