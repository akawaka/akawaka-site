<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Operation\Write\UpdateCategory;

use Mono\Component\Article\Domain\Entity\CategoryInterface;
use Mono\Component\Core\Infrastructure\Notifier\BrowserNotificationInterface;
use Mono\Component\Core\Infrastructure\Notifier\NotificationContext;

final class CategoryWasUpdated implements BrowserNotificationInterface
{
    public function __construct(
        private CategoryInterface $category
    ) {
    }

    public function getCategory(): CategoryInterface
    {
        return $this->category;
    }

    public function asBrowserNotification(): NotificationContext
    {
        return new NotificationContext('category.updated', 'success');
    }
}
