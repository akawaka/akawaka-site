<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Operation\Write\UpdateArticle;

use Mono\Component\Article\Domain\Entity\ArticleInterface;
use Mono\Component\Core\Infrastructure\Notifier\BrowserNotificationInterface;
use Mono\Component\Core\Infrastructure\Notifier\NotificationContext;

final class ArticleWasUpdated implements BrowserNotificationInterface
{
    public function __construct(
        private ArticleInterface $article
    ) {
    }

    public function getArticle(): ArticleInterface
    {
        return $this->article;
    }

    public function asBrowserNotification(): NotificationContext
    {
        return new NotificationContext('article.updated', 'success');
    }
}
