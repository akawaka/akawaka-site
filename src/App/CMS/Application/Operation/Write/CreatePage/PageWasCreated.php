<?php

declare(strict_types=1);

namespace App\CMS\Application\Operation\Write\CreatePage;

use Mono\Component\Core\Infrastructure\Notifier\BrowserNotificationInterface;
use Mono\Component\Core\Infrastructure\Notifier\NotificationContext;
use Mono\Component\Page\Domain\Entity\PageInterface;

final class PageWasCreated implements BrowserNotificationInterface
{
    public function __construct(
        private PageInterface $page,
    ) {
    }

    public function getPage(): PageInterface
    {
        return $this->page;
    }

    public function asBrowserNotification(): NotificationContext
    {
        return new NotificationContext('page.created', 'success');
    }
}
