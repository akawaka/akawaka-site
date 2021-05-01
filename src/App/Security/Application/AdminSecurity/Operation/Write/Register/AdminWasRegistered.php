<?php

declare(strict_types=1);

namespace App\Security\Application\AdminSecurity\Operation\Write\Register;

use App\Security\Domain\Entity\AdminUser;
use Mono\Component\Core\Infrastructure\Notifier\BrowserNotificationInterface;
use Mono\Component\Core\Infrastructure\Notifier\BrowserContext;
use Symfony\Component\Security\Core\User\UserInterface;

final class AdminWasRegistered implements BrowserNotificationInterface
{
    public function __construct(
        private AdminUser $admin,
    ) {
    }

    public function getAdmin(): UserInterface
    {
        return $this->admin;
    }

    public function asBrowserNotification(): BrowserContext
    {
        return new BrowserContext('admin_security.registered', 'success');
    }
}
