<?php

declare(strict_types=1);

namespace Mono\Bundle\CoreBundle\Infrastructure\Notifier;

interface BrowserNotificationInterface
{
    public function asBrowserNotification(): BrowserContext;
}
