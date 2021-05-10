<?php

declare(strict_types=1);

namespace Mono\Component\Core\Infrastructure\Notifier;

interface MailerNotificationInterface
{
    public function asMailerNotification(): MailerContext;
}
