<?php

declare(strict_types=1);

namespace App\CMS\Application\Article\Gateway\RemoveArticle;

use Mono\Component\Article\Domain\Entity\ArticleInterface;
use Mono\Component\Core\Application\Gateway\GatewayResponse;

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
        return [];
    }
}
