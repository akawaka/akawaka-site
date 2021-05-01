<?php

declare(strict_types=1);

namespace App\CMS\Application\Operation\Write\CreateArticle;

use Mono\Component\Article\Domain\Entity\ArticleInterface;
use Mono\Component\Core\Infrastructure\Notifier\BrowserNotificationInterface;
use Mono\Component\Core\Infrastructure\Notifier\BrowserContext;

final class ArticleWasCreated implements BrowserNotificationInterface
{
    public function __construct(
        private ArticleInterface $article,
    ) {
    }

    public function getArticle(): ArticleInterface
    {
        return $this->article;
    }

    public function asBrowserNotification(): BrowserContext
    {
        return new BrowserContext('article.created', 'success');
    }
}
