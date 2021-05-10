<?php

declare(strict_types=1);

namespace Mono\Component\Core\Infrastructure\Notifier;

interface BrowserNotificationInterface
{
    public function asBrowserNotification(): BrowserContext;
}
