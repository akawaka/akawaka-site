<?php

declare(strict_types=1);

namespace App\CMS\Application\Operation\Write\SendContact;

use App\Infrastructure\Mailer\Email;
use Mono\Component\Core\Infrastructure\Notifier\BrowserNotificationInterface;
use Mono\Component\Core\Infrastructure\Notifier\NotificationContext;

final class ContactWasSent implements BrowserNotificationInterface
{
    public function __construct(
        private Email $email
    ) {
    }

    public function getEmail(): Email
    {
        return $this->email;
    }

    public function asBrowserNotification(): NotificationContext
    {
        return new NotificationContext('success', 'contact.sent');
    }
}
