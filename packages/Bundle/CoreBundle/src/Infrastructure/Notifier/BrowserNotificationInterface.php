<?php

declare(strict_types=1);

namespace Black\Bundle\CoreBundle\Infrastructure\Notifier;

interface BrowserNotificationInterface
{
    public function asBrowserNotification(): NotificationContext;
}
