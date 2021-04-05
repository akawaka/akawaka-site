<?php

declare(strict_types=1);

namespace App\Cms\Application\Operation\Write\SendContact;

use App\Infrastructure\Mailer\Email;
use Black\Component\Core\Infrastructure\Notifier\BrowserNotificationInterface;
use Black\Component\Core\Infrastructure\Notifier\NotificationContext;

final class ContactWasSent implements BrowserNotificationInterface
{
    private Email $email;

    public function __construct(Email $email)
    {
        $this->email = $email;
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
