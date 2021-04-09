<?php

declare(strict_types=1);

namespace Mono\Component\AdminSecurity\Application\Operation\Write\UpdatePassword;

use Mono\Component\Core\Infrastructure\Notifier\BrowserNotificationInterface;
use Mono\Component\Core\Infrastructure\Notifier\NotificationContext;
use Symfony\Component\Security\Core\User\UserInterface;

final class AdminPasswordWasUpdated implements BrowserNotificationInterface
{
    public function __construct(
        private UserInterface $user
    ) {
    }

    public function getUser(): UserInterface
    {
        return $this->user;
    }

    public function asBrowserNotification(): NotificationContext
    {
        return new NotificationContext('admin_user.updated_password', 'success');
    }
}
